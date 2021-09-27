<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Subcat;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(PAGINATION_COUNT);
        return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        $cats = Cat::get();
        $subcats = Subcat::get();
        return view('admin.products.create',compact(['cats','subcats']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'cat_id'     => 'required',
            'subcat_id'  => 'required',
            'amount'     => 'required',
            'type'       => 'required',
            'price'      => 'required',
            'offer'      => 'required',
            'short_desc' => 'required',
            'long_desc'  => 'required',
            'how_used'   => 'required',
            'end_date'   => 'required|date',
            'photos'     => 'required',
            'photos.*'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.products.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = [];
        if($request->hasfile('photos'))
        {
            foreach($request->file('photos') as $file)
            {
                $data[] = uploadImage('products', $file);
            }
        }

        Product::create([
            'name'     => $request->name,
            'photos'   => implode(',',$data),
            'cat_id'     => $request->cat_id,
            'subcat_id'  => $request->subcat_id,
            'amount'     => $request->amount,
            'type'       => $request->type,
            'price'      => $request->price,
            'price_delevery_free'   =>   $request->price_delevery_free ,
            'offer'      => $request->offer,
            'short_desc' => $request->short_desc,
            'long_desc'  => $request->long_desc,
            'how_used'   => $request->how_used,
            'end_date'   => $request->end_date,
            'status'      => 1
        ]);

        notify()->success('تم اضافة بنجاح');
        return redirect()->route('admin.products')->with(["success","تم اضافة بنجاح"]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $cats    = Cat::get();
        $subcat  = Subcat::where('cat_id',$product->cat_id)->first();
        return view('admin.products.edit',compact(['countery','cats','subcat']));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'cat_id'     => 'required',
            'subcat_id'  => 'required',
            'amount'     => 'required',
            'type'       => 'required',
            'price'      => 'required',
            'offer'      => 'required',
            'short_desc' => 'required',
            'long_desc'  => 'required',
            'how_used'   => 'required',
            'end_date'   => 'required|date',
            'photos'     => 'required_without:id',
            'photos.*'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect( route('admin.products.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->hasfile('photos'))
        {
            foreach($request->file('photos') as $file)
            {
                $data[] = uploadImage('products', $file);
            }
            Product::where('id',$id)
                ->update([
                    'photos'   => implode(',',$data),
                ]);
        }

        Product::where('id', $id)->update([
            'name'     => $request->name,
            'cat_id'     => $request->cat_id,
            'subcat_id'  => $request->subcat_id,
            'amount'     => $request->amount,
            'type'       => $request->type,
            'price'      => $request->price,
            'price_delevery_free'   =>   $request->price_delevery_free ,
            'offer'      => $request->offer,
            'short_desc' => $request->short_desc,
            'long_desc'  => $request->long_desc,
            'how_used'   => $request->how_used,
            'end_date'   => $request->end_date,
        ]);

        notify()->success('تم تحديث بيانات الدولة بنجاح');
        return redirect()->route('admin.counteries')->with(["success","تم تحديث بيانات الدولة بنجاح"]);
    }
}
