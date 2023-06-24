<?php

namespace App\Http\Controllers\admin\pages\blogs;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class BlogController extends Controller
{
    public function index()
    {
        $categories  = Category::get();
        return view('portal.admin.pages.blogs.index', compact('categories'));
    }

    public function store(BlogRequest $request)
    {
        // dd($request);
        $data = [];
        foreach (locales() as $key => $language) {
            $data['info'][$key] = $request->get('info_' . $key);
            $data['title'][$key] = $request->get('title_' . $key);
            $data['description'][$key] = $request->get('description_' . $key);
        }

        $data_blog =  Blog::create($data);
        if ($request->hasFile('aksfileupload')) {
            $files = $request->file('aksfileupload');

            foreach ($files as $file) {
                Uploads($file, "Blog_Cover", 'blog_cover', $data_blog->id, false, null);
            }
        }

        if ($request->hasFile('aksfileupload')) {
        }
        return sendResponse(null, __('item_added'));
    }
}
