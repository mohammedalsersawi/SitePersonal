<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ResponseTrait;
use Yajra\DataTables\Facades\DataTables;

class SocialController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        return view('portal.admin.social.index');
    }
    public function store(Request $request)
    {
        $rules = [];
        $rules['name'] = 'required|string|max:255';
        $rules['url'] = 'required|string|max:255';
        $this->validate($request, $rules);
        $data = [];
        $data['name'] = $request->name;
        $data['url'] = $request->url;
        Social::create($data);
        return $this->sendResponse(null, __('item_added'));
    }
    public function update(Request $request)
    {
        $rules = [];
        $rules['name'] = 'required|string|max:255';
        $rules['url'] = 'required|string|max:255';
        $this->validate($request, $rules);
        $data = [];
        $data['name'] = $request->name;
        $data['url'] = $request->url;
        $data_Social = Social::find($request->id);
        $data_Social->update($data);
        return $this->sendResponse(null, __('item_added'));
    }



    public function getData(Request $request)
    {
        $data = Social::query();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($que) {
                $data_attr = '';
                $data_attr .= 'data-id="' . @$que->id . '" ';
                $data_attr .= 'data-name="' . @$que->name . '" ';
                $data_attr .= 'data-url="' . @$que->url . '" ';

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
                <input class="activate-row"  url="' . $currentUrl . "/admin/social/activate/" . $que->id . '" type="checkbox" id="checkbox' . $que->id . '" ' .
                    ($que->status ? 'checked' : '')
                    . '>
                <label for="checkbox' . $que->id . '"><span class="checkbox-icon"></span> </label>
            </div>';
            })
            ->rawColumns(['action', 'status'])->toJson();
    }

    public function activate($id)
    {
        $activate =  Social::findOrFail($id);
        $activate->status = !$activate->status;
        if (isset($activate) && $activate->save()) {
            return $this->sendResponse(null, __('item_edited'));
        }
    }

    public function destroy($id)
    {
        Social::destroy($id);
        return $this->sendResponse(null, null);
    }
}
