<?php
/**
 * Created by PhpStorm.
 * User: HongXunPan
 * Date: 2020/4/12
 * Time: 0:30
 */

return [
    'custom' => [
        '*.required' => ':attribute不可为空',
        '*.in' => ':attribute不合法',
        'email' => [
//            'required' => 'We need to know your e-mail address!',
        ],
    ],
    'attributes' => [
        'email' => '邮箱'
    ],
];
