<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\Api\UserRequest;

class UsersController extends Controller
{
    /**
     * 创建用户
     * @author macp
     * @param UserRequest $request
     * @return \Dingo\Api\Http\Response|void
     */
    public function store(UserRequest $request)
    {
        $verifyData = \Cache::get($request->get('verification_key'));

        if (!$verifyData) {
            return $this->response->error('验证码已失效', 422);
        }

        if (!hash_equals($verifyData['code'], $request->get('verification_code'))) {
            // 返回401
            return $this->response->errorUnauthorized('验证码错误');
        }

        $user = User::create([
            'name' => $request->get('name'),
            'phone' => $verifyData['phone'],
            'password' => bcrypt($request->get('password')),
        ]);

        // 清除验证码缓存
        \Cache::forget($request->get('verification_key'));

        return $this->response->created();
    }
}
