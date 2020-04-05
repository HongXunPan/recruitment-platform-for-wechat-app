<?php

namespace Modules\Recruitment\Enums;

use App\Enums\BaseEnum;


/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserEnum extends BaseEnum
{
    const OptionOne = 0;
    const OptionTwo = 1;
    const OptionThree = 2;

    //degree_type
    const degree_type = 0;

    const SEX_UNKNOWN = 0;
    const SEX_MAN = 1;
    const SEX_WOMAN = 2;
}
