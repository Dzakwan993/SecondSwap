<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Report;
    use App\Models\User;
    use App\Models\Category;
    use App\Models\Product;

    class AdminController extends Controller
    {
        public function __construct()
        {
            $this->middleware(['auth', 'admin']); // Pastikan ini sesuai dengan middleware admin Anda
        }

        public function index()
        {
            // Ambil semua laporan yang belum ditindaklanjuti (status NULL)
            $reports = Report::whereNull('status')->get();
        
            // Kembalikan view bersama dengan variabel $reports
            return view('admin.dashboard', compact('reports'));

        }

        public function showLaporanMasuk()
{
    // Ambil laporan dengan status null
    $reports = Report::whereNull('status')
                     ->with('user', 'product.user')
                     ->get();
    
    return view('admin.laporanmasuk', compact('reports'));
}

        

    public function blockUser($reportId)
    {
        // Dapatkan data laporan yang dilaporkan
        $report = Report::findOrFail($reportId);
    
        // Dapatkan pengguna yang dijual produknya (pemilik produk yang dilaporkan)
        $user = $report->product->user;
    
        // Lakukan logika untuk memblokir pengguna yang dijual produknya
        $user->is_blocked = true; // Atur is_blocked menjadi true
        $user->save();
    
        // Update status laporan menjadi true (ditindak)
        $report->status = true;
        $report->save();
    
        // Redirect kembali ke halaman dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil ditindak.');
    }
    
        
    
    public function tolak($id)
    {
        // Temukan laporan yang sesuai
        $report = Report::findOrFail($id);
        
        // Ubah status laporan menjadi false (ditolak)
        $report->status = false;
        $report->save();
        
        // Redirect kembali ke halaman dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Laporan berhasil ditolak.');
    }
    

    

        public function rejected()
        {
            // Ambil semua laporan yang ditolak
            $rejectedReports = Report::where('status', 0)->get();

            // Kembalikan view bersama dengan variabel $rejectedReports
            return view('admin.ditolak', compact('rejectedReports'));
        }

        public function actionTaken()
        {
            // Ambil semua laporan yang ditindak (status 1)
            $actionTakenReports = Report::where('status', 1)->get();
        
            // Kembalikan view bersama dengan variabel $actionTakenReports
            return view('admin.ditindak', compact('actionTakenReports'));
        }

        public function showCategories()
        {
            $categories = Category::all();
            return view('admin.kategori', compact('categories'));
        }
        



public function addCategory(Request $request)
{
    $request->validate([
        'category' => 'required|string|unique:categories,category',
    ]);

    Category::create(['category' => $request->category]);

    return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan.');
}

public function editCategory(Request $request, $id)
{
    $request->validate([
        'category' => 'required|string|unique:categories,category,' . $id,
    ]);

    $category = Category::findOrFail($id);
    $category->update(['category' => $request->category]);

    return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil diperbarui.');
}

public function deleteCategory($id)
{
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil dihapus.');
}


}
        
    


