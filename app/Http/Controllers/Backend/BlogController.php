<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPostCategory;
use Illuminate\Http\Request;
use PDOException;
use Carbon\Carbon;
use App\Models\BlogPost;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
	function BlogCategory()
	{
		$blogCategories = BlogPostCategory::latest()
			->get();

		return view('backend.blog.category.category_view', compact('blogCategories'));
	}

	function BlogCategoryStore(Request $request)
	{
		$request->validate([
			'blog_category_name_en' => 'required',
			'blog_category_name_urdu' => 'required',

		], [
			'blog_category_name_en.required' => 'Input Blog Category English Name',
			'blog_category_name_urdu.required' => 'Input Blog Category Urdu Name',
		]);



		BlogPostCategory::insert([
			'blog_category_name_en' => $request->blog_category_name_en,
			'blog_category_name_urdu' => $request->blog_category_name_urdu,
			'blog_category_slug_en' => strtolower(str_replace(' ', '-', $request->blog_category_name_en)),
			'blog_category_slug_urdu' => str_replace(' ', '-', $request->blog_category_name_urdu),
			'created_at' => Carbon::now(),


		]);

		$notification = [
			'message' => 'Blog Category Inserted Successfully',
			'alert-type' => 'success'
		];

		return redirect()->back()->with($notification);
	}

	public function BlogCategoryEdit($id)
	{
		$category = BlogPostCategory::findOrFail($id);

		return view('backend.blog.category.category_edit', compact('category'));
	}

	public function BlogCategoryUpdate(Request $request, $id)
	{
		$request->validate([
			'blog_category_name_en' => 'required',
			'blog_category_name_urdu' => 'required',

		], [
			'blog_category_name_en.required' => 'Input Blog Category English Name',
			'blog_category_name_urdu.required' => 'Input Blog Category Urdu Name',
		]);



		BlogPostCategory::findOrFail($id)->update([
			'blog_category_name_en' => $request->blog_category_name_en,
			'blog_category_name_urdu' => $request->blog_category_name_urdu,
			'blog_category_slug_en' => strtolower(str_replace(' ', '-', $request->blog_category_name_en)),
			'blog_category_slug_urdu' => str_replace(' ', '-', $request->blog_category_name_urdu),
			'updated_at' => Carbon::now(),


		]);

		$notification = [
			'message' => 'Blog Category Update Successfully',
			'alert-type' => 'info'
		];

		return redirect()->route('blog-category')->with($notification);
	}


	public function BlogCategoryDelete($id)
	{
		BlogPostCategory::findOrFail($id)->delete();

		$notification = [
			'message' => 'Blog Category Delete Successfully',
			'alert-type' => 'error'
		];

		return redirect()->route('blog-category')->with($notification);
	}
	public function AddBlogPost()
	{

		$blogcategory = BlogPostCategory::latest()->get();
		$blogpost = BlogPost::latest()->get();
		return view('backend.blog.post.post_add', compact('blogpost', 'blogcategory'));
	}

	public function ListBlogPost()
	{
		$blogPost = BlogPost::with('category')->latest()->get();
		return view('backend.blog.post.post_list', compact('blogPost'));
	}

	public function BlogPostStore(Request $request)
	{
		$request->validate([
			'post_title_en' => 'required',
			'post_title_urdu' => 'required',
			'category_id' => 'required',
			'post_image' => 'required'
		]);

		if ($request->file('post_image')) {

			// create image manager with desired driver
			$manager = new ImageManager(new Driver());

			$nameGen = hexdec(uniqid()) . '.' . $request->file('post_image')->getClientOriginalExtension();

			// read image from file system
			$image = $manager->read($request->file('post_image'));

			$image = $image->resize(780, 433);

			$image->toJpeg(80)->save(base_path('public/upload/post/' . $nameGen));
			$saveUrl = 'upload/post/' . $nameGen;

			BlogPost::insert([
				'post_title_en' => $request->post_title_en,
				'post_title_urdu' => $request->post_title_urdu,
				'category_id' => $request->category_id,

				'post_slug_en' => strtolower(str_replace(' ', '-', $request->post_name_en)),
				'post_slug_urdu' => str_replace(' ', '-', $request->post_name_urdu),
				'post_image' => $saveUrl,
				'post_details_en' => $request->post_details_en,
				'post_details_urdu' => $request->post_details_urdu,
				'created_at' => Carbon::now()
			]);

			$notification = [
				'message' => 'Blog Post inserted Successfully',
				'alert-type' => 'success'
			];

			return redirect()->route('list-blog-post')->with($notification);
		}
	}


	public function BlogPostDetail($id)
	{
		$blogCategory = BlogPostCategory::latest()->get();
		$blogPost = BlogPost::findOrFail($id);
		return view('frontend.blog.blog_details', compact('blogPost', 'blogCategory'));
	}

	
}
