<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //get data products
        $products = DB::table('products')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        //sort by created_at desc

        return view('pages.products.index', compact('products'));
    }

    public function create()
    {
        return view('pages.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:products',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|in:food,drink,snack',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/products', $filename);
        $data = $request->all();

        $product = new \App\Models\Product;
        $product->name = $request->name;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category = $request->category;
        $product->image = $filename;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product successfully created');
    }

    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('pages.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {

        dd($request->all());
        // Validasi input
        $request->validate([
            'name' => 'required|min:3|unique:products,name,' . $id,
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|in:food,drink,snack',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|sometimes|max:2048'

        ]);

        // Temukan produk berdasarkan ID
        $product = \App\Models\Product::findOrFail($id);

        // Simpan gambar baru jika ada
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
            }

            // Pindahkan gambar baru ke storage
            $filename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public/products', $filename);

            // Simpan nama file gambar baru ke database
            $product->image = $filename;
        }

        // Perbarui data produk lainnya
        $product->name = $request->name;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category = $request->category;

        // Simpan perubahan
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product successfully updated');
    }



    public function destroy($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product successfully deleted');
    }
}
