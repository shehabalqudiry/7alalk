<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\ClinicCat;
use App\Models\Image;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClinicController extends Controller
{
    public function index()
    {
        $clinics = Clinic::paginate(PAGINATION_COUNT);
        return view('admin.clinics.index', compact(['clinics']));
    }

    public function create()
    {
        $clinic_cats = ClinicCat::all();
        $regions = Region::all();
        return view('admin.clinics.create', compact([
            'clinic_cats', 'regions'
        ]));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name_ar'          => 'required',
            'name_en'          => 'required',
            'short_desc_ar'    => 'required',
            'short_desc_en'    => 'required',
            'long_desc_ar'     => 'required',
            'long_desc_en'     => 'required',
            'services'      => 'required',
            'location'      => 'required',
            'map_address'   => 'required',
            'region_id'     => 'required',
            'clinic_cat_id' => 'required',
            'images.*'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $clinic = Clinic::create([
            'name'          => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'short_desc'    => ['ar'=>$request->short_desc_ar, 'en'=> $request->short_desc_en],
            'long_desc'     =>  ['ar'=>$request->long_desc_ar, 'en'=> $request->long_desc_en],
            'services'      => $request->services,
            'location'      => $request->location,
            'map_address'   => $request->map_address,
            'region_id'     => $request->region_id,
            'clinic_cat_id' => $request->subcat_id,
        ]);

        $filePath = '';
        if ($request->has('images')) {
            foreach ($request->images as $image) {
                Image::create([
                    'file_name' => $image->hashName(),
                    'clinic_id' => $clinic->id,
                ]);
                $filePath = uploadImage('clinics/' . $request->name . '/', $image);
            }
        }
        notify()->success('تم اضافة العيادة بنجاح');
        return redirect()->route('admin.clinics.index');
    }

    public function edit($id)
    {
        $clinic = Clinic::find($id);
        return view('admin.clinics.edit', compact(['clinic']));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name_ar'          => 'required',
            'name_en'          => 'required',
            'short_desc_ar'    => 'required',
            'short_desc_en'    => 'required',
            'long_desc_ar'     => 'required',
            'long_desc_en'     => 'required',
            'services'      => 'required',
            'location'      => 'required',
            'map_address'   => 'required',
            'region_id'     => 'required',
            'clinic_cat_id' => 'required',
            'images.*'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $clinic = Clinic::where('id', $id)->update([
            'name'          => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'short_desc'    => ['ar'=>$request->short_desc_ar, 'en'=> $request->short_desc_en],
            'long_desc'     =>  ['ar'=>$request->long_desc_ar, 'en'=> $request->long_desc_en],
            'services'      => $request->services,
            'address'       => $request->address,
            'region_id'     => $request->region_id,
            'clinic_cat_id' => $request->clinic_cat_id,
        ]);

        $filePath = '';
        if ($request->has('images')) {
            foreach ($request->images as $image) {
                Image::updateOrCreate([
                    'file_name' => $image->hashName(),
                    'clinic_id' => $clinic->id,
                ]);
                $filePath = uploadImage('clinics/' . $request->name . '/', $image);
            }
        }
        
        notify()->success('تم تعديل بيانات العيادة بنجاح');
        return redirect()->route('admin.clinics.index');
    }

    public function destroy($id)
    {
        Clinic::findOrFail($id)->delete();
    }
}
