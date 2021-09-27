<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HelpersAdminController extends Controller
{

    public function index()
    {
        $admins = Admin::select('id','name','email','photo')->where('id','!=',1)->paginate(PAGINATION_COUNT);
        return view('admin.helpers.index',compact('admins'));
    }

    public function create()
    {
        return view('admin.helpers.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:admins,name',
            'photo'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:8'

        ],[
            "photo.max"                    =>  'حجم الصورة كبيرا جدا اختر صورة حجمهااقل' ,
            "photo.image"                  =>  'عفوا هذة ليست صورة برجاء اختيار صورة' ,
            "name.unique"                  =>  'هذا الاسم موجود من قبل',
            "email.unique"                 =>  'هذا الايميل موجود من قبل' ,
            'password.required'             => 'كلمة السر مطلوبة' ,
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.helpers.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $filePath = '';
        if ($request->has('photo')) {
            $filePath = uploadImage('helpers', $request->photo);
        }

        Admin::create([
            "name"     => $request->name ,
            "email"    => $request->email ,
            'photo'     => $filePath  ,
            "password" =>  Hash::make($request->password),
        ]);

        notify()->success('تم اضافة مشرف بنجاح');
        return redirect()->route('admin.helpers')->with(["success","تم اضافة مشرف بنجاح"]);
    }

    public function edit($id)
    {
        $admin = Admin::select('id','name','email','photo')->find($id);
        return view('admin.helpers.edit',compact('admin'));
    }

    public function update(Request $request , $id){

        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:users,name,'.$id,
            'photo'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'    => 'required|email|unique:users,email,'.$id,

        ],[
            "photo.max"                    =>  'حجم الصورة كبيرا جدا اختر صورة حجمهااقل' ,
            "photo.image"                  =>  'عفوا هذة ليست صورة برجاء اختيار صورة' ,
            "name.unique"                  =>  'هذا الاسم موجود من قبل',
            "email.unique"                 =>  'هذا الايميل موجود من قبل' ,
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.helpers.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->has('photo')) {
            $filePath = uploadImage('helpers', $request->photo);
            Admin::where('id',$id)
                ->update([
                    'photo' => $filePath,
                ]);
        }

        Admin::where('id', $id)->update([
            "name"     => $request->name ,
            "email"    => $request->email ,
            "password" => $request->has('password') ? Hash::make($request->password) : $request->password,
        ]);

        notify()->success('تم تحديث بيانات المشرف بنجاح');
        return redirect()->route('admin.helpers')->with(["success","تم تحديث بيانات المشرف بنجاح"]);

    }

    public function destroy($id)
    {
        try {
            $admin = Admin::find($id);
            if (!$admin){
                notify()->error("هذا المشرف غير موجود");
                return redirect()->route('admin.helpers')->with(['error' => 'هذا المشرف غير موجود ']);
            }

            $admin->delete();
            notify()->success("تم حذف المستخدم بنجاح");
            return redirect()->route('admin.helpers')->with(['success' => 'تم حذف المستخدم بنجاح']);

        } catch (\Exception $ex) {
            notify()->error("حدث خطا ما برجاء المحاوله لاحقا");
            return redirect()->route('admin.helpers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}

