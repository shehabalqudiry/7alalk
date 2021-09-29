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
            'name'          => 'required',
            'short_desc'    => 'required',
            'long_desc'     => 'required',
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
            'name'          => $request->name,
            'short_desc'    => $request->short_desc,
            'long_desc'     => $request->long_desc,
            'services'      => $request->services,
            'location'      => $request->location,
            'map_address'   => $request->map_address,
            'region_id'     => $request->region_id,
            'clinic_cat_id' => $request->clinic_cat_id,
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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $clinic = Clinic::find($id);
        return view('admin.clinics.edit', compact(['clinic']));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'          => 'required',
            'short_desc'    => 'required',
            'long_desc'     => 'required',
            'services'      => 'required',
            'address'       => 'required',
            'region_id'     => 'required',
            'clinic_cat_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $clinic = Clinic::create([
            'name'          => $request->name,
            'short_desc'    => $request->short_desc,
            'long_desc'     => $request->long_desc,
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
        Clinic::find($id)->delete();
    }
}
