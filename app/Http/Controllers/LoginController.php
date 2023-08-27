<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil, redirect ke halaman yang sesuai
            $user = Auth::user();
            if ($user->role == 'Administrator' || $user->role == 'Admin') {
                Alert::success('Sukses', 'Anda Berhasil Login.');
                return redirect()->intended('/dashboard');
            } elseif ($user->role == 'Pelanggan') {
                Alert::success('Sukses', 'Anda Berhasil Login.');
                return redirect()->intended('/home');
            }
        }

        // Autentikasi gagal, redirect kembali ke halaman login dengan pesan error
        Alert::error(session('error', 'Username atau password salah'));
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Alert::success('Berhasil Keluar', 'Anda telah berhasil keluar.');

        return redirect('/login');
    }

    public function register(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 7f3e1b2d76cf6c4ae9705304a655d0e3"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        $provinsi = json_decode($response);
        return view('auth.register', compact('provinsi'));
    }

    public function getKotaa($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 7f3e1b2d76cf6c4ae9705304a655d0e3"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }


    public function registerproses(Request $request)
    {

        // Validate the user input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'telephone' => 'required|numeric',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'detail' => 'required|string',
            // tambahkan validasi untuk kolom lain yang Anda perlukan
        ]);
    
        // Simpan data ke dalam tabel 'users'
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->telephone = $validatedData['telephone'];
        $user->password = bcrypt($validatedData['password']);
        
        $user->save();
    
        // Simpan data ke dalam tabel 'address'
        $address = new Address();
        $address->user_id = $user->id;
        $address->provinsi = $validatedData['provinsi'];
        $address->kota = $validatedData['kota'];
        $address->detail = $validatedData['detail'];
    
        $address->save();
       
        return redirect('/login')->with('success', 'Registrasi berhasil silahkan login.');
    }
}
