<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subcat;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(PAGINATION_COUNT);
        return view('admin.products.index', compact('products'));
    }
    // Reviews
    public function reviews()
    {
        $reviews = Review::paginate(PAGINATION_COUNT);
        return view('admin.products.reviews', compact('reviews'));
    }

    public function deleteReview($id)
    {
        Review::find($id)->delete();
        return redirect()->route('admin.products.reviews');
    }
    // End Reviews

    public function create()
    {
        $cats = Cat::get();
        $subcats = Subcat::get();
        return view('admin.products.create', compact(['cats', 'subcats']));
    }

    public function store(Request $request)
    {
        $rules = [
            'name_ar'       => 'required',
            'name_en'       => 'required',
            'cat_id'     => 'required',
            'subcat_id'  => 'required',
            'amount'     => 'required',
            'type'       => 'required',
            'price'      => 'required',
            'offer'      => 'required',
            'short_desc_ar' => 'required',
            'short_desc_en' => 'required',
            'long_desc_ar'  => 'required',
            'long_desc_en'  => 'required',
            'how_used_ar'   => 'required',
            'how_used_en'   => 'required',
            'end_date'   => 'required|date',
            'photos'     => 'required_without:id',
            'photos.*'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect(route('admin.products.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $data = [];
        if ($request->hasfile('photos')) {
            foreach ($request->file('photos') as $file) {
                $data[] = uploadImage('products', $file);
            }
        }

        Product::create([
            'name'     => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'photos'   => implode(',', $data),
            'cat_id'     => $request->cat_id,
            'subcat_id'  => $request->subcat_id,
            'amount'     => $request->amount,
            'type'       => $request->type,
            'price'      => $request->price,
            'price_delevery_free'   =>   $request->price_delevery_free,
            'offer'      => $request->offer,
            'short_desc' => ['ar' => $request->short_desc_ar, 'en' => $request->short_desc_en],
            'long_desc'  => ['ar' => $request->long_desc_ar, 'en' => $request->long_desc_en],
            'how_used'   => ['ar' => $request->how_used_ar, 'en' => $request->how_used_en],
            'end_date'   => $request->end_date,
            'status'      => 1
        ]);

        notify()->success('تم اضافة بنجاح');
        return redirect()->route('admin.products')->with(["success", "تم اضافة بنجاح"]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $cats    = Cat::get();
        $subcat  = Subcat::where('cat_id', $product->cat_id)->first();
        return view('admin.products.edit', compact(['product', 'cats', 'subcat']));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_ar'       => 'required',
            'name_en'       => 'required',
            'cat_id'     => 'required',
            'subcat_id'  => 'required',
            'amount'     => 'required',
            'type'       => 'required',
            'price'      => 'required',
            'offer'      => 'required',
            'short_desc_ar' => 'required',
            'short_desc_en' => 'required',
            'long_desc_ar'  => 'required',
            'long_desc_en'  => 'required',
            'how_used_ar'   => 'required',
            'how_used_en'   => 'required',
            'end_date'   => 'required|date',
            'photos'     => 'required_without:id',
            'photos.*'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect(route('admin.products.create'))
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasfile('photos')) {
            foreach ($request->file('photos') as $file) {
                $data[] = uploadImage('products', $file);
            }
            Product::where('id', $id)
                ->update([
                    'photos'   => implode(',', $data),
                ]);
        }

        Product::where('id', $id)->update([
            'name'     => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'cat_id'     => $request->cat_id,
            'subcat_id'  => $request->subcat_id,
            'amount'     => $request->amount,
            'type'       => $request->type,
            'price'      => $request->price,
            'price_delevery_free'   =>   $request->price_delevery_free,
            'offer'      => $request->offer,
            'short_desc' => ['ar' => $request->short_desc_ar, 'en' => $request->short_desc_en],
            'long_desc'  => ['ar' => $request->long_desc_ar, 'en' => $request->long_desc_en],
            'how_used'   => ['ar' => $request->how_used_ar, 'en' => $request->how_used_en],
            'end_date'   => $request->end_date,
        ]);

        notify()->success('تم تحديث بيانات المنتج بنجاح');
        return redirect()->route('admin.products')->with(["success", "تم تحديث بيانات المنتج بنجاح"]);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        notify()->success('تم حذف المنتج بنجاح');
        return redirect()->route('admin.products')->with(["success", "تم حذف المنتج بنجاح"]);
    }
}
