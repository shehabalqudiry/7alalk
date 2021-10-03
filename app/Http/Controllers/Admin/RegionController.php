<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::paginate(PAGINATION_COUNT);
        return view('admin.regions.index',compact('regions'));
    }

    public function create()
    {
        return view('admin.regions.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.regions.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        Region::create([
            'name'     => $request->name,
        ]);

        notify()->success('تم اضافة regions بنجاح');
        return redirect()->route('admin.regions')->with(["success","تم اضافة مناطق بنجاح"]);
    }

    public function edit($id)
    {
        $region = Region::find($id);
        return view('admin.regions.edit',compact('region'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.regions.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        Region::where('id', $id)->update([
            'name'     => $request->name,
        ]);

        notify()->success('تم تحديث بيانات مناطق بنجاح');
        return redirect()->route('admin.regions')->with(["success","تم تحديث بيانات مناطق بنجاح"]);
    }
}
