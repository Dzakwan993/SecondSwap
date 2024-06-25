<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Report;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('categorySearch', 'show', 'userProducts');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function search(Request $request)
    {
        if ($request->category) {
            $category = Category::findOrFail($request->category);
            $products = $category->products->sortByDesc('updated_at');
        } elseif ($request->keyword) {
            $products = Product::where('title', 'like', '%' . $request->keyword . '%')
                ->orWhere('description', 'like', '%' . $request->keyword . '%')
                ->get();
        }

        return view('products.products', compact('products'));
    }

    public function userProducts(User $user)
    {
        $products = $user->products;
        return view('user.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $provinces = Province::all();
        // Dapatkan data provinsi, kota, dan kecamatan untuk ditampilkan di formulir
        return view('products.create', compact('categories', 'provinces'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $this->validate($request, [
        'title' => 'required|min:2',
        'description' => 'required|min:5',
        'categories' => 'required',
        'price' => 'required|numeric',
        'image' => 'required|array',
        'image.*' => 'distinct|file|mimes:jpg,jpeg,bmp,png|max:10240|dimensions:max_height=4000,max_width=4000',
        'province' => 'required',
        'regency' => 'required',
        'district' => 'required',
    ]);

    // Upload dan simpan gambar produk
    $arr_img = [];
    if ($request->hasFile('image')) {
        foreach ($request->image as $img_product) {
            $fileName = time() . '_' . uniqid() . '.' . $img_product->getClientOriginalExtension();
            $img_product->storeAs('assets/uploads', $fileName, 'public');
            $arr_img[] = $fileName;
        }
    }

    // Simpan ID provinsi, kabupaten/kota, dan kecamatan ke dalam tabel produk
$newProduct = auth()->user()->products()->create([
    'title' => $request->title,
    'description' => $request->description,
    'price' => $request->price,
    'image' => json_encode($arr_img),
    'province_id' => $request->province,
    'regency_id' => $request->regency,
    'district_id' => $request->district,
]);



    // Attach kategori produk
    $newProduct->categories()->attach($request->categories);

    return redirect(route('home'))->with('message', 'Barang Berhasil Ditambahkan');
}






    public function getRegencies(Request $request)
{
    $regencies = Regency::where('province_id', $request->province_id)->get();
    return response()->json($regencies);
}

public function getDistricts(Request $request)
{
    $districts = District::where('regency_id', $request->regency_id)->get();
    return response()->json($districts);
}

public function getByDistrict(Request $request)
{
    $products = Product::where('district_id', $request->district_id)->get();
    return response()->json($products);
}

public function getProductsByDistrict($districtId)
{
    // Ambil produk beserta informasi pengguna terkait termasuk status is_blocked
    $products = Product::with('user')->where('district_id', $districtId)->get();

    return response()->json($products);
}



    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
{
    $this->authorize('update-delete-product', $product);
    
    $categories = Category::all();
    $provinces = Province::all();
    $regencies = Regency::all();
    $districts = District::all();

    return view('products.edit', compact('categories', 'product', 'provinces', 'regencies', 'districts'));
}

public function getProductsByCategoryAndLocation(Request $request)
{
    // Mulai query dengan model Product dan relasi 'user'
    $query = Product::with('user');

    // Filter berdasarkan category_id jika tersedia
    if ($request->category_id) {
        $query->whereHas('categories', function ($q) use ($request) {
            $q->where('category_id', $request->category_id);
        });
    }

    // Filter berdasarkan lokasi (district_id, regency_id, atau province_id)
    if ($request->district_id) {
        $query->where('district_id', $request->district_id);
    } elseif ($request->regency_id) {
        $query->where('regency_id', $request->regency_id);
    } elseif ($request->province_id) {
        $query->where('province_id', $request->province_id);
    }

    // Ambil hasil query
    $products = $query->get();

    return response()->json($products);
}





    public function getProductCategories(Product $product)
    {
        return response()->json(['categories' => $product->categories, 'sold' => $product->sold]);
    } 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update-delete-product', $product);
        $this->validate($request, [
            'title' => 'required|min:2',
            'description' => 'required|min:5',
            'categories' => 'required',
            'price' => 'required|numeric',
            'province' => 'required',
            'regency' => 'required',
            'district' => 'required',
        ]);


        $arr_img = $product->image;

        if ($request->hasFile('image')) {

            // delete old image
            foreach (json_decode($product->image) as $exist_img) {
                if (Storage::exists('public/assets/uploads/' . $exist_img)) {
                    Storage::delete('public/assets/uploads/' . $exist_img);
                }
            }
            foreach ($request->image as $img_product) {
                $fileName = time() . '.' . $img_product->getClientOriginalName();
                $img_product->storeAs('assets/uploads', $fileName, 'public');
                $new_img[] = $fileName;
            }
            $arr_img = json_encode($new_img);
        }

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'sold' => $request->sold == 0 ? 0 : 1,
            'image' => $arr_img,
            'province_id' => $request->province,
            'regency_id' => $request->regency,
            'district_id' => $request->district,
        ]);
        $product->categories()->sync($request->categories);

        return redirect(route('products.show', $product->id))->with('message', 'Barang Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('update-delete-product', $product);
        foreach (json_decode($product->image) as $exist_img) {
            if (Storage::exists('public/assets/uploads/' . $exist_img)) {
                Storage::delete('public/assets/uploads/' . $exist_img);
            }
        }

        $product->comments()->delete();
        $product->categories()->detach();
        $product->delete();

        return redirect(route('products.user_products', auth()->user()->id))->with('message', 'Barang Berhasil Dihapus');
    }

    // Di dalam ProductController

public function report($id)
{
    $product = Product::findOrFail($id);
    return view('products.report', compact('product')); // Buat view ini
}

public function storeReport(Request $request, $id)
{
    $request->validate([
        'reason' => 'required|string|max:255',
    ]);

    $report = new Report();
    $report->user_id = auth()->user()->id;
    $report->product_id = $id;
    $report->reason = $request->reason;
    $report->save();

    return redirect()->route('home')->with('message', 'Produk berhasil dilaporkan');
}



}
