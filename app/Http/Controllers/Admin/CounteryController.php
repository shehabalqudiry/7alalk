<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CounteryController extends Controller
{
    public function index()
    {
        $countries = Countery::paginate(PAGINATION_COUNT);
        return view('admin.countries.index',compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'photo'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.countries.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $filePath = '';
        if ($request->has('photo')) {
            $filePath = uploadImage('countries', $request->photo);
        }

        Countery::create([
            'name'     => $request->name,
            'photo'    => $filePath,
        ]);

        notify()->success('تم اضافة دولة بنجاح');
        return redirect()->route('admin.countries')->with(["success","تم اضافة دولة بنجاح"]);
    }

    public function edit($id)
    {
        $countery = Countery::find($id);
        return view('admin.countries.edit',compact('countery'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'photo'    => 'required_without:id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.countries.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->has('photo')) {
            $filePath = uploadImage('countries', $request->photo);
            Countery::where('id',$id)
                ->update([
                    'photo' => $filePath,
                ]);
        }

        Countery::where('id', $id)->update([
            'name'     => $request->name,
        ]);


        return redirect()->route('admin.countries')->with(["success","تم تحديث بيانات الدولة بنجاح"]);
    }
}
