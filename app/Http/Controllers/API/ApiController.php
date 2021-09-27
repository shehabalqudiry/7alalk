<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Cat;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Twilio\Rest\Client;
use App\User;
use App\Models\Region;
use App\Models\Countery;
use App\Models\Faq;
use App\Models\Subcat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ApiController extends Controller
{
    use GeneralTrait;

    public function logins(Request $request)
    {
        try {
            $rules = [
                "email"     => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules, [
                'email.required' => 'حقل الاسم مطلوب',
                'password.required' => 'حقل كلمة السر مطلوب',
            ]);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            //login
            $credentials = $request->only(['email', 'password']);
            if (Auth::guard('api')->attempt($credentials)) {
                $user = Auth::guard('api')->user();
                $user->api_token = Auth::guard('api')->attempt($credentials);
                return $this->returnData('data', $user, 'Login successfully');
            } else {
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function regions()
    {
        $regions = Region::get();
        return $this->returnData('regions', $regions, 'تمت العملية بنجاح');
    }

    public function Countries()
    {
        $Countries = Region::get();
        return $this->returnData('Countries', $Countries, 'تمت العملية بنجاح');
    }

    public function animals()
    {
        $animals = Animal::get();
        return $this->returnData('animals', $animals, 'تمت العملية بنجاح');
    }

    public function cats()
    {
        $cats = Cat::get();
        return $this->returnData('cats', $cats, 'تمت العملية بنجاح');
    }

    public function subcats($id)
    {
        $subcats = Subcat::where('cat_id', $id)->get();
        return $this->returnData('subcats', $subcats, 'تمت العملية بنجاح');
    }

    public function faqs()
    {
        $faqs = Faq::get();
        return $this->returnData('faqs', $faqs, 'تمت العملية بنجاح');
    }
}
