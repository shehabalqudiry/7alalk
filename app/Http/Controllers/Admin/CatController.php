<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Subcat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CatController extends Controller
{
    public function index()
    {
        $cats = Cat::paginate(PAGINATION_COUNT);
        return view('admin.cats.index',compact('cats'));
    }

    public function create()
    {
        return view('admin.cats.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ar'     => 'required',
            'name_en'     => 'required',
            'type'        => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.cats.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        Cat::create([
            'name'     => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'type'     => $request->type,
        ]);

        notify()->success('تم اضافة البيانات بنجاح');
        return redirect()->route('admin.cats')->with(["success","تم اضافة البيانات بنجاح"]);
    }

    public function edit($id)
    {
        $cat = Cat::find($id);
        return view('admin.cats.edit',compact('cat'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name_ar'     => 'required',
            'name_en'     => 'required',
            'type'     => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.cats.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        Cat::where('id', $id)->update([
            'name'     => ['en' => $request->name_en, 'ar' => $request->name_ar],
            'type'     => $request->type,
        ]);

        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.cats')->with(["success","تم تحديث بيانات بنجاح"]);
    }


    public function getsubcat(Request $request)
    {
        $data   = [];
        $subcats = Subcat::where('cat_id',$request->cat)->get();

        foreach( $subcats as  $stat){
            if( $stat->cat_id != $request->cat){
                return response()->json('<option >لاتوجد بيانات</option>') ;
            }
            $data[] = '<option  value="'.$stat->id.'">'. $stat->name .'</option>';
        }
        return response()->json(["data" => $data]) ;
    }
}
