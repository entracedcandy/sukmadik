<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_bimbingan;
use App\Models\PengajuanBimbingan;
use Illuminate\Http\Request;

class BimbinganController extends Controller
{
    /**
     * Menampilkan semua pengajuan bimbingan.
     */
    public function index()
    {
        $pengajuan = pengajuan_bimbingan::all();
        return response()->json($pengajuan);
    }

    /**
     * Menyimpan pengajuan bimbingan baru (oleh mahasiswa).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengajuan' => 'required|string|max:255',
            'catatan' => 'required|string',
            'tanggal' => 'required|date_format:Y-m-d H:i:s',
            'id_d_jadwal' => 'required|integer',
        ]);

        $pengajuan = pengajuan_bimbingan::create([
            'nama_pengajuan' => $request->nama_pengajuan,
            'catatan' => $request->catatan,
            'tanggal' => $request->tanggal,
            'status' => 'diajukan', // Default status
            'id_d_jadwal' => $request->id_d_jadwal,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan berhasil dikirim',
            'data' => $pengajuan
        ], 201);
    }

    /**
     * Menampilkan detail pengajuan bimbingan berdasarkan ID.
     */
    public function show($id)
    {
        $pengajuan = pengajuan_bimbingan::find($id);

        if (!$pengajuan) {
            return response()->json(['message' => 'Pengajuan tidak ditemukan'], 404);
        }

        return response()->json($pengajuan);
    }

    /**
     * Mengubah status pengajuan (dosen: acc atau tolak).
     */
    public function update(Request $request, $id)
    {
        $pengajuan = pengajuan_bimbingan::find($id);

        if (!$pengajuan) {
            return response()->json(['message' => 'Pengajuan tidak ditemukan'], 404);
        }

        $request->validate([
            'status' => 'required|in:acc,ditolak',
        ]);

        $pengajuan->status = $request->status;
        $pengajuan->save();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'data' => $pengajuan
        ]);
    }

    /**
     * Menghapus pengajuan bimbingan berdasarkan ID.
     */
    public function destroy($id)
    {
        $pengajuan = pengajuan_bimbingan::find($id);

        if (!$pengajuan) {
            return response()->json(['message' => 'Pengajuan tidak ditemukan'], 404);
        }

        $pengajuan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan berhasil dihapus'
        ]);
    }
}