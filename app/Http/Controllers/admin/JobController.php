<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Admin\ResponseTrait;
use Yajra\DataTables\Facades\DataTables;

class JobController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        return view('portal.admin.job.index');
    }

    public function store(Request $request)
    {
        $rules = [];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }

        $this->validate($request, $rules);
        $data = [];
        foreach (locales() as $key => $language) {
            $data['name'][$key] = $request->get('name_' . $key);
        }
        Job::create($data);
        return $this->sendResponse(null, __('item_added'));
    }
    public function update(Request $request)
    {
        $rules = [];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
        }

        $this->validate($request, $rules);
        $data = [];
        foreach (locales() as $key => $language) {
            $data['name'][$key] = $request->get('name_' . $key);
        }
        $data_job = Job::find($request->id);
        $data_job->update($data);
        return $this->sendResponse(null, __('item_added'));
    }


    public function getData(Request $request)
    {
        $data = Job::query();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($que) {
                $data_attr = '';
                $data_attr .= 'data-id="' . @$que->id . '" ';
                $data_attr .= 'data-name="' . @$que->name . '" ';
                foreach (locales() as $key => $value) {
                    $data_attr .= 'data-name_' . $key . '="' . $que->getTranslation('name', $key) . '" ';
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
                <input class="activate-row"  url="' . $currentUrl . "/admin/jobs/activate/" . $que->id . '" type="checkbox" id="checkbox' . $que->id . '" ' .
                    ($que->status ? 'checked' : '')
                    . '>
                <label for="checkbox' . $que->id . '"><span class="checkbox-icon"></span> </label>
            </div>';
            })
            ->rawColumns(['action', 'status'])->toJson();
    }
    public function activate($id)
    {
        $activate =  Job::findOrFail($id);
        $activate->status = !$activate->status;
        if (isset($activate) && $activate->save()) {
            return $this->sendResponse(null, __('item_edited'));
        }
    }

    public function destroy($id)
    {
        Job::destroy($id);
        return $this->sendResponse(null, null);
    }
}
