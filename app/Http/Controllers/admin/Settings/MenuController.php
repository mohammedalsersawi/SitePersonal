<?php

namespace App\Http\Controllers\admin\Settings;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function index()
    {
        // return $data = Menu::query()
        // ->with('menuCategory', 'parent')
        // ->get();

        $categories =  MenuCategory::get();
        $menus =  Menu::get();
        return view('portal.admin.setting.index', compact('categories', 'menus'));
    }


    public function store(MenuRequest $request)
    {
        $data = [];
        foreach (locales() as $key => $language) {
            $data['name'][$key] = $request->get('name_' . $key);
        }
        $data['category_id'] = $request->category_id;
        $data['parent_id'] = $request->parent_id;
        $data['show_place'] = $request->show_place;
        $data['order'] = $request->order;
        $data['link'] = $request->link;
        Menu::create($data);
        return sendResponse(null, __('item_added'));
    }

    public function update(MenuRequest $request)
    {
        $data = [];
        foreach (locales() as $key => $language) {
            $data['name'][$key] = $request->get('name_' . $key);
        }
        $data['category_id'] = $request->category_id;
        $data['parent_id'] = $request->parent_id;
        $data['show_place'] = $request->show_place;
        $data['order'] = $request->order;
        $data['link'] = $request->link;
        $data_menu = Menu::find($request->id);
        $data_menu->update($data);
        return sendResponse(null, __('item_added'));
    }




    public function getData(Request $request)
    {
        $data = Menu::query()->with('MenuCategory', 'parent');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($que) {
                $data_attr = '';
                $data_attr .= 'data-id="' . @$que->id . '" ';
                $data_attr .= 'data-name="' . $que->name . '" ';
                foreach (locales() as $key => $value) {
                    $data_attr .= 'data-name_' . $key . '="' . $que->getTranslation('name', $key) . '" ';
                }
                $data_attr .= 'data-order="' . @$que->order . '" ';
                $data_attr .= 'data-category_id="' . @$que->category_id . '" ';
                $data_attr .= 'data-show_place="' . @$que->show_place . '" ';
                $data_attr .= 'data-link="' . @$que->link . '" ';
                $data_attr .= 'data-parent_id="' . @$que->parent_id . '" ';
                $string = '';
                $delete_route = "{{route('menu.delete',$que->id)}}";
                $string .= '<button class="edit_btn btn btn-sm btn-outline-primary btn_edit" data-toggle="modal" data-target="#modal_System" ' . $data_attr . '>
                <i class="bi bi-pencil-fill bi-xs"></i>
            </button>';
                $string .= ' <button type="button" class="btn btn-sm btn-outline-danger btn_delete" data-id="' . $que->id . '">
                <i class="bi bi-trash-fill bi-xs"></i>
            </button>';

                return $string;
            })
            ->addColumn('parent', function ($item) {
                return isset($item['parent']->name) ? $item['parent']->name : '---';
            })
            ->addColumn('category', function ($item) {
                return isset($item['MenuCategory']->name) ? $item['MenuCategory']->name : '---';
            })
            ->addColumn('status', function ($que) {
                $currentUrl = url('/');
                return '<div class="checkbox">
                <input class="activate-row"  url="' . $currentUrl . "/admin/menu/activate/" . $que->id . '" type="checkbox" id="checkbox' . $que->id . '" ' .
                    ($que->status ? 'checked' : '')
                    . '>
                <label for="checkbox' . $que->id . '"><span class="checkbox-icon"></span> </label>
            </div>';
            })
            ->rawColumns(['action', 'status'])->toJson();
    }


    public function activate($id)
    {
        $activate =  Menu::findOrFail($id);
        $activate->status = !$activate->status;
        if (isset($activate) && $activate->save()) {
            return sendResponse(null, __('item_edited'));
        }
    }

    public function destroy($id)
    {
        Menu::destroy($id);
        return sendResponse(null, null);
    }
}
