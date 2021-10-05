<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller 
{
    public function index()
    {
        $packages = Package::paginate(PAGINATION_COUNT);
        return view('admin.packages.index', compact(['packages']));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'desc_ar'        => 'required',
            'desc_en'        => 'required',
            'price'          => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        Package::create([
            'name'          => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'desc'          => ['en' => $request->desc_en, 'ar' => $request->desc_ar],
            'price'        => $request->price,
        ]);

        notify()->success('تم اضافة الباقة بنجاح');
        return redirect()->route('admin.packages.index')->with(["success", "تم اضافة الباقة بنجاح"]);
    }

    public function edit($id)
    {
        $package = Package::find($id);
        return view('admin.packages.edit', compact(['package']));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'desc_ar'        => 'required',
            'desc_en'        => 'required',
            'price'          => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        Package::where('id', $id)->update([
            'name'          => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'desc'          => ['en' => $request->desc_en, 'ar' => $request->desc_ar],
            'price'        => $request->price,
        ]);

        notify()->success('تم اضافة الباقة بنجاح');
        return redirect()->route('admin.packages.index')->with(["success", "تم اضافة الباقة بنجاح"]);
    }

    public function destroy($id)
    {
        Package::findOrFail($id)->delete();
        notify()->success('تم حذف الباقة بنجاح');
        return redirect()->route('admin.packages.index')->with(["success", "تم حذف الباقة بنجاح"]);
    }
}