<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseModel;
use Illuminate\Support\Facades\Validator;

class CaseController extends Controller
{
    public function index($type)
    {
        $cases = CaseModel::where('type',$type)->paginate(PAGINATION_COUNT);

        return view('admin.cases.index',compact('cases', 'type'));
    }

    public function create($type)
    {
        return view('admin.cases.create', compact(['type']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ar'   => 'required',
            'name_en'   => 'required',
            'type'      => 'required',
        ]);
        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
            ->withErrors($validator)
                ->withInput();
        }
        CaseModel::create([
            'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'type' => $request->type,
        ]);

        notify()->success('تمت الاضافة بنجاح');
        return redirect()->route('admin.cases.index', $request->type)->with(["success", "تمت الاضافة بنجاح"]);
    }
    public function edit($type, $id)
    {
        $case = CaseModel::find($id);
        return view('admin.cases.edit', compact(['case', 'type']));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_ar'   => 'required',
            'name_en'   => 'required',
        ]);
        if ($validator->fails()) {
            notify()->error('حدث خطا ما برجاء المحاوله مرة اخري');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        CaseModel::where('id', $id)->update([
            'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
        ]);

        notify()->success('تم التعديل بنجاح');
        return redirect()->route('admin.cases.index', $request->type)->with(["success", "تم التعديل بنجاح"]);
    }
    public function destroy($type, $id)
    {
        CaseModel::where('type', $type)->find($id)->delete();
        return redirect()->back();
    }
}
