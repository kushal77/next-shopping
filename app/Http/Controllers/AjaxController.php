<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AjaxController extends Controller
{
    public function changePassword()
    {
        $old_password = request()->old_password;
        $new_password = request()->new_password;

        $user = Auth::user();
        if (Hash::check($old_password, $user->password)) {
            $user->password = bcrypt($new_password);
            $user->save();

            return response()->json(['data' => 'Password Changed Successfully.', 'response' => true, 'status' => 200]);
        }

        return response()->json(['data' => 'Failed to change password.', 'response' => false, 'status' => 500]);
    }

    public function updateProfile()
    {
        $formData = request()->all();
        $formData['billing_address'] = json_encode([
            'region' => request()->region,
            'city' => request()->city
        ]);
        $formData['shipping_address'] = $formData['billing_address'];
        $user = Auth::user();

        if ($user->update($formData)) {
            return response()->json(['data' => 'Profile Updated Successfully.', 'response' => true, 'status' => 200]);
        }

        return response()->json(['data' => 'Failed to updated profile.', 'response' => false, 'status' => 500]);
    }
}
