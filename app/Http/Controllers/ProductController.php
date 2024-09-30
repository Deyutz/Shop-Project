<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductWithPicturesResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with("pictures")->get();

        if ($products->count() > 0) {
            return response()->json(ProductResource::collection($products), 200);
        }
        return response()->json(["Error" => "No products found"], 404);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json(new ProductWithPicutesResourse($product), 200);
        }
        return response()->json(["Error" => "Product not found"], 404);
    }
    public function store(StoreProductRequest $request)
    {
        $validate = $request->validated();
        $product = new Product();
        $product->name = $validate["name"];
        $product->price = $validate["price"];
        $product->description = $validate["description"];
        $product->category_id = $validate["category_id"];
        $product->stock= $validate["stock"];
        $product->save();
        return response()->json(["Message" => "Product was added"], 200);

    }
    public function update(StoreProductRequest $request, $id)
    {
        $validate = $request->validated();
        $product = Product::find($id);
        if ($product) {
            $product->name = $validate["name"];
            $product->price = $validate["price"];
            $product->description = $validate["description"];
            $product->category_id = $validate["category_id"];
            $product->stock = $validate["stock"];
            $product->update();
            return response()->json(["Message" => "Product was updated"], 200);
        } else {
            return response()->json(["Error" => "Product not found"], 404);
        }

    }
    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(["Message" => "Product was deleted"], 200);
        }
        return response()->json(["Error" => "Product not found"], 404);

    }
    public function searchProducts(Request $request)
    {
        $products = Product::with("pictures")->where("name", "LIKE", "%" . $request->name . "%")->get();
        if ($products->count() > 0) {
            return response()->json(ProductResource::collection($products), 200);
        }
        return response()->json(["Error" => "No product found"], 404);
    }
}
