<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('published_at', 'desc')->get();
        return view('blog.index', compact('blogs'));
    }

    public function show($id, $title)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.show', compact('blog'));
    }
}
