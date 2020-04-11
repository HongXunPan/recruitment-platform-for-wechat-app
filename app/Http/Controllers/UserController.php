<?php
/**
 * Created by PhpStorm.
 * User: HongXunPan
 * Date: 2020/3/29
 * Time: 17:42
 */

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Exceptions\ParamException;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Recruitment\Entities\Area;
use Modules\Recruitment\Entities\Company;
use Modules\Recruitment\Entities\Welfare;

class UserController extends Controller
{
    public function weappLogin(Request $request)
    {
        return [111];
//        $code = $request->code;
        $code = "061GgFpv1t4gue05Jopv1jzmpv1GgFpb";
        // 根据 code 获取微信 openid 和 session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);
        dd($data);
        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code已过期或不正确');
        }
        $weappOpenid = $data['openid'];
        $weixinSessionKey = $data['session_key'];
        $nickname = $request->nickname;
        $avatar = str_replace('/132', '/0', $request->avatar);//拿到分辨率高点的头像
        $country = $request->country ? $request->country : '';
        $province = $request->province ? $request->province : '';
        $city = $request->city ? $request->city : '';
        $gender = $request->gender == '1' ? '1' : '2';//没传过性别的就默认女的吧，体验好些
        $language = $request->language ? $request->language : '';

        //找到 openid 对应的用户
        $user = User::where('weapp_openid', $weappOpenid)->first();
        //没有，就注册一个用户
        if (!$user) {
            $user = User::create([
                'weapp_openid' => $weappOpenid,
                'weapp_session_key' => $weixinSessionKey,
                'password' => $weixinSessionKey,
                'avatar' => $request->avatar,
                'weapp_avatar' => $avatar,
                'nickname' => $nickname,
                'country' => $country,
                'province' => $province,
                'city' => $city,
                'gender' => $gender,
                'language' => $language,
            ]);
        }
        //如果注册过的，就更新下下面的信息
        $attributes['updated_at'] = now();
        $attributes['weixin_session_key'] = $weixinSessionKey;
        $attributes['weapp_avatar'] = $avatar;
        if ($nickname) {
            $attributes['nickname'] = $nickname;
        }
        if ($request->gender) {
            $attributes['gender'] = $gender;
        }
        // 更新用户数据
        $user->update($attributes);
        // 直接创建token并设置有效期
        $createToken = $user->createToken($user->weapp_openid);
        $createToken->token->expires_at = Carbon::now()->addDays(30);
        $createToken->token->save();
        $token = $createToken->accessToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => "Bearer",
            'expires_in' => Carbon::now()->addDays(30),
            'data' => $user,
        ], 200);
    }

    public function test(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255',
            'xx' => 'required',
        ]);

        return ['list' => [], 'page' => 1, 'count' => 0];
        $aa = Welfare::query()->find(1);

        DB::connection()->enableQueryLog();//开启执行日志
        $bb = $aa->companies;
//        dd(DB::getQueryLog());   //获取查询语句、参数和执行时间
        dd($bb);
    }

}