<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return Inertia::render('Blog', [
            'blogs' => $blogs,
        ]);
    }
}
