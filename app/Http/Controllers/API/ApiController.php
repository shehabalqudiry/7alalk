<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Cat;
use App\Models\Clinic;
use App\Models\ClinicCat;
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
                'email.required' => 'حقل البريد الالكتروني مطلوب',
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
        $Countries = Countery::get();
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

    public function clinic_cats()
    {
        $clinic_cats = ClinicCat::get();
        return $this->returnData('clinic_cats', $clinic_cats, 'تمت العملية بنجاح');
    }

    public function getCatClinics($cat_id)
    {
        $CatClinics = Clinic::where('clinic_cat_id', $cat_id)->get();
        return $this->returnData('clinic_cats', $CatClinics, 'تمت العملية بنجاح');
    }

    public function getRegionClinics($region_id)
    {
        $CatClinics = Clinic::where('region_id', $region_id)->get();
        return $this->returnData('clinic_cats', $CatClinics, 'تمت العملية بنجاح');
    }

    public function clinics()
    {
        $clinics = Clinic::get();
        return $this->returnData('clinics', $clinics, 'تمت العملية بنجاح');
    }

    public function clinic($id)
    {
        $clinic = Clinic::find($id);
        return $this->returnData('clinic', $clinic, 'تمت العملية بنجاح');
    }
    
    public function langs()
    {
        $langs = config('translatable.lang');
        return $this->returnData('langs', $langs, 'تمت العملية بنجاح');
    }
}
