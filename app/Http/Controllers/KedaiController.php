<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kedai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KedaiController extends Controller
{
    public function index()
    {
        $kedai = Kedai::where('user_id', Auth::id())->with('menus')->first();
        return view('pages.pemilik-kedai.index', compact('kedai'));
    }

    public function halamanDaftarSebagaiPemilikKedai(){
        return view('pages.mendaftar-pemilik-kedai');
    }

    public function daftarSebagaiPemilikKedai(Request $request){
           // Validasi data yang dikirim
           $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // optional jika menggunakan file image
        ]);

        $submission = Kedai::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'image' => $request->file('image')->store('images', 'public'),
            'status' => 'pending',
            'user_id' => auth()->id(),
        ]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('halamanDaftarSebagaiPemilikKedai')->with('success', 'Pengajuan sebagai pemilik kedai berhasil dikirim.');
    }

    public function create()
    {
        return view('kedai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        $kedai = new Kedai([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        if ($request->hasFile('image')) {
            $kedai->image = $request->file('image')->store('images', 'public');
        }

        $kedai->save();

        return redirect()->route('kedai.index')->with('success', 'Kedai created successfully.');
    }

    public function show(Kedai $kedai)
{
    $kedai->load('menus');
    return view('pages.kedai.detail', compact('kedai'));
}
}
