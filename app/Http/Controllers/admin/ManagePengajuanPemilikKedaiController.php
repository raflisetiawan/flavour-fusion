<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kedai;
use Illuminate\Http\Request;

class ManagePengajuanPemilikKedaiController extends Controller
{
    public function index()
    {
        $pengajuanKedai = Kedai::where('status', 'pending')->with('user')->get();
        return view('pages.admin.manage-pengajuan-pemilik-kedai', compact('pengajuanKedai'));
    }

    public function approve($id)
    {
        $kedai = Kedai::findOrFail($id);
        $kedai->status = 'approved';
        $kedai->save();

        return redirect()->route('admin.manage-pengajuan-pemilik-kedai.index')->with('success', 'Pengajuan kedai telah disetujui.');
    }

    public function reject($id)
    {
        $kedai = Kedai::findOrFail($id);
        $kedai->status = 'rejected';
        $kedai->save();

        return redirect()->route('admin.manage-pengajuan-pemilik-kedai.index')->with('success', 'Pengajuan kedai telah ditolak.');
    }
}
