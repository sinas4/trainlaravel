<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CustomAuthCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(CustomAuthCheck::class);
    }

    public function index()
    {
        $user = Auth::user();

        return view('auth.dashboard', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|min:3|max:255',
        ], [
            'name.required' => 'نام خود را وارد کنید',
            'name.min' => 'نام باید حداقل ۳ کاراکتر باشد',
        ]);

        // چک کن اگه اسم تغییر نکرده
        if ($user->name === $request->name) {
            return back()->with('info', 'هیچ تغییری در نام شما اعمال نشد');
        }

        // فقط اگه تغییر کرده بود، آپدیت کن
        $user->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'پروفایل با موفقیت به‌روزرسانی شد');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'رمز فعلی را وارد کنید',
            'new_password.required' => 'رمز جدید را وارد کنید',
            'new_password.min' => 'رمز جدید باید حداقل ۶ کاراکتر باشد',
            'new_password.confirmed' => 'رمز جدید با تکرار آن مطابقت ندارد',
        ]);

        // چک کردن رمز فعلی
        if (! Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'رمز فعلی اشتباه است');
        }

        // به‌روزرسانی رمز
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'رمز عبور با موفقیت تغییر کرد');
    }
}
