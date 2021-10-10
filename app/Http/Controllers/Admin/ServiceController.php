<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(PAGINATION_COUNT);
        return view('admin.services.index', compact(['services']));
    }
    public function create()
    {
        $cats = Cat::where('type', 'الخدمات البيطرية')->get();
        return view('admin.services.create', compact(['cats']));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ar'        => 'required',
            'name_en'       => 'required',
            'desc_ar'          => 'required',
            'desc_en'         => 'required',
            'cat_id'             => 'required',
            'subcat_id'      => 'nullable',
            'photo'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $filePath = '';
        if ($request->has('photo')) {
            $filePath = uploadImage('services', $request->photo);
        }

        Service::create([
            'name'        => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'desc'          => ['ar' => $request->desc_ar, 'en' => $request->desc_en],
            'cat_id'       => $request->cat_id,
            'subcat_id'=> $request->subcat_id,
            'photo'        => $filePath,
        ]);

        notify()->success('تم اضافة الخدمة بنجاح');
        return redirect()->route('admin.services.index')->with(["success","تم اضافة الخدمة بنجاح"]);
    }

    public function edit($id)
    {
        $cats = SubCat::get();
        $service = Service::find($id);
        return view('admin.services.edit', compact(['service', 'cats']));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_ar'        => 'required',
            'name_en'       => 'required',
            'desc_ar'          => 'required',
            'desc_en'         => 'required',
            'cat_id'             => 'required',
            'subcat_id'      => 'nullable',
            'photo'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $filePath = '';
        if ($request->has('photo')) {
            $filePath = uploadImage('services', $request->photo);
        }

        Service::where('id', $id)->update([
            'name'     => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'desc'     => ['ar' => $request->desc_ar, 'en' => $request->desc_en],
            'cat_id'   => $request->cat_id,
            'subcat_id'   => $request->subcat_id,
            'photo'    => $filePath,
        ]);

        notify()->success('تم تعديل الخدمة بنجاح');
        return redirect()->route('admin.services.index')->with(["success","تم تعديل الخدمة بنجاح"]);
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        notify()->success('تم حذف الخدمة بنجاح');
        return redirect()->route('admin.services.index')->with(["success","تم حذف الخدمة بنجاح"]);
    }
}
