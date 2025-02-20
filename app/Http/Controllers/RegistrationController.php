<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class RegistrationController extends Controller
{
    public function step1()
    {
        return view('auth.register.step1');
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $request->session()->put('auth_data', $validated);
        return redirect()->route('register.step2');
    }
    public function step2()
    {
        if (!session()->has('auth_data')) {
            return redirect()->route('register.step1');
        }

        return view('auth.register.step2', [
            'jenis_usaha' => [
                'Makanan & Minuman',
                'Jasa',
                'Fashion dan Kerajinan',
                'Pertanian dan Peternakan',
                'Toko Kelontong / Warung',
            ]
        ]);
    }

    public function storeStep2(Request $request)
    {
        $data = $request->validate([
            'jenis_usaha' => 'required',
            'deskripsi' => 'required',
            'tahun_berdiri' => 'required|digits:4|numeric',
            'jumlah_karyawan' => 'required|integer|min:1',
            'alamat_usaha' => 'required',
        ]);

        $request->session()->put('registration_data', $data);

        return redirect()->route('register.step3');
    }

    public function step3()
    {
        if (!session()->has('registration_data')) {
            return redirect()->route('register.step2');
        }
        return view('auth.register.step3');
    }
    public function storeStep3(Request $request)
    {
        $request->validate([
            'products.*.name' => 'required|string|max:255',
            'products.*.description' => 'required|string|max:1000',
            'products.*.images.*' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        $products = [];
        foreach ($request->products as $key => $product) {
            $images = [];
            if ($request->hasFile("products.{$key}.images")) {
                foreach ($request->file("products.{$key}.images") as $image) {
                    $images[] = $image->store('product_images', 'public');
                }
            }

            $products[] = [
                'name' => $product['name'],
                'description' => $product['description'],
                'images' => $images
            ];
        }

        $request->session()->put('product_data', $products);
        return redirect()->route('register.step4');
    }

    public function step4()
    {
        if (!session()->has('product_data')) {
            return redirect()->route('register.step3');
        }
        return view('auth.register.step4');
    }
    public function storeStep4(Request $request)
    {
        $request->validate([

            'nib' => 'required|mimes:pdf|max:2048',
            'surat_pengantar' => 'required|mimes:pdf|max:2048',
        ]);
        $registrationData = $request->session()->get('registration_data');
        $authData = $request->session()->get('auth_data');
        $productData = $request->session()->get('product_data');

        $user = User::create([
            'name' => $authData['name'],
            'email' => $authData['email'],
            'password' => bcrypt($authData['password']),
            'role' => 'umkm',
            'status' => 'pending',
            'jenis_usaha' => $registrationData['jenis_usaha'],
            'deskripsi' => $registrationData['deskripsi'],
            'tahun_berdiri' => $registrationData['tahun_berdiri'],
            'jumlah_karyawan' => $registrationData['jumlah_karyawan'],
            'alamat_usaha' => $registrationData['alamat_usaha'],
            'nib' => $request->file('nib')->store('nib', 'public'),
            'surat_pengantar' => $request->file('surat_pengantar')->store('surat_pengantar', 'public')
        ]);

        // Create products
        foreach ($productData as $product) {
            $newProduct = Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'user_id' => $user->id
            ]);

            // Store product images
            foreach ($product['images'] as $imagePath) {
                $newProduct->images()->create([
                    'image_path' => $imagePath
                ]);
            }
        }

        $request->session()->forget([
            'auth_data',
            'registration_data',
            'product_data'
        ]);

        return redirect()->route('account.login')
            ->with('success', 'Registration successful! Please wait for admin approval.');
    }
}
