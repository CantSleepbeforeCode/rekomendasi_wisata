<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use App\Models\Person;
use App\Models\User;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    private $maxSize = 1000048576;

    public function login(Request $request)
    {
        if ($request->method() == 'POST') {
            $user = User::where('username', $request->username)->first();
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                if ($user->level == 'admin') {
                    Auth::login($user);
                    return redirect('/wisata');
                } else {
                    return back()->with('error', 'Anda tidak memiliki akses!');
                }
            } else {
                return back()->with('error', 'Username atau Password salah!');
            }
        } else if ($request->method() == 'GET') {
            return view('auth.login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function wisata(Request $request)
    {
        $wisatas = Wisata::all();
        return view('admin.wisata', ['wisatas' => $wisatas]);
    }
    public function kuliner(Request $request)
    {
        $kuliners = Kuliner::all();
        return view('admin.kuliner', ['kuliners' => $kuliners]);
    }
    public function user(Request $request)
    {
        $persons = Person::all();
        return view('admin.person', ['persons' => $persons]);
    }
    public function addwisata(Request $request)
    {
        $data = new Wisata();
        $data->wisata_name = $request->wisata_name;
        $data->wisata_description = $request->wisata_description;
        $data->wisata_latitude = $request->wisata_latitude;
        $data->wisata_longitude = $request->wisata_longitude;
        $data->wisata_min_price = $request->wisata_min_price;
        $data->wisata_max_price = $request->wisata_max_price;

        $toPhoto = '/image';
        $image1 = $request->file('wisata_picture');
        $namePhoto1 = time() . "_" . strtolower(str_replace(" ", "_", $request->product_name)) . "_1.jpg";

        if ($image1->getSize() > $this->maxSize) {
            return redirect()->back()->with('error', 'Ukuran foto terlalu besar!');
        }

        $image1->move(public_path($toPhoto), $namePhoto1);
        $data->wisata_picture = $toPhoto . '/' . $namePhoto1;

        $data->save();
        return redirect()->back()->with('success', 'Berhasil menyimpan data');
    }

    public function addkuliner(Request $request)
    {
        $data = new Kuliner();
        $data->kuliner_name = $request->kuliner_name;
        $data->kuliner_description = $request->kuliner_description;
        $data->kuliner_latitude = $request->kuliner_latitude;
        $data->kuliner_longitude = $request->kuliner_longitude;
        $data->kuliner_min_price = $request->kuliner_min_price;
        $data->kuliner_max_price = $request->kuliner_max_price;

        $toPhoto = '/image';
        $image1 = $request->file('kuliner_picture');
        $namePhoto1 = time() . "_" . strtolower(str_replace(" ", "_", $request->product_name)) . "_1.jpg";

        if ($image1->getSize() > $this->maxSize) {
            return redirect()->back()->with('error', 'Ukuran foto terlalu besar!');
        }

        $image1->move(public_path($toPhoto), $namePhoto1);
        $data->kuliner_picture = $toPhoto . '/' . $namePhoto1;

        $data->save();
        return redirect()->back()->with('success', 'Berhasil menyimpan data');
    }
    public function adduser(Request $request)
    {
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
        return redirect()->back()->with('success', 'Berhasil menyimpan data');
    }

    public function editwisata(Request $request)
    {
        $data = Wisata::find($request->wisata_id);
        $data->wisata_name = $request->wisata_name;
        $data->wisata_description = $request->wisata_description;
        $data->wisata_latitude = $request->wisata_latitude;
        $data->wisata_longitude = $request->wisata_longitude;
        $data->wisata_min_price = $request->wisata_min_price;
        $data->wisata_max_price = $request->wisata_max_price;

        if ($request->has('wisata_picture')) {
            File::delete(public_path($data->wisata_picture));
            $toPhoto = '/image';
            $image1 = $request->file('wisata_picture');
            $namePhoto1 = time() . "_" . strtolower(str_replace(" ", "_", $request->product_name)) . "_1.jpg";

            if ($image1->getSize() > $this->maxSize) {
                return redirect()->back()->with('error', 'Ukuran foto terlalu besar!');
            }

            $image1->move(public_path($toPhoto), $namePhoto1);
            $data->wisata_picture = $toPhoto . '/' . $namePhoto1;
        }

        $data->save();
        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }
    public function editkuliner(Request $request)
    {
        $data = Kuliner::find($request->kuliner_id);
        $data->kuliner_name = $request->kuliner_name;
        $data->kuliner_description = $request->kuliner_description;
        $data->kuliner_latitude = $request->kuliner_latitude;
        $data->kuliner_longitude = $request->kuliner_longitude;
        $data->kuliner_min_price = $request->kuliner_min_price;
        $data->kuliner_max_price = $request->kuliner_max_price;

        if ($request->has('kuliner_picture')) {
            File::delete(public_path($data->kuliner_picture));
            $toPhoto = '/image';
            $image1 = $request->file('kuliner_picture');
            $namePhoto1 = time() . "_" . strtolower(str_replace(" ", "_", $request->product_name)) . "_1.jpg";

            if ($image1->getSize() > $this->maxSize) {
                return redirect()->back()->with('error', 'Ukuran foto terlalu besar!');
            }

            $image1->move(public_path($toPhoto), $namePhoto1);
            $data->kuliner_picture = $toPhoto . '/' . $namePhoto1;
        }

        $data->save();
        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }
    public function edituser(Request $request)
    {

        $data = Person::find($request->person_id);
        $data->person_name = $request->person_name;
        $data->person_phone = $request->person_phone;
        $data->person_email = $request->person_email;
        $data->person_age = $request->person_age;
        $data->person_address = $request->person_address;

        $data->save();

        $user = User::find($data->user_id);
        $user->username = $request->person_phone;

        if($request->password != null || $request->password != '') {
            $user->password = Hash::make($request->password);
        }

        $user->level = 'user';
        $user->save();
        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }
    public function deletewisata($id)
    {
        $data = Wisata::find($id);
        File::delete(public_path($data->wisata_picture));
        $data->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data ');
    }
    public function deletekuliner($id)
    {
        $data = Kuliner::find($id);
        File::delete(public_path($data->kuliner_picture));
        $data->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data ');
    }
    public function deleteuser($id)
    {
        $data = Person::find($id);
        $user = User::find($data->user_id);
        $user->delete();
        $data->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data ');
    }
}
