<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index(){
        $authUser = Auth::user();
        $blogs = Blog::where('user_id', $authUser->id)->get();
        // dd($authUser);
        return Inertia::render('Dashboard', [
            'blogs' => $blogs,
            'authUser' => $authUser
        ]);
    }
}
