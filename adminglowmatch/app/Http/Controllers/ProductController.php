<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    public function store(Request $request)
    {
        $product = new Product;

        $product->ProductName = $request->input('ProductName');
        $product->SkinType = $request->input('SkinType');
        $product->ConcernType = $request->input('ConcernType');
        $product->ProductType = $request->input('ProductType');
        $product->KeyIngredients = $request->input('KeyIngredients');
        $product->ShortDescription = $request->input('ShortDescription');
        $product->MoreDescription = $request->input('MoreDescription');
        $product->ProductDetails = $request->input('ProductDetails');
        $product->ProductBenefits = $request->input('ProductBenefits');

        // Handle file uploads
        if ($request->hasFile('ProductImage1')) {
            $product->ProductImage1 = $request->file('ProductImage1')->store('product_images', 'public');
        }

        if ($request->hasFile('ProductImage2')) {
            $product->ProductImage2 = $request->file('ProductImage2')->store('product_images', 'public');
        }

        if ($request->hasFile('TextureImage')) {
            $product->TextureImage = $request->file('TextureImage')->store('texture_images', 'public');
        }

        $product->save();

        return redirect('/products')->with('success', 'Product saved successfully!');
    }
}