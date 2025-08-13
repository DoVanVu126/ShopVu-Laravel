<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);

        if ($request->has('q') && $request->q != '') {
            $keyword = $request->q;
            $query->where('name', 'like', "%{$keyword}%");
        }

        return $query->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'img_file' => 'nullable|image|max:20480', // validate file ảnh
        ]);

        $img_url = null;
        if ($request->hasFile('img_file')) {
            $file = $request->file('img_file');

            // Lưu file vào thư mục public/images/products, tên file giữ nguyên hoặc tạo tên mới
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $fileName);

            // Đường dẫn url để truy cập ảnh
            $img_url = "images/products/" . $fileName;
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'img_url' => $img_url,
        ]);

        return response()->json($product, 201);
    }



    public function show($id)
    {
        $product = Product::with(['category', 'brand'])->findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'img_url' => 'nullable|string', // có thể có hoặc không nếu không upload file
            'img_file' => 'nullable|image|max:2048', // ảnh mới nếu có
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('img_file')) {
            $file = $request->file('img_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $fileName);
            $img_url = "images/products/" . $fileName;
        } else {
            $img_url = $request->input('img_url', $product->img_url); // giữ ảnh cũ nếu không upload mới
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'img_url' => $img_url,
        ]);

        return response()->json($product);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
