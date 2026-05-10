<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Kavenegar\KavenegarApi;

class AuthController extends Controller
{
    // صفحه اصلی ورود
    public function showLogin()
    {
        if (Auth::check()) {
            return view('home');
        } else {
            return view('auth.login');
        }
    }

    // صفحه ورود با رمز عبور
    public function showLoginWithPassword()
    {
        return view('auth.login-password');
    }

    // صفحه تکمیل اطلاعات (برای کاربر جدید)
    public function showCompleteProfile()
    {
        if (! session('temp_phone')) {
            return redirect()->route('login');
        }

        return view('auth.complete-profile');
    }

    // بررسی شماره و ارسال کد
    public function checkPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|size:11|regex:/^09[0-9]{9}$/',
        ], [
            'phone.required' => 'شماره خود را وارد کنید',
            'phone.size' => 'شماره باید ۱۱ رقم باشد',
            'phone.regex' => 'شماره باید با 09 شروع شود',
        ]);

        $phone = $request->phone;
        $code = rand(100000, 999999);

        session([
            'login_code' => $code,
            'temp_phone' => $phone,
        ]);

        $this->sendSms($phone, $code);

        return redirect()->route('verify')->with('success', 'کد تایید ارسال شد');
    }

    // صفحه وارد کردن کد
    public function showVerify()
    {
        if (! session('temp_phone')) {
            return redirect()->route('login');
        }

        return view('auth.verify');
    }

    // تایید کد - تصمیم‌گیری برای رفتن به صفحه تکمیل یا ورود مستقیم
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|size:6',
        ]);

        if ($request->code != session('login_code')) {
            return back()->with('error', 'کد اشتباه است');
        }

        $phone = session('temp_phone');
        $user = User::where('phone', $phone)->first();

        if ($user) {
            // کاربر وجود دارد → وارد سایتش کن
            Auth::login($user);
            session()->forget(['login_code', 'temp_phone']);

            return redirect()->route('home')->with('success', 'خوش آمدید');
        } else {
            // کاربر وجود ندارد → بره صفحه تکمیل اطلاعات
            return redirect()->route('complete.profile');
        }
    }

    // تکمیل اطلاعات کاربر جدید
    public function completeProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'password' => 'required|min:6|confirmed|regex:/^[A-Za-z0-9]+$/',
        ], [
            'name.required' => 'نام خود را وارد کنید',
            'name.min' => 'نام نباید کمتر از ۳ کرکتر باشد',
            'password.required' => 'رمز عبور را وارد کنید',
            'password.min' => 'رمز عبور باید حداقل ۶ کاراکتر باشد',
            'password.confirmed' => 'رمز عبور با تکرار آن مطابقت ندارد',
            'password.regex' => 'رمز عبور باید فقط شامل حروف و اعداد انگلیسی باشد',
        ]);

        $phone = session('temp_phone');

        if (! $phone) {
            return redirect()->route('login');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $phone,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        session()->forget(['login_code', 'temp_phone']);

        return redirect()->route('home')->with('success', 'ثبت نام موفقیت آمیز بود. خوش آمدید');
    }

    // ورود با رمز عبور (برای کاربرانی که رمز دارند)
    public function loginWithPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|size:11|regex:/^09[0-9]{9}$/',
            'password' => 'required',
        ]);

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return redirect()->route('home')->with('success', 'خوش آمدید');
        }

        return back()->with('error', 'شماره یا رمز عبور اشتباه است');
    }

    // خروج
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    // ارسال پیامک
    private function sendSms($phone, $code)
    {
        try {
            $api = new KavenegarApi('764B4E2F326F545165636A5A6845766735375A366D39426867365372626C4A517253514B517661504963343D');
            $message = "کد تایید شما: {$code}";
            $sender = '9982002189';
            $api->Send($sender, $phone, $message);
            Log::info("SMS sent to {$phone}");
        } catch (\Exception $e) {
            Log::error('Kavenegar Error: '.$e->getMessage());
        }
    }
}
