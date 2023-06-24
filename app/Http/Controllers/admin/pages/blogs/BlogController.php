<?php

namespace App\Http\Controllers\admin\pages\blogs;

use App\Models\Blog;
use App\Models\Uplode;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function index()
    {
        $categories  = Category::get();
        return view('portal.admin.pages.blogs.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'blog_cover' => 'required',
        ], [
            'blog_cover.required' => 'يرجي اضافة الصورة بحد اقصى 2',
        ]);
        $data = [];
        foreach (locales() as $key => $language) {
            $data['info'][$key] = $request->get('info_' . $key);
            $data['title'][$key] = $request->get('title_' . $key);
            $data['description'][$key] = $request->get('description_' . $key);
        }
        $data['category_id'] = $request->get('category_id');
        $data_blog =  Blog::create($data);
        if ($request->hasFile('blog_cover')) {
            $files = $request->file('blog_cover');
            $lastTwoFiles = array_slice($files, -2);
            foreach ($lastTwoFiles as $file) {
                Uploads($file, "Blog_Cover", 'blog_cover', $data_blog->id, false, null);
            }
        }

        return sendResponse(null, __('item_added'));
    }
    public function update(BlogRequest $request)
    {
        $data = [];
        foreach (locales() as $key => $language) {
            $data['info'][$key] = $request->get('info_' . $key);
            $data['title'][$key] = $request->get('title_' . $key);
            $data['description'][$key] = $request->get('description_' . $key);
        }
        $data['category_id'] = $request->get('category_id');
        $data_blog = Blog::find($request->id);
        $data_blog->update($data);
        if ($request->hasFile('blog_cover')) {
            $relation_id = $data_blog->id;
            $file_type = 'blog_cover';
            $oldFiles = Uplode::where('relation_id', $relation_id)->where('file_type', $file_type)->get();
            DB::beginTransaction();
            try {
            foreach ($oldFiles as $oldFile) {
                File::delete(public_path($oldFile->full_large_path));
                $oldFile->delete();
            }
            $files = $request->file('blog_cover');
            $lastTwoFiles = array_slice($files, -2);
            foreach ($lastTwoFiles as $file) {
                Uploads($file, "Blog_Cover", 'blog_cover', $data_blog->id, false, null);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return sendResponse(null, __('Failed'));
        }
        }

        return sendResponse(null, __('item_added'));
    }



    public function getData(Request $request)
    {
        $data = Blog::query();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($que) {
                $data_attr = '';
                $data_attr .= 'data-id="' . @$que->id . '" ';
                $data_attr .= 'data-category_id="' . @$que->category_id . '" ';
                foreach (locales() as $key => $value) {
                    $data_attr .= 'data-info_' . $key . '="' . $que->getTranslation('info', $key) . '" ';
                    $data_attr .= 'data-title_' . $key . '="' . $que->getTranslation('title', $key) . '" ';
                    $data_attr .= 'data-description_' . $key . '="' . $que->getTranslation('description', $key) . '" ';
                }
                $string = '';
                $delete_route = "{{route('Feature.delete',$que->id)}}";
                $string .= '<button class="edit_btn btn btn-sm btn-outline-primary btn_edit" data-toggle="modal" data-target="#modal_System" ' . $data_attr . '>
                <i class="bi bi-pencil-fill bi-xs"></i>
            </button>';
                $string .= ' <button type="button" class="btn btn-sm btn-outline-danger btn_delete" data-id="' . $que->id . '">
                <i class="bi bi-trash-fill bi-xs"></i>
            </button>';

                return $string;
            })
            ->addColumn('images', function ($que) {
                $images = '';
                if ($que->albom !== null) {
                    foreach ($que->albom as $image) {
                        $images .= '<img class="enlarge" src="' . asset($image->full_original_path) . '" alt="" style="width: 75px; height: 75px; border-radius: 10%;" onmouseover="this.style.transform = \'scale(3)\';" onmouseout="this.style.transform = \'scale(1)\';">';
                    }
                }
                return $images;
            })
            ->addColumn('category', function ($que) {
                $category = $que->category->name;
                return $category;
            })
            ->addColumn('status', function ($que) {
                $currentUrl = url('/');
                return '<div class="checkbox">
                <input class="activate-row"  url="' . $currentUrl . "/admin/blog/activate/" . $que->id . '" type="checkbox" id="checkbox' . $que->id . '" ' .
                    ($que->status ? 'checked' : '')
                    . '>
                <label for="checkbox' . $que->id . '"><span class="checkbox-icon"></span> </label>
            </div>';
            })
            ->rawColumns(['action', 'status', 'images', 'category'])->toJson();
    }
    public function activate($id)
    {
        $activate =  Blog::findOrFail($id);
        $activate->status = !$activate->status;
        if (isset($activate) && $activate->save()) {
            return sendResponse(null, __('item_edited'));
        }
    }

    public function destroy($id)
    {
        Blog::destroy($id);
        return sendResponse(null, null);
    }
}
