<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {

        return view('backend.user.index', [
            'users' => User::get()
        ]);
    }

    public function registerProses(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
        ]);

        // Create the new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();

        // Optionally, you can log in the user automatically after registration
        // auth()->login($user);

        // Redirect to a success page or to the login page
        return redirect('/kelola-user')->with('success', 'Admin berhasil ditambahkan');
    }

    public function register_admin()
    {
        return view('backend.user.create');
    }

    public function showProfile()
    {

        $order_utama = \App\Models\Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $user = Auth::check();
        if ($user == false) {
            $notif = 0;
        } else if ($order_utama) {
            $notif = \App\Models\OrderItem::where('order_id', $order_utama->id)->count();
        } else {
            $notif = 0;
        }

        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();

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

        return view('frontend.profil.index', compact('user', 'addresses', 'notif', 'provinsi'));
    }

    public function getKotaaa($id)
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

    public function editUser(Request $request, $id)
    {

        $user = User::findOrFail($id);

        // Melakukan pembaruan data pada user
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->telephone = $request->input('telephone');
        $user->save();

        // Update addresses if needed
        $addresses = Address::where('user_id', $id)->get();

        foreach ($addresses as $address) {
            // Cek dan update atribut jika input tidak kosong
            if ($request->has('provinsi') && $request->input('provinsi') !== null) {
                $address->provinsi = $request->input('provinsi');
            }
            if ($request->has('kota') && $request->input('kota') !== null) {
                $address->kota = $request->input('kota');
            }
            if ($request->has('detail') && $request->input('detail') !== null) {
                $address->detail = $request->input('detail');
            }
            $address->save();
        }
        return redirect('/home')->with('success', 'Profil berhasil diperbarui.');
    }



    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('kelola-user')->with('success', 'Data berhasil dihapus');
    }
}
