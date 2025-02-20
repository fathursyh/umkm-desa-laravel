<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->get();
        return view('umkm.products.index', compact('products'));
    }

    public function create()
    {
        return view('umkm.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'images.*' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        $images = [];

        if ($request->hasFile("images")) {
            foreach ($request->file("images") as $image) {
                $images[] = $image->store('product_images', 'public');
            }
        }

        $product = [
            'name' => $data['name'],
            'description' => $data['description'],
            'images' => $images
        ];
    
        $user = Auth::user();

        $newProduct = Product::create([
            'name' => $product['name'],
            'description' => $product['description'],
            'user_id' => $user->id
        ]);

        foreach ($product['images'] as $imagePath) {
            $newProduct->images()->create([
                'image_path' => $imagePath
            ]);
        }
    
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('umkm.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('umkm.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'images.*' => 'image|mimes:jpg,png,jpeg'
        ]);
    
        $product = Product::findOrFail($id);
    
        $product->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
    
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageId) {
                $image = $product->images()->find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('product_images', 'public');
                $product->images()->create([
                    'image_path' => $imagePath
                ]);
            }
        }
    
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}