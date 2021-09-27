<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\OrderFaq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FaqConroller extends Controller
{
    public function index()
    {
        $faqs = Faq::paginate(PAGINATION_COUNT);
        return view('admin.faqs.index',compact('faqs'));
    }

    public function orders()
    {
        $orders = OrderFaq::paginate(PAGINATION_COUNT);
        return view('admin.faqs.orders',compact('orders'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question'     => 'required',
            'answer'     => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.faqs.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        Faq::create([
            'question'   => $request->question,
            'answer'     => $request->answer,
        ]);

        notify()->success('تم اضافة بنجاح');
        return redirect()->route('admin.faqs')->with(["success","تم اضافة بنجاح"]);
    }

    public function edit($id)
    {
        $faq = Faq::find($id);
        return view('admin.faqs.edit',compact('faq'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'question'     => 'required',
            'answer'     => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.faqs.edit',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        Faq::where('id', $id)->update([
            'question'   => $request->question,
            'answer'     => $request->answer,
        ]);

        notify()->success('تم تحديث بيانات بنجاح');
        return redirect()->route('admin.faqs')->with(["success","تم تحديث بيانات بنجاح"]);
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);
        if(!$faq){
            notify()->success('هذا الاي دي غير موجود من قبل');
            return redirect()->route('admin.faqs')->with(["error","هذا الاي دي غير موجود من قبل"]);
        }
        $faq->delete();
        notify()->success('تم بنجاح');
        return redirect()->route('admin.faqs')->with(["success","تم بنجاح"]);
    }
}
