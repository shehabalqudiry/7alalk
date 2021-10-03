<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseModel;

class CaseController extends Controller
{
    public function index($type)
    {
        $cases = CaseModel::where('type',$type)->paginate(PAGINATION_COUNT);

        return view('admin.cases.index',compact('cases', 'type'));
    }
}
