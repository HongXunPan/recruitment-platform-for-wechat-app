<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\AdeptLanguage;
use Modules\User\Entities\EducationExperience;
use Modules\User\Entities\Identity;
use Modules\User\Entities\RecruitmentInfo;
use Modules\User\Entities\SkillCertificate;
use Modules\User\Entities\User;
use Modules\User\Entities\WorkExperience;

class UserSeederTableSeeder extends Seeder
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

        factory(User::class, 10)->create()->each(function (User $user) {
            /** $user User */
            $user->identity()->save(factory(Identity::class)->make(['real_name' => $user->real_name]));
            $user->adeptLanguages()->createMany(factory(AdeptLanguage::class, random_int(0, 4))->make()->toArray());
            $user->educationExperiences()->createMany(factory(EducationExperience::class, random_int(0, 4))->make()->toArray());
            $user->recruitmentInfo()->save(factory(RecruitmentInfo::class)->make());
            $user->skillCertificates()->createMany(factory(SkillCertificate::class, random_int(0, 6))->make()->toArray());
            $user->workExperiences()->createMany(factory(WorkExperience::class, random_int(0, 5))->make()->toArray());

        });
    }
}
