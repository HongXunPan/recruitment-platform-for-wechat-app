<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(\Modules\Recruitment\Database\Seeders\RecruitmentDatabaseSeeder::class);
        $this->call(\Modules\User\Database\Seeders\UserDatabaseSeeder::class);
    }
}
