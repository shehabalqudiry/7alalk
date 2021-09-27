<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnimalsController extends Controller
{
    public function index()
    {
        $animals = Animal::paginate(PAGINATION_COUNT);
        return view('admin.animals.index',compact('animals'));
    }

    public function create()
    {
        return view('admin.animals.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.animals.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        Animal::create([
            'name'     => $request->name,
        ]);

        notify()->success('تم اضافة حيوان بنجاح');
        return redirect()->route('admin.animals')->with(["success","تم اضافة حيوان بنجاح"]);
    }

    public function edit($id)
    {
        $animal = Animal::find($id);
        return view('admin.animals.edit',compact('animal'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.animals.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        Animal::where('id', $id)->update([
            'name'     => $request->name,
        ]);

        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.animals')->with(["success","تم تحديث بيانات بنجاح"]);
    }
}
