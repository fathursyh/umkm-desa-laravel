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
        $validated = $request->validate(rules: [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $request->session()->put('registration_data', $validated);
        return redirect()->route('register.step2');
    }

    public function step2()
    {
        if (!session()->has('registration_data')) {
            return redirect()->route('register.step1');
        }
        return view('auth.register.step2');
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'business_certificate' => 'required|mimes:pdf|max:2048'
        ]);

        // Change to store in public disk
        $path = $request->file('business_certificate')->store('certificates', 'public');
        $request->session()->put('business_certificate', $path);

        return redirect()->route('register.step3');
    }

    public function step3()
    {
        if (!session()->has('business_certificate')) {
            return redirect()->route('register.step2');
        }
        return view('auth.register.step3');
    }
    public function storeStep3(Request $request)
    {
        $request->validate([
            'products.*.name' => 'required|string|max:255',
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
            'rt_letter' => 'required|mimes:pdf|max:2048'
        ]);

        $registrationData = $request->session()->get('registration_data');
        $businessCertificate = $request->session()->get('business_certificate');
        $productData = $request->session()->get('product_data');

        $user = User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'password' => bcrypt($registrationData['password']),
            'role' => 'umkm',
            'status' => 'pending',
            'business_certificate' => $businessCertificate,
            // Change to store in public disk
            'rt_letter' => $request->file('rt_letter')->store('rt_letters', 'public')
        ]);

        // Create products
        foreach ($productData as $product) {
            $newProduct = Product::create([
                'name' => $product['name'],
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
            'registration_data',
            'business_certificate',
            'product_data'
        ]);

        return redirect()->route('account.login')
            ->with('success', 'Registration successful! Please wait for admin approval.');
    }
}
