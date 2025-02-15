<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\StokGudangUtama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class productsController extends Controller
{
    public function index(){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Produk',
        ];
        $products = Products::all();
        return view('pages.products.index', ['pageConfigs'=>$pageConfigs, 'products'=>$products]);
    }

    public function detail_index($id){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Detail Produk',
        ];
        $product = Products::find($id);
        return view('pages.products.detail', ['pageConfigs'=>$pageConfigs, 'product'=>$product]);
    }

    public function add_index(){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Tambah Produk',
            'formTarget' => 'product-created-index',
            'pageType' => 'add',
        ];
        return view('pages.products.products-add-index', ['pageConfigs'=>$pageConfigs]);
    }

    public function created_index(Request $request){
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required|numeric',
            'category_produk' => 'required',
            'status_product' => 'required',
            'poin' => 'required',
            'image_produk' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ],[
            'nama_produk.required' => 'Nama harus diisi',
            'harga_produk.required' => 'Harga harus diisi',
            'harga_produk.numeric' => 'Harga harus angka',
            'category_produk.required' => 'Category harus diisi',
            'status_product.required' => 'Status harus diisi',
            'poin.required' => 'Poin harus diisi',
            'image_produk.required' => 'Gambar harus diisi',
            'image_produk.image' => 'Harus file gambar',
            'image_produk.mimes' => 'Gambar harus berformat jpeg,png,jpg,gif,svg',
        ]);
        try {
            $kd_product = Products::orderBy('kd_product', 'desc')->first();
            $ID = 'PDC-' . date('y') . date('m') . str_pad( ($kd_product ? intval(substr($kd_product->kd_product, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT); 

            $product = new Products();
            $product->kd_product = $ID;
            $product->namaProduk = $request->nama_produk;
            $product->harga = $request->harga_produk;
            $product->category = $request->category_produk;
            $product->status = $request->status_product;
            $product->category_poin = $request->poin;

            if($request->hasFile('image_produk')){
                $file = $request->file('image_produk');
                $name = $ID . '.' . $file->getClientOriginalExtension();
                $file->storeAs('images/products', $name, 'public');
                $product->image = $name;
            }

            $product->save();

            return redirect()->route('product-index')->with(['success' => 'Data berhasil diubah!']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit_index($id){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Edit Produk',
            'formTarget' => 'product-updated-index',
            'pageType' => 'edit',
        ];
        $products = Products::where('kd_product', $id)->first();
        return view('pages.products.products-add-index', ['pageConfigs'=>$pageConfigs, 'products'=>$products]);
    }

    public function updated_index(Request $request, $id){
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required|numeric',
            'category_produk' => 'required',
            'category_produk' => 'required',
            'status_product' => 'required',
            'image_produk' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ],[
            'nama_produk.required' => 'Nama harus diisi',
            'harga_produk.required' => 'Harga harus diisi',
            'harga_produk.numeric' => 'Harga harus angka',
            'category_produk.required' => 'Category harus diisi',
            'status_product.required' => 'Status harus diisi',
            'poin.required' => 'Poin harus diisi',
            'image_produk.image' => 'Harus file gambar',
            'image_produk.mimes' => 'Gambar harus berformat jpeg,png,jpg,gif,svg',
        ]);
        try {
            $product = Products::where('kd_product', $id)->first();
            $product->namaProduk = $request->nama_produk;
            $product->harga = $request->harga_produk;
            $product->category = $request->category_produk;
            $product->status = $request->status_product;
            $product->category_poin = $request->poin;

            if ($request->hasFile('image_produk')) {  
                $imageName = $product->kd_product . '.' . $request->file('image_produk')->getClientOriginalExtension();
                if (!empty($product->image)) {
                    Storage::delete('images/products/' . $product->image);
                }
                $request->file('image_produk')->storeAs('images/products', $imageName);
                $product->image = $imageName;
            }
            $product->update();

            return redirect()->route('product-index')->with(['success' => 'Data berhasil diubah!']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }

    public function deleted_index($id){
        try {
            $product = Products::where('kd_product', $id)->first();
            if (!$product) {
                return redirect()->route("product-index")->withErrors(['error' => 'Data tidak ditemukan.']);
            }
            if (!empty($product->image)) {
                Storage::delete('images/products/' . $product->image);
            }
            $product->delete();
            return redirect()->route("product-index")->with(['success' => 'Data berhasil dihapus!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $th->getMessage()]);
        }
    }




    public function listProducts(Request $request){
        $products = Products::all();
        return response()->json(['data' => $products]);
    }

}
