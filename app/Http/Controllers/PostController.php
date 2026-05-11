<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }



    public function create()
    {
        return view('posts.create');
    }



 public function store(Request $request)
{
    // validation
    $validatedData = $request->validate([
        'title' => 'required|min:3',
        'description' => 'required',
    ]);
    
    $inserted = Post::create([
        'user_id' => Auth::id(),  // ← کاربر وارد شده
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'slug' => \Illuminate\Support\Str::slug($validatedData['title'])
    ]);
    
    if ($inserted) {
        return redirect()->route('posts.index')->with('success', 'پست با موفقیت ایجاد شد');
    } else {
        return back()->with('error', 'خطا در ذخیره پست');
    }
}




    public function single(Post $post)
    {
        return view('posts.single', compact('post'));
    }




    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }




    public function update(Request $request, Post $post)
{
    $request->validate([
        'title' => 'required|min:3',
        'description' => 'required',
    ]);

    // به‌روزرسانی title و description
    $post->title = $request->title;
    $post->description = $request->description;
    
    // این خط باعث می‌شود slug دوباره از title جدید ساخته شود
    $post->save(); // ← پکیج خودش اسلاگ رو بازنویسی می‌کند

    return redirect()->route('posts.single', $post->slug)->with('success', 'پست ویرایش شد');
}






public function delete(Post $post)  // ← لاراول خودکار بر اساس slug پیدا می‌کند
{
    $post->delete();

    return redirect()->route('posts.index')->with('success', 'پست با موفقیت حذف شد');
}
} 
