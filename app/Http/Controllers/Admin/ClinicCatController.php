<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClinicCatController extends Controller
{
    
    public function index()
    {
        $clinicCats = ClinicCat::paginate(PAGINATION_COUNT);
        return view('admin.clinic_cats.index', compact(['clinicCats']));
    }

    public function create()
    {
        return view('admin.clinic_cats.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ar'  => 'required',
            'name_en'  => 'required',
        ]);

        
        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        ClinicCat::create([
            'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
        ]);
        notify()->success('تم اضافة التخصص بنجاح');
        return redirect()->route('admin.clinic_cats.index')->with(["success","تم اضافة التخصص بنجاح"]);
    }

    public function edit($id)
    {
        $clinicCat = ClinicCat::findOrFail($id);
        return view('admin.clinic_cats.edit', compact('clinicCat'));
    }

    public function update(Request $request, $id)
    {
        $clinicCat = ClinicCat::find($id);

        $validator = Validator::make($request->all(), [
            'name_ar'  => 'required',
            'name_en'  => 'required',
        ]);
        
        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $clinicCat->update([
            'name'  => ['ar' => $request->name_ar, 'en' => $request->name_en],
        ]);
        notify()->success('تم تعديل التخصص بنجاح');
        return redirect()->route('admin.clinic_cats.index');
    }

    public function destroy($id)
    {
        ClinicCat::find($id)->delete();
        return redirect()->route('admin.clinic_cats.index');   
    }
}
