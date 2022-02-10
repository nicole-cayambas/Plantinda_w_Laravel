<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;

class ProfileController extends Controller
{   
    public function index()
    {
        $user = auth()->user();       
        $address = Address::find($user->address_id);
        return view('profile.editProfile')->with('user', $user)->with('address', $address);
    }
    public function updateProfile(Request $request){
        $user = auth()->user();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->save();
        return redirect()->back()->with('success', 'Profile Updated');
    }
    public function editAddress()
    {
        $user = auth()->user();
        $address = Address::find($user->id);
        return view('profile.editAddress')->with('user', $user)->with('address', $address);

    }
    public function updateAddress(Request $request){
        $user = auth()->user();
        if(auth()->user()->address_id != null){
            $address = Address::find($user->address_id);
            $address->first_name = $request->input('first-name');
            $address->last_name = $request->input('last-name');
            $address->phone_number = $request->input('phone-number');
            $address->address = $request->input('street-address');
            $address->barangay = $request->input('barangay');
            $address->city = $request->input('city');
            $address->zip = $request->input('zip-code');
            $address->province = $request->input('province');
            $address->save();
            $user->save();
        } else {
            $address = new Address;
            $address->user_id = $user->id;
            $address->first_name = $request->input('first-name');
            $address->last_name = $request->input('last-name');
            $address->phone_number = $request->input('phone-number');
            $address->address = $request->input('street-address');
            $address->barangay = $request->input('barangay');
            $address->city = $request->input('city');
            $address->zip = $request->input('zip-code');
            $address->province = $request->input('province');
            $address->save();
            $user->address_id = $address->id;
            $user->save();
        }
        return redirect()->back()->with('success', 'Address Updated');
    }
}
