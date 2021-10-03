<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;
use App\Models\Subcat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubCatController extends Controller
{
    public function index()
    {
        $subcats = Subcat::paginate(PAGINATION_COUNT);
        return view('admin.subcats.index',compact('subcats'));
    }

    public function create()
    {
        $cats = Cat::get();
        return view('admin.subcats.create',compact('cats'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ar'     => 'required',
            'name_en'     => 'required',
            'cat_id'   => 'required' ,
            'photo'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.subcats.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $filePath = '';
        if ($request->has('photo')) {
            $filePath = uploadImage('subcats', $request->photo);
        }


        Subcat::create([
            'name'     => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'cat_id'     => $request->cat_id,
            'photo'     => $filePath,
        ]);

        notify()->success('تم اضافة بنجاح');
        return redirect()->route('admin.subcats')->with(["success","تم اضافة بنجاح"]);
    }

    public function edit($id)
    {
        $subcat = Subcat::find($id);
        $cats = Cat::get();
        return view('admin.subcats.edit',compact(['subcat','cats']));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name_ar'  => 'required',
            'name_en'  => 'required',
            'cat_id'   => 'required' ,
            'photo'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.subcats.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->has('photo')) {
            $filePath = uploadImage('subcats', $request->photo);
            Subcat::where('id',$id)
                ->update([
                    'photo' => $filePath,
                ]);
        }

        Subcat::where('id', $id)->update([
            'name'       => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'cat_id'     => $request->cat_id,
        ]);

        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.subcats')->with(["success","تم تحديث بيانات بنجاح"]);
    }
}
