<?php

namespace Modules\Recruitment\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Recruitment\Entities\Company;
use Modules\Recruitment\Entities\CompanyImage;
use Modules\Recruitment\Entities\Job;
use Modules\Recruitment\Entities\JobTag;
use Modules\Recruitment\Entities\Welfare;

class CompanySeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        factory(Welfare::class, 100)->create();
        factory(JobTag::class, 100)->create();
        factory(Welfare::class, 100)->create();

        factory(Company::class, 10)->create()->each(function (Company $company) {
            $company->images()->createMany(factory(CompanyImage::class, random_int(0, 3))->make()->toArray());
            $company->jobs()->createMany(factory(Job::class, random_int(0, 20))->make()->toArray());
        });
    }
}
