<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
  
    public function allBlogs()
{
    $blogs = Blog::with('author')->latest()->get();
    return view('all_blogs', compact('blogs'));
}

public function myBlogs()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Вам необхідно увійти');
        }
        $blogs = Blog::where('user_id', Auth::user()->id)->latest()->get();
        return view('my_blogs', compact('blogs'));
    }

    public function create()
    {
        if (!Auth::check()) {
        session()->flash('error', 'Вам необхідно увійти');
        return redirect()->route('login');
    }
        return view('add_blog_to_list');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'created_or_updated_at' => now(),
        ]);
        if (!$blog) {
            return redirect()->route('blogs.create')->with('error', 'Ошибка при создании записи.');
        }
        
        return redirect()->route('my.blogs')->with('success', 'Запис успішно створено!');
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return redirect()->route('blogs.all')->with('error', 'Запис не знайдено');
        } 
        return view('blog_by_id', compact('blog'));}

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Ви не автор цього запису.');
        }

        return view('edit_blog', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Ви не автор цього запису.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->created_or_updated_at = now();

        $blog->save();

        return redirect()->route('my.blogs')->with('success', 'Запис успішно оновлено!');
    }

    public function destroy($id)
{
    $blog = Blog::findOrFail($id);
    if ($blog->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
        abort(403, 'У вас немає прав на видалення цього запису.');
    }

    $blog->delete();

    return redirect()->route('blogs.all')->with('success', 'Запис успішно видалено!');
}

}
