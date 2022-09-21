<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class AdminController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function dashboard()
    {
        $data['posts'] = BlogPost::orderBy('published_at', 'DESC')->simplePaginate(7);

        return view('blog.admin.dashboard', $data);
    }
}
