<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClinicOrderController extends Controller
{
    public function index()
    {
        $orders = ClinicOrder::paginate(PAGINATION_COUNT);
        return view('admin.clinics.orders.index')->with($orders);
    }
    
    public function destroy($id)
    {
        ClinicOrder::findOrFail($id)->delete();
        return redirect()->route('admin.orders.index');
    }
}
