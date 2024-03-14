<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{
    public function store(ProductStoreRequest $request)
    {
        $image = $request->file('image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/products');
        $image->move($destinationPath, $name);

        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->image = $name;
        $product->status = $request->status;
        $product->save();

        if ($product) {
            return Response::json([
                'status' => '200',
                'message' => 'Product data has been saved'
            ], 200);
        }
    }

    public function update(Request $request, Product $product)
    {
        $image = $request->file('image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/products');
        $image->move($destinationPath, $name);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->image = $name;
        $product->status = $request->status;
        $product->update();

        if ($product) {
            return Response::json([
                'status' => '200',
                'message' => 'Product data has been updated'
            ], 200);
        }
    }

    public function categories()
    {
        $product = Product::all();
        if ($product) {
            return Response::json([
                'status' => '200',
                'message' => 'Product list get successfully',
                'data' => $product
            ], 200);
        } else {
            return Response::json([
                'status' => '404',
                'message' => 'Product data not found'
            ], 404);
        }
    }

    public function product_delete(Product $product)
    {
        $product->delete();
        if ($product) {
            return Response::json([
                'status' => '200',
                'message' => 'Product deleted successfully'
            ], 200);
        } else {
            return Response::json([
                'status' => '401',
                'message' => 'Product has been not deleted'
            ], 401);
        }
    }

    public function show(Product $product)
    {
        if ($product) {
            return Response::json([
                'status' => '200',
                'message' => 'Product get successfully',
                'data' => $product
            ], 200);
        } else {
            return Response::json([
                'status' => '404',
                'message' => 'Product data not found'
            ], 404);
        }
    }
}
