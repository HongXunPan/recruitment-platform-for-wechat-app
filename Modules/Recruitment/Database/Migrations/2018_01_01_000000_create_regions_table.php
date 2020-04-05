<?php

use Cblink\Region\Region;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Lybc\PhpGB2260\GB2260;

class CreateRegionsTable extends Migration
{
    protected $tableName = 'recruitment_areas';

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->default(0)->index();
            $table->string('name', 50);
            $table->unsignedInteger('code');
            $table->unsignedTinyInteger('type')->index();
            $table->string('initial', 1)->index();
            $table->unsignedTinyInteger('is_hot')->default(0)->index();
        });

        $region = new Region();

        $provinces = $region->getRegionsWithCode();

        foreach ($provinces as $province) {
            $provinceId = DB::table($this->tableName)->insertGetId([
                'name' => $province['title'],
                'code' => $province['ad_code'],
                'initial' => $this->getInitial($province['title']),
                'type' => Region::PROVINCE,
            ]);
            foreach ($province['child'] as $city) {
                $cityId = DB::table($this->tableName)->insertGetId([
                    'name' => $city['title'],
                    'parent_id' => $provinceId,
                    'code' => $city['ad_code'],
                    'initial' => $this->getInitial($city['title']),
                    'type' => Region::CITY,
                ]);
                $areas = array_map(function ($area) use ($cityId) {
                    return ['name' => $area['title'], 'code' => $area['ad_code'],
                        'initial' => $this->getInitial($area['title']),
                        'parent_id' => $cityId, 'type' => Region::AREA];
                }, $city['child']);
                DB::table($this->tableName)->insert($areas);
            }
        }
    }

    private function getInitial($name)
    {
        return \Illuminate\Support\Str::upper(\Illuminate\Support\Str::limit(app('pinyin')->abbr($name), 1, ''));
    }

    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }

}