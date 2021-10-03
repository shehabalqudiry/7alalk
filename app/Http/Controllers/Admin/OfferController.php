<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{

    public function index()
    {
        $offers = Offer::paginate(PAGINATION_COUNT);
        return view('admin.offers.index', compact(['offers']));
    }

    public function create()
    {
        $users = User::get();
        $products = Product::get();
        return view('admin.offers.create', compact(['users', 'products']));
    }

    public function store(Request $request)
    {
        $rules = [
            'offer'       => 'required',
            'desc'        => 'required',
            'start'       => 'required|date',
            'end'         => 'required|date',
            'status'      => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $offer = Offer::create([
            'offer'         => $request->offer,
            'desc'          => $request->desc,
            'start'         => $request->start,
            'end'           => $request->end,
            'status'        => $request->status,
        ]);

        foreach ($request->users as $user) {
            DB::table('offer_user')->insert([
                'offer_id'      => $offer->id,
                'user_id'    => $user->id,
            ]);
        }
        
        foreach ($request->products as $product) {
            DB::table('offer_product')->insert([
                'offer_id'      => $offer->id,
                'product_id'    => $product->id,
            ]);
        }
        notify()->success('تم اضافة العرض بنجاح');
        return redirect()->route('admin.offer.index')->with(["success", "تم اضافة العرض بنجاح"]);
    }

    public function edit(Offer $offer)
    {
        $users = User::get();
        $products = Product::get();
        return view('admin.offers.edit', compact(['offer', 'users', 'products']));
    }

    public function update(Request $request, Offer $offer)
    {
        $rules = [
            'offer'       => 'required',
            'desc'        => 'required',
            'start'       => 'required|date',
            'end'         => 'required|date',
            'status'      => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $offer->update([
            'offer'         => $request->offer,
            'desc'          => $request->desc,
            'start'         => $request->start,
            'end'           => $request->end,
            'status'        => $request->status,
        ]);
        foreach ($request->users as $user) {
            DB::table('offer_user')->updateOrInsert([
                'offer_id'   => $offer->id,
                'user_id'    => $user->id,
            ]);
        }
        
        foreach ($request->products as $product) {
            DB::table('offer_product')->updateOrInsert([
                'offer_id'      => $offer->id,
                'product_id'    => $product->id,
            ]);
        }

        notify()->success('تم تعديل العرض بنجاح');
        return redirect()->route('admin.offer.index')->with(["success", "تم تعديل العرض بنجاح"]);
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
    }
}
