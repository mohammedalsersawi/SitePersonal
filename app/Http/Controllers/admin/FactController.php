<?php

namespace App\Http\Controllers\admin;

use App\Models\Fact;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Admin\ResponseTrait;

class FactController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        return view('portal.admin.facts.index');
    }


    public function store(Request $request)
    {
        $rules = [];
        foreach (locales() as $key => $language) {
            $rules['key_' . $key] = 'required|string|max:255';
        }
        $rules['value'] = 'required|string|max:255';
        $rules['icon'] = 'required|string|max:255';

        $this->validate($request, $rules);
        $data = [];
        foreach (locales() as $key => $language) {
            $data['key'][$key] = $request->get('key_' . $key);
        }
        $data['value'] = $request->value;
        $data['icon'] = $request->icon;
       $data = Fact::create($data);
        // if ($request->hasFile('image')) {
        //     UploadImage($request->image, null, 'App\Models\Fact', $data->id, false, null, Image::IMAGE);
        // }
        return $this->sendResponse(null, __('item_added'));
    }
    public function update(Request $request)
    {
        $rules = [];
        foreach (locales() as $key => $language) {
            $rules['key_' . $key] = 'required|string|max:255';
        }
        $rules['value'] = 'required|string|max:255';
        $rules['icon'] = 'required|string|max:255';

        $this->validate($request, $rules);
        $data = [];
        foreach (locales() as $key => $language) {
            $data['key'][$key] = $request->get('key_' . $key);
        }
        $data['value'] = $request->value;
        $data['icon'] = $request->icon;
        $data_fact = Fact::find($request->id);
        $data_fact->update($data);
        // if ($request->hasFile('image')) {
        //     UploadImage($request->image, null, 'App\Models\Fact', $data_fact->id, true, null, Image::IMAGE);
        // }

        return $this->sendResponse(null, __('item_added'));
    }


    public function getData(Request $request)
    {
        $fact = Fact::query();
        return Datatables::of($fact)
            ->addIndexColumn()
            ->addColumn('action', function ($que) {
                $data_attr = '';
                $data_attr .= 'data-id="' . @$que->id . '" ';
                $data_attr .= 'data-key="' . @$que->key . '" ';
                $data_attr .= 'data-value="' . @$que->value . '" ';
                $data_attr .= 'data-icon="' . @$que->icon . '" ';
                foreach (locales() as $key => $value) {
                    $data_attr .= 'data-key_' . $key . '="' . $que->getTranslation('key', $key) . '" ';
                }
                $string = '';
                $delete_route = "{{route('brand.delete',$que->id)}}";
                $string .= '<button class="edit_btn btn btn-sm btn-outline-primary btn_edit" data-toggle="modal"
                    data-target="#edit_modal" ' . $data_attr . '>' . __('edit') . '</button>';
                $string .= ' <button type="button"  class="btn btn-sm btn-outline-danger btn_delete" data-id="' . $que->id .
                    '">' . __('delete') . '  </button>';
                return $string;
            })
            ->addColumn('status', function ($que) {
                $currentUrl = url('/');
                return '<div class="checkbox">
                <input class="activate-row"  url="' . $currentUrl . "/admin/facts/activate/" . $que->id . '" type="checkbox" id="checkbox' . $que->id . '" ' .
                    ($que->status ? 'checked' : '')
                    . '>
                <label for="checkbox' . $que->id . '"><span class="checkbox-icon"></span> </label>
            </div>';
            })
            ->rawColumns(['action', 'status'])->toJson();
    }


    public function activate($id)
    {
        $activate =  Fact::findOrFail($id);
        $activate->status = !$activate->status;
        if (isset($activate) && $activate->save()) {
            return $this->sendResponse(null, __('item_edited'));
        }
    }

    public function destroy($id)
    {
        Fact::destroy($id);
        return $this->sendResponse(null, null);
    }
}
