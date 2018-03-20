<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Setting;
use App\Tag;
use Illuminate\Http\Request;

class Frontend extends Controller
{
    public function index()
    {

        $settings = Setting::first();
        return view('welcome')->with('title', $settings->site_name)
            ->with('categories', Category::take(6)->get())
            ->with('settings', $settings)
            ->with('first_post', Post::orderBy('created_at', 'desc')->first())
            ->with('second_post', Post::orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first())
            ->with('third_post', Post::orderBy('created_at', 'desc')->skip(2)->take(1)->get()->first())
            ->with('recentcategory', Category::orderBy('created_at', 'desc')->take(4)->get());
    }

    public function post($slug)
    {

        $post = Post::where('slug', $slug)->get()->first();
        $next = Post::where('id', '>', $post->id)->get()->first();
        $pre = Post::where('id', '<', $post->id)->get()->first();
        return view('post')->with('title', $slug)
            ->with('categories', Category::take(6)->get())
            ->with('settings', Setting::first())
            ->with('next', $next)
            ->with('pre', $pre)
            ->with('tags', Tag::all())
            ->with('post', $post);
    }

    public function category($id)
    {

        $category = Category::find($id);
        return view('category')->with('title', $category->name)
            ->with('categories', Category::take(6)->get())
            ->with('category', $category)
            ->with('tags', Tag::all())
            ->with('settings', Setting::first());
    }

    public function tag($id)
    {

        $tag = Tag::find($id);
        return view('tag')
            ->with('title', $tag->tag)
            ->with('categories', Category::take(6)->get())
            ->with('tag', $tag)
            ->with('tags', Tag::all())
            ->with('settings', Setting::first());
    }

}