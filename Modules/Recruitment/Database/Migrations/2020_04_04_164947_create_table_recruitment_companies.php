<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRecruitmentCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment_companies', function (Blueprint $table) {
            $table->id();

            $table->string('name', 200)->unique();
            $table->string('logo')->nullable();
            $table->text('intro')->nullable();
            $table->unsignedTinyInteger('is_identify')->default(0)->index()->comment('是否已认证');
            $table->string('contacts', '100')->nullable()->comment('联系人');
            $table->string('phone', '20')->nullable()->comment('联系电话');

            $table->text('welfare_ids')->nullable()->comment('公司福利');

            $table->json('location')->nullable()->comment('当前地理信息');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruitment_companies');
    }
}
