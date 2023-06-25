<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    
    //1. __invoke(LoginResquest
    // public function __invoke(LoginResquest $request)
    // {
    //     $user = User::where('email',$request->email)->first();
    //     // 找不到用戶 或者 找到用戶，但輸入的密碼與當前密碼不匹配。
    //     if(!$user || !Hash::check($request->password, $user->password)) {
    //         // 驗證然後通過with messages方法指定錯誤消息。
    //         throw ValidationException::withMessages(
    //             [
    //                 'email'=>['errors'],
    //             ]
    //             );            
    //     }
    // }

    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        // if (!$user || !Hash::check($request->password, $user->password)) {
        //     throw ValidationException::withMessages([
        //         'email' => ['The credentials you entered are incorrect.']
        //     ]);
        // }
        if (!auth()->attempt($request->only(['email','password']))) {
            throw ValidationException::withMessages([
                'email' => ['The credentials you entered are incorrect.']
            ]);
        }
    }
}
