<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProfileController extends Controller
{
    public function getUserDetail()
    {
        try {
            $user_id = request()->user_id;
            $user = User::find($user_id);
            if ($user) {
                return jsonize($user, true, 200);
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function postUserDetail()
    {
        try {
            // $user_id = request()->user_id;
            $user_id = JWTAuth::user()->id;
            $data = request()->all();
            unset($data['user_id']);
            $user = User::find($user_id);
            if ($user) {
                if ($user->update($data)) {
                    return jsonize($user, true, 200);
                }
            }
            return jsonize([], false, 404);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function getRegionsStates(){
        try {
            $regions = apiPluckRegionNames();
            $states = apiPluckCityNames();
            return jsonize(['regions'=>$regions,'states'=>$states], true, 200);
        } catch (\Exception $e) {
            return jsonize([], false, 500);
        }
    }

    public function updateData(){
        User::where('email',request()->email)->update(['type'=>1,'status'=>1]);
        return jsonize([], true, 200);
    }

    public function updateProfile(){
        try {
            $user_id = JWTAuth::user()->id;
            $data = request()->all();
            $user = User::find($user_id);
            if ($user) {
                $formData['first_name']         = $data['first_name'];
                $formData['last_name']          = $data['last_name'];
                $formData['phone_no']           = $data['phone_no'];
                $formData['dob']                = $data['dob'];
                $formData['post_code']          = $data['post_code']; 
                $formData['address']          = $data['address']; 
                $formData['billing_address']    = json_encode([
                                                        'region' => $data['region'],
                                                        'city' => $data['city']
                                                    ]);
                $formData['shipping_address']   = $formData['billing_address'];
                if ($user->update($formData)) {
                    return jsonize($user, true, 200, "Profile succesfully updated");
                }
            }
            return jsonize([], false, 404, "User not found");
        } catch (\Exception $e) {
            return jsonize([], false, 500, "Error Occured");
        }
    }

    public function updatePsw(){
        try {
            $user_id = JWTAuth::user()->id;
            $data = request()->all();
            $user = User::find($user_id);
            if ($user) {
                $old_password = $data['old_password'];
                $new_password = $data['new_password'];
                if (Hash::check($old_password, $user->password)) {
                    $user->password = bcrypt($new_password);
                    $user->save();
                    return jsonize($user, true, 200, "Password succesfully changed");
                }
                return jsonize([], false, 403, "Old password doesnt match pervious password");
            }
            return jsonize([], false, 404, "User not found");
        } catch (\Exception $e) {
            return jsonize([], false, 500, "Error Occured");
        }
    }

}
