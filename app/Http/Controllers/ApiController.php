<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use App\Http\Resources\LoginResource;
use App\Models\Kuliner;
use App\Models\Person;
use App\Models\User;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function listWisata()
    {
        return new DataResource(true, 'success', Wisata::all());
    }

    public function listKuliner()
    {
        return new DataResource(true, 'success', Kuliner::all());
    }
    public function detailWisata($id)
    {
        return new DataResource(true, 'success', Wisata::find($id));
    }

    public function detailKuliner($id)
    {
        return new DataResource(true, 'success', Kuliner::find($id));
    }

    public function register(Request $request)
    {
        $user = User::where('username', $request->person_phone)->first();
        if($user) {
            return new LoginResource(false, 'registered');
        }
        $user = new User();
        $user->username = $request->person_phone;
        $user->password = Hash::make($request->password);
        $user->level = 'user';
        $user->save();

        $data = new Person();
        $data->user_id = $user->user_id;
        $data->person_name = $request->person_name;
        $data->person_phone = $request->person_phone;
        $data->person_email = $request->person_email;
        $data->person_age = $request->person_age;
        $data->person_address = $request->person_address;

        $data->save();
        return new LoginResource(true, 'success');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return new LoginResource(true, 'success');
        } else {
            return new LoginResource(false, 'failed');
        }
    }
}
