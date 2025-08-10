<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPostCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class HomeBlogController extends Controller
{
    public function AddBlogPost()
    {
        $blogPost = BlogPost::latest()->get();
        $blogCategory = BlogPostCategory::latest()->get();

        return view('frontend.blog.blog_list', compact('blogPost', 'blogCategory'));
    }

    public function BlogPostCategory($id)
    {
        $blogCategory = BlogPostCategory::latest()->get();
        $blogPost = BlogPost::where('category_id', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.blog.blog_cat_list', compact('blogPost', 'blogCategory'));
    }
}
