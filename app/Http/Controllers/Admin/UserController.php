<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Countery;
use App\Models\Region;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index($type)
    {
        $users = User::where('type',$type)->paginate(PAGINATION_COUNT);

        return view('admin.users.index',compact('users'));
    }

    public function create($type)
    {
        $counteries = Countery::get();
        $regions = Region::get();
        return view('admin.users.create',compact(['counteries','regions','type']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'countery'     => 'required',
            'region'       => 'required',
            'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'        => 'required|email|unique:users',
            'password'     => 'required|min:8',
            'phone'        => 'required|unique:users',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.users.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $filepath = '';
        if( $request->has('image')){
            $filepath = uploadImage('users', $request->image);
        }
        User::create([
            'name'         => $request->name,
            'photo'        => $filepath,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'isVerified'   => true ,
            'phone'        => $request->phone,
            'type'         => $request->type ,
            'countery'     => $request->countery ,
            'region'       => $request->region
        ]);

        notify()->success('تم اضافة مستخدمين بنجاح');
        return redirect()->route('admin.users')->with(["success","تم اضافة مستخدمين بنجاح"]);
    }


    public function edit($id)
    {
        $user = User::find($id);
        $counteries = Countery::get();
        $regions = Region::get();
        return view('admin.users.edit',compact(['user','counteries','regions']));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'        => 'required|email|unique:users',
            'phone'        => 'required|unique:users',
            'countery'     => 'required',
            'region'       => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.users.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->has('image')) {
            $filePath =uploadImage('users', $request->person_image);
            User::where('id',$id)
                ->update([
                    'photo' => $filePath,
                ]);
        }elseif($request->has('password')){
            User::where('id',$id)
                ->update([
                    'password' => Hash::make($request->password),
                ]);
        }


        User::where('id', $id)->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'isVerified'   => true ,
            'phone'        => $request->phone,
            'countery'     => $request->countery ,
            'region'       => $request->region
        ]);

        notify()->success('تم تحديث بيانات مستخدمين بنجاح');
        return redirect()->route('admin.users')->with(["success","تم تحديث بيانات مستخدمين بنجاح"]);
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        
    }

    public function destroy($id)
    {
        try {
            $sales = User::find($id);
            if (!$sales){
                notify()->error("هذا مستخدمين غير موجود");
                return redirect()->route('admin.users')->with(['error' => 'هذا مستخدمين غير موجود ']);
            }

            $sales->delete();
            notify()->success("تم حذف مستخدمين بنجاح");
            return redirect()->route('admin.users')->with(['success' => 'تم حذف مستخدمين بنجاح']);

        } catch (\Exception $ex) {
            notify()->error("حدث خطا ما برجاء المحاوله لاحقا");
            return redirect()->route('admin.users')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
