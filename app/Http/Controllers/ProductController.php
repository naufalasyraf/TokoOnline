<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.product.index', [
            'products' => Product::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create', [
            'categories' => Categories::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'price' => 'required',
            'id_categori' => 'required',
            'stock' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img'), $imageName); // Pindahkan gambar ke direktori "public/images"

            // Simpan data gambar ke dalam database
            $product = new Product();
            $product->name = $request->input('name');
            $product->image = $imageName; // Simpan nama product saja, bukan datanya
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->id_categori = $request->input('id_categori');
            $product->stock = $request->input('stock');
            $product->save();

            Alert::success('Berhasil', 'Produk berhasil ditambahkan');
            return redirect('/products')->with('success', 'Data Produk Berhasil ditambahkan');
        }

        return back()->with('error', 'Gagal Menginputkan Data !');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getCategoryIdByName($categoryName)
    {
        $category = Categories::where('name', $categoryName)->first();

        if ($category) {
            return $category->id;
        }

        return null; // Jika kategori tidak ditemukan.
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('backend.product.edit', [
            'categories' => Categories::get(),
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('backend.product.index')->with('error', 'Product not found');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'id_categori' => 'required|exists:categories,id', // Make sure the category ID exists in the categories table.
            'description' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img'), $imageName); // Pindahkan gambar ke direktori "public/images"
        }

        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->stock = $validatedData['stock'];
        $product->id_categori = $validatedData['id_categori'];
        $product->description = $validatedData['description'];

        $product->save();

        Alert::success('Berhasil', 'Update data berhasil');
        return redirect()->route('products.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        Alert::success('Berhasil', 'Hapus Produk berhasil!');
        return redirect('products');
    }
}
