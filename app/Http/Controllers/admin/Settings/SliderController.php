<?php

namespace App\Http\Controllers\admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    public function index()
    {
        return view('portal.admin.setting.slider');
    }

    public function store(SliderRequest $request)
    {
        $data = [];
        foreach (locales() as $key => $language) {
            $data['info'][$key] = $request->get('info_' . $key);
            $data['title'][$key] = $request->get('title_' . $key);
        }
        if ($request->btn_required === 'on') {
            foreach (locales() as $key => $language) {
                $data['button'][$key] = $request->get('button_' . $key);
            }
            $data['url'] = $request->url;
        }
        $data_Slider =  Slider::create($data);
        if ($request->hasFile('aksfileupload')) {
            Uploads($request->aksfileupload[0], "Slider_Cover", 'slider_cover', $data_Slider->id, false, null);
        }
        return sendResponse(null, __('item_added'));
    }


    public function update(SliderRequest $request)
    {
        // dd($request);
        $data = [];
        foreach (locales() as $key => $language) {
            $data['info'][$key] = $request->get('info_' . $key);
            $data['title'][$key] = $request->get('title_' . $key);
        }
        if ($request->btn_required === 'on') {
            foreach (locales() as $key => $language) {
                $data['button'][$key] = $request->get('button_' . $key);
            }
            $data['url'] = $request->url;
        }
        $data_Slider = Slider::find($request->id);
        $data_Slider->update($data);
        if ($request->hasFile('aksfileupload')) {
            Uploads($request->aksfileupload[0], "Slider_Cover", 'slider_cover', $data_Slider->id, true, $data_Slider->id);

        }
        return sendResponse(null, __('item_added'));
    }



    public function getData(Request $request)
    {
        $data = Slider::query();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($que) {
                $data_attr = '';
                $data_attr .= 'data-id="' . @$que->id . '" ';
                foreach (locales() as $key => $value) {
                    $data_attr .= 'data-button_' . $key . '="' . $que->getTranslation('button', $key) . '" ';
                    $data_attr .= 'data-info_' . $key . '="' . $que->getTranslation('info', $key) . '" ';
                    $data_attr .= 'data-title_' . $key . '="' . $que->getTranslation('title', $key) . '" ';
                }
                $data_attr .= 'data-url="' . @$que->url . '" ';
                $string = '';
                $delete_route = "{{route('slider.delete',$que->id)}}";
                $string .= '<button class="edit_btn btn btn-sm btn-outline-primary btn_edit" data-toggle="modal" data-target="#modal_System" ' . $data_attr . '>
                <i class="bi bi-pencil-fill bi-xs"></i>
            </button>';
                $string .= ' <button type="button" class="btn btn-sm btn-outline-danger btn_delete" data-id="' . $que->id . '">
                <i class="bi bi-trash-fill bi-xs"></i>
            </button>';

                return $string;
            })
            ->addColumn('image', function ($que) {
                return '<img class="enlarge" src="' . asset($que->image->full_original_path) . '" alt="" style="width: 75px; height: 75px; border-radius: 10%;" onmouseover="this.style.transform = \'scale(3)\';" onmouseout="this.style.transform = \'scale(1)\';">';
            })
            ->addColumn('url', function ($que) {
                return '<a href="' . $que->url . '" target="_blank"><i class="fa fa-link"></i></a>';
            })
            ->addColumn('status', function ($que) {
                $currentUrl = url('/');
                return '<div class="checkbox">
                <input class="activate-row"  url="' . $currentUrl . "/admin/slider/activate/" . $que->id . '" type="checkbox" id="checkbox' . $que->id . '" ' .
                    ($que->status ? 'checked' : '')
                    . '>
                <label for="checkbox' . $que->id . '"><span class="checkbox-icon"></span> </label>
            </div>';
            })
            ->rawColumns(['action', 'status', 'image', 'url'])->toJson();
    }



    public function activate($id)
    {
        $activate =  Slider::findOrFail($id);
        $activate->status = !$activate->status;
        if (isset($activate) && $activate->save()) {
            return sendResponse(null, __('item_edited'));
        }
    }

    public function destroy($id)
    {
        Slider::destroy($id);
        return sendResponse(null, null);
    }
}
