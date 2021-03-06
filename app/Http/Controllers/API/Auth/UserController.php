<?php

namespace App\Http\Controllers\API\Auth;
use App\User;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\OrderAsk;
use App\Models\Ordercheck;
use App\Models\ClinicOrder;
use App\Models\OrderFaq;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use GeneralTrait;

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['signup','verify']]);
    }

    public function signup(Request $request)
    {
        $rules = [
            'name'      => 'required|unique:users',
            'email'     => 'required|unique:users' ,
            'phone'     => 'required|unique:users' ,
            'countery'  => 'required' ,
            'region'    => 'required' ,
            'password'  => 'required' ,
            'fb_token'  => 'required' ,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        // $filepath = '';
        // if($request->has('photo'))
        // {
        //     $filepath = uploadImage('users', $request->photo);

        // }

        /* Get credentials from .env */
        // $phone = $request->phone;
        // $token = getenv("TWILIO_AUTH_TOKEN");
        // $twilio_sid = getenv("TWILIO_SID");
        // $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        // $twilio = new Client($twilio_sid, $token);
        // $twilio->verify->v2->services($twilio_verify_sid)
        //     ->verifications
        //     ->create($phone, "sms");

            $user = User::create([
                'name'         => $request->name ,
                'email'        => $request->email ,
                'password'     => Hash::make($request->password),
                'seenpass'     => $request->password,
                'phone'        => $request->phone ,
                'region'       => $request->region,
                'countery'     => $request->countery ,
                'type'         => 'user' ,
                'token'        => $request->fb_token ,
            ]);

        if(!$user)
            return $this -> returnError('001','Error created User');

        $credentials = $request -> only(['phone','password']) ;
        $token =  Auth::guard('api')->attempt($credentials);
        $user -> api_token = $token;

        return $this->returnData('data' , $user,'?????? ?????????????? ??????????');
    }

    public function verify(Request $request)
    {
        /* Get credentials from .env */
        // $phone = $request->phone;
        // $token = getenv("TWILIO_AUTH_TOKEN");
        // $twilio_sid = getenv("TWILIO_SID");
        // $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        // $twilio = new Client($twilio_sid, $token);
        // $verification = $twilio->verify->v2->services($twilio_verify_sid)
        //     ->verificationChecks
        //     ->create($request->code, array('to' => $phone));
        // if ($verification->valid) {

            tap(User::where('phone', $request->phone))->update(['isVerified' => true]);

            $credentials = $request -> only(['phone','password']) ;
            $token =  Auth::guard('api')->attempt($credentials);
            $user = Auth::guard('api')->user();
            $user -> api_token = $token;
            return $this -> returnData('user' , $user,'Done created User');
        // }else{
        //     return $this -> returnError('001','?????????? ?????? ????????');
        // }
    }

    public function addlocation(Request $request)
    {
        $rules = [
            'address'      => 'required|unique:users',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        User::where('id',Auth::id())->update([
            'address'         =>  $request->address ,
            'lat'             =>  $request->lat ,
            'lang'            =>  $request->lang ,
        ]);

        return $this->returnSuccessMessage('???? ??????????');
    }

    public function dataedituser()
    {
        $user = User::find(Auth::id());
        return $this -> returnData('data' , $user,'?????? ?????????????? ??????????');
    }


    public function editprofile(Request $request)
    {
        $rules = [
            'name'      => 'required|unique:users',
            'email'     => 'required|unique:users' ,
            'phone'     => 'required|unique:users' ,
            'photo'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        if($request->has('password'))
        {
            User::where('id',Auth::id())->update([
                'seenpass' => $request->password,
                'password' => Hash::make($request->password),
            ]);
        }

        if($request->has('photo'))
        {
            $path = uploadImage('users', $request->photo);
            User::where('id',Auth::id())->update([
                'photo' => $path,
            ]);
        }

        User::where('id',Auth::id())->update([
            'name'         =>  $request->name ,
            'email'        =>  $request->email ,
            'phone'        =>  $request->phone ,
            'countery'     => $request->countery ,
            'region'       =>  $request->region ,
        ]);

        return $this->returnSuccessMessage('???? ?????????? ?????????????????? ??????????');
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'password' => 'required|confirmed',
        ];

        $validator = Validator::make($request->password, $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        User::where('id', Auth::id())->update([
            'password' => Hash::make($request->password),
            'seenpass' => $request->password,
        ]);

    }

    public function makefaq(Request $request)
    {
        $rules = [
            'question'      => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $order = OrderFaq::where('user_id',Auth::id())->whereDate('created_at',date('Y-m-d'))->first();
        if($order){
            return $this->returnError('?????? ?????? ?????????? ???????????????? ???? ??????','502');
        }
        OrderFaq::create([
            'user_id'   => Auth::id() ,
            'question'  => $request->question
        ]);
        return $this->returnSuccessMessage('???? ??????????');

    }

    public function makeordercheck(Request $request)
    {
        $rules = [
            'name'           => 'required',
            'phone'          => 'required',
            'num_account'    => 'required',
            'animal_id'      => 'required',
            'number'         => 'required',
            'countery_id'    => 'required',
            'time'           => 'required',
            'address'        => 'required',
            'descibe'        => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $order = Ordercheck::where('user_id',Auth::id())->whereDate('created_at',date('Y-m-d'))->first();
        if($order){
            return $this->returnError('?????? ?????? ?????????? ???????????????? ???? ??????','502');
        }

        Ordercheck::create([
            'name'          => $request->name,
            'phone'         => $request->phone,
            'num_account'   => $request->num_account,
            'animal_id'     => $request->animal_id,
            'number'        => $request->number,
            'countery_id'   => $request->countery_id,
            'time'          => $request->time,
            'address'       => $request->address,
            'descibe'       => $request->descibe,
            'other_desc'    => $request->other_desc ,
            'user_id'       => Auth::id() ,
            'lat'           => $request->lat,
            'lang'          => $request->lang,
        ]);
        return $this->returnSuccessMessage('???? ??????????');
    }

    public function makeClinicOrder(Request $request)
    {
        $rules = [
            'name'           => 'nullable',
            'phone'          => 'nullable',
            'case_id'        => 'required',
            'animal_id'      => 'required',
            'region_id'      => 'required',
            'service_id'     => 'required',
            'type'           => 'required',
            'number'         => 'required',
            'time'           => 'required',
            'address'        => 'required',
            'descibe'        => 'nullable',
            'lat'            => 'nullable',
            'lang'           => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $order = ClinicOrder::where('user_id', Auth::id())->whereDate('created_at',date('Y-m-d'))->first();
        if($order){
            return $this->returnError('?????? ?????? ?????????? ???????????????? ???? ??????','502');
        }

        ClinicOrder::create([
            'name'          => $request->name,
            'phone'         => $request->phone,
            'case_id'       => $request->case_id,
            'animal_id'     => $request->animal_id,
            'number'        => $request->number,
            'number'        => $request->number,
            'region_id'     => $request->region_id,
            'time'          => $request->time,
            'address'       => $request->address,
            'descibe'       => $request->descibe,
            'user_id'       => Auth::id() ,
            'lat'           => $request->lat,
            'lang'          => $request->lang,
        ]);
        return $this->returnSuccessMessage('???? ??????????');
    }

    public function addTofav(Request $request) // Add To Favirote
    {
        auth()->user()->favoriteProducts()->create([
            'product_id'    => $request->product_id,
        ]);
        return $this->returnSuccessMessage('?????? ?????????????? ?????? ??????????????');
    }

    public function removeFromfav(Request $request) // Remove From Favirote
    {
        auth()->user()->favoriteProducts()->where('product_id', $request->product_id)->delete();
        return $this->returnSuccessMessage('?????? ?????????????? ?????? ??????????????');
    }

    public function getOffers() // Remove From Favirote
    {
        $offers = ApiResource::collection(auth()->user()->offers()->get());
        return $this->returnData('offers', $offers, '?????? ?????????????? ??????????');
    }

    // Reviews
    public function reviews($product_id)
    {
        $reviews = ApiResource::collection(Review::where('product_id', $product_id)->get());
        return $this->returnData('reviews', $reviews, '?????? ?????????????? ??????????');
    }

    
}
