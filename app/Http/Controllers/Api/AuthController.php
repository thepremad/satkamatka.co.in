<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\ResponseWithHttpRequest;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
	use ResponseWithHttpRequest;

	// UNAUTHORIZED ACCESS

	public function unauthorized_access()
	{
		return $this->sendFailed('YOU ARE NOT UNAUTHORIZED TO ACCESS THIS URL, PLEASE LOGIN AGAIN', 401);
	}
	
	// CREATE ACCOUNT API
	public function register(Request $request)
	{
		$error_message = 	[
			'mobile.required'            	  => 'Mobile should be required',
		];
		$rules = [
			'name' 		 => 'required',
			'mobile'	 => 'required|unique:users,mobile|digits:10',
			'password' 	 => 'required',
			'pin_number' => 'required'
		];
		$validator = Validator::make($request->all(), $rules, $error_message);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		try {
			\DB::beginTransaction();
			$user = new User();
			$user->fill($request->all());
			$user->role_id = 2;
			$user->password_2 = $request->password;
			$user->save();
			$access_token	  = $user->createToken($user->name)->plainTextToken;			
			$access_token 	  = explode('|', $access_token)[1];
			
			$user = User::find($user->id);
			\DB::commit();
			return $this->sendSuccess('USER REGISTER SUCCESSFULLY', ['access_token' => $access_token, 'profile_data' => new UserProfileCollection($user)]);
		} catch (\Throwable $e) {
			\DB::rollback();
			return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);
		}
	}

	public function login(Request $request)
	{
		$error_message = 	[
			'mobile.required'   => 'Mobile should be required',
		];
		$rules = [			
			'mobile'	 => 'required',
			'password' 	 => 'required',
		];
		$validator = Validator::make($request->all(), $rules, $error_message);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		try {
			\DB::beginTransaction();
			if(auth()->attempt(['mobile' => $request->mobile,'password' => $request->password])){
			$user = auth()->user();							
			$access_token	  = $user->createToken($user->name)->plainTextToken;
			$access_token 	  = explode('|', $access_token)[1];
			
			if($user->status == '1'){
			    $status = 'Active';
			}else{
			    $status = 'Inactive';
			}
			
			auth()->user()->status = $status;
			
			return $this->sendSuccess('USER LOIGN SUCCESSFULLY', ['access_token' => $access_token, 'profile_data' => new UserProfileCollection(auth()->user())]);			
			}else{
				return $this->sendFailed('WRONG CREDENTIALS', 400);
			}			
			\DB::commit();
		} catch (\Throwable $e) {
			\DB::rollback();
			return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);
		}
	}
	
	public function profile(Request $request)
	{
		$error_message = 	[
			'user_id.required'   => 'User Id should be required',
		];
		$rules = [
			'user_id'	 => 'required|exists:users,id',
		];
		$validator = Validator::make($request->all(), $rules, $error_message);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		try {
			$profile = User::find($request->user_id);
			return $this->sendSuccess('USER PROFILE GET SUCCESSFULLY', ['profile_data' => new UserProfileCollection($profile)]);
		} catch (\Throwable $e) {
			return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);
		}
	}


	function getNotification()

	{

		try {

			$notification_list     = auth()->user()->notification()->orderBy('id', 'desc')->get();

			if (count($notification_list) == 0) {

				return $this->sendFailed('NOTIFICATION NOT FOUND', 201);

			}

			return $this->sendSuccess('NOTIFICATION GET SUCCESSFULLY', NotificationCollection::collection($notification_list));

		} catch (\Throwable $e) {

			return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);

		}

	}





	public function forgotPassword(Request $request)

	{

		$error_message = 	[

			'email.required'    => 'Email address should be required',

			'email.exists'      => 'WE COULD NOT FOUND ANY EMAIL'

		];

		$rules = [

			'email'       		=> 'required|email|exists:users,email',

		];

		$validator = Validator::make($request->all(), $rules, $error_message);

		if ($validator->fails()) {

			return $this->sendFailed($validator->errors()->first(), 201);

		}

		try {

			$user_detail = User::where('email', $request->email)->first();

			if (!isset($user_detail)) {

				return $this->sendFailed('WE COULD NOT FOUND ANY ACCOUNT', 201);

			}

			$verifaction_otp = rand(1000, 9999);

			$email_data = ['user_name' => $user_detail->first_name, 'verifaction_otp' => $verifaction_otp];

			\Mail::to($user_detail->email)->send(new \App\Mail\ForgotPassword($email_data));

			return $this->sendSuccess('OTP SENT SUCCESSFULLY', ['user_id' => $user_detail->id, 'verifaction_otp' => $verifaction_otp, 'email' => $user_detail->email]);

		} catch (\Throwable $e) {

			return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);

		}

	}



	public function reset_password(Request $request)

	{

		$error_message = 	[

			'id.required'  		=> 'Id should be required',

			'password.required' => 'Password should be required',

		];

		$rules = [

			'id'        		=> 'required|numeric|exists:users,id',

			'password'      	=> 'required',

		];

		$validator = Validator::make($request->all(), $rules, $error_message);

		if ($validator->fails()) {

			return $this->sendFailed($validator->errors()->first(), 201);

		}

		try {

			$user_detail = User::find($request->id);

			if (!isset($user_detail)) {

				return $this->sendFailed('WE COULD NOT FOUND ANY ACCOUNT', 201);

			}

			\DB::beginTransaction();

			$user_detail->password = Hash::make($request->user_password);

			$user_detail->save();

			\DB::commit();

			return $this->sendSuccess('PASSWORD UPDATED SUCCESSFULLY');

		} catch (\Throwable $e) {

			\DB::rollback();

			return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);

		}

	}



	public function send_sms_otp($mobile_number, $verification_otp)

	{

		// 		return;

		// die;

		// $opt_url = "https://2factor.in/API/V1/fd9c6a99-19d7-11ec-a13b-0200cd936042/SMS/" . $mobile_number . "/" . $verification_otp . "/OTP_TAMPLATE";

		//$opt_url = "https://2factor.in/API/V1/786547ea-bbc8-11ec-9c12-0200cd936042/SMS/" . $mobile_number . "/" . $verification_otp . "/OTP_TAMPLATE";

		$opt_url = "https://2factor.in/API/V1/eaf9b2b6-d5b4-11ec-9c12-0200cd936042/SMS/" . $mobile_number . "/" . $verification_otp . "/FinalTemplate";

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $opt_url);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

		curl_setopt($curl, CURLOPT_PROXYPORT, "80");



		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($curl);

		// echo $result;die;

		return;

	}





	
	public function changeVisibleStatus()

	{

		try {

			\DB::beginTransaction();

			$change = User::find(auth()->user()->id)->update(['visible_status' => auth()->user()->visible_status == 'visible' ? 'invisible' : 'visible']);

			\DB::commit();

			return $this->sendSuccess('visible status change succssfully');

		} catch (\Throwable $e) {

			\DB::rollback();

			return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);

		}

	}



	public function logout()

	{

		try {

			\DB::beginTransaction();

			auth()->user()->carts()->delete();

			CouponCartMapping::where('user_id', auth()->user()->id)->delete();

			auth()->user()->token()->revoke();

			\DB::commit();

			return $this->sendSuccess('Logout succssfully');

		} catch (\Throwable $e) {

			\DB::rollback();

			return $this->sendFailed($e->getMessage() . ' on line ' . $e->getLine(), 400);

		}

	}



	public function deleteMyAccount()

	{

		try {

			DB::beginTransaction();

			auth()->user()->update([



				'email'				=> 'Deleted User',

				'password'			=> 'Deleted User',

				'unique_id' 		=> 'Deleted User',

				'social_media_id'	=> 'Deleted User',

				'mobile' 			=> 'Deleted User',

				'profile_pic' 		=> 'Deleted User',

				'device_token' 		=> 'Deleted User',

			]);

			auth()->user()->delete();



			// $user = auth()->user()->token();

			// $user->revoke();

			DB::commit();

			return $this->sendSuccess('YOUR ACCOUNT PERMANENTLY DELETE SUCCESSFULLY');

		} catch (\Throwable $th) {

			DB::rollBack();

			return $this->sendFailed($th->getMessage() . ' On line ' . $th->getLine(), 400);

		}

	}







	function version()

	{

		$version = Version::first();

		return $this->sendSuccess('VERSION GET SUCESS', ['version' => @$version->version]);

	}
	
	function userDelete(Request $request){
	    $error_message = 	[
			'user_id.required'            	  => 'Mobile should be required',
		];
		$rules = [
			'user_id'	 => 'required|exists:users,id',
		];
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		
		User::where('id',$request->user_id)->delete();
		return $this->sendSuccess('USER DELETE SUCESS','');
	}

}

