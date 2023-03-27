<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ResponseTrait;

class AboutController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        return view('portal.admin.about.index');
    }
    public function store(Request $request)
    {
        $data_aboute = About::find($request->id);
        $data = [];
        foreach (locales() as $key => $language) {
            $data['name'][$key] = $request->get('name_' . $key);
            $data['about'][$key] = $request->get('about_' . $key);
            $data['description'][$key] = $request->get('description_' . $key);
            $data['freelance'][$key] = $request->get('freelance_' . $key);
            $data['degree'][$key] = $request->get('degree_' . $key);
            $data['city'][$key] = $request->get('city_' . $key);
        }
        $data['website'] = $request->website;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['birthday'] = $request->birthday;
        $data['age'] = $request->age;

        if ($data_aboute) {
            $data_aboute->update($data);
            if ($request->hasFile('image')) {
                UploadImage($request->image, null, 'App\Models\About', $data_aboute->id, true, null, Image::IMAGE);
            }

        } else {
           $data = About::create($data);
            if ($request->hasFile('image')) {
                UploadImage($request->image, null, 'App\Models\About', $data->id, false, null, Image::IMAGE);
            }
        }

        return $this->sendResponse(null, __('item_added'));
    }


    public function getData()
    {
        $data = About::first();
        return $this->sendResponse($data, null);
    }
}
