<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
  public function getUserSchedule(Request $request)
    {
        dd($request->all());
        // 1. Validasi Input
        $request->validate([
            'user_id' => 'required|string', // Sesuaikan tipe data jika bukan string (misal: integer)
            'semester_id' => 'required|string', // Sesuaikan tipe data jika bukan string
        ]);

        $userId = $request->input('user_id');
        $semesterId = $request->input('semester_id');

        // Debugging Awal: Pastikan input diterima
        Log::info("Mencari jadwal untuk User ID: {$userId} dan Semester ID: {$semesterId}");

        // 2. Menggunakan Eloquent untuk Mengambil Data
        try {
            $user = User::where('id_user', $userId)
                ->where('level', 2) // Filter user dengan level 2
                // Eager loading relasi yang diperlukan
                ->with([
                    'pengajuanBimbingans' => function($queryPengajuan) use ($semesterId) {
                        $queryPengajuan->where('id_semester', $semesterId)
                                       ->with([
                                           'detailSesis.sesi.jadwal', // Nested relasi: detail_sesi -> sesi -> jadwal
                                           'detailSesis.golongan',     // detail_sesi -> golongan
                                           'matkul'                    // pengajuan_bimbingan -> matkul
                                       ]);
                    }
                ])
                ->first(); // Mengambil satu user saja

            // Debugging Query SQL yang Dihasilkan (hanya saat DEVELOPMENT)
            // \DB::listen(function($query) {
            //     Log::info($query->sql);
            //     Log::info($query->bindings);
            //     Log::info($query->time);
            // });

            if (!$user) {
                Log::warning("User atau jadwal tidak ditemukan untuk User ID: {$userId}, Semester ID: {$semesterId}");
                return response()->json(['message' => 'User not found or no schedules available for the given criteria.'], 404);
            }

            // 3. Format Data agar sesuai dengan permintaan Anda
            $formattedSchedules = [];
            foreach ($user->pengajuanBimbingans as $pengajuan) {
                // Debugging: Periksa apakah pengajuan memiliki detailSesis
                // Log::info("Processing PengajuanBimbingan ID: {$pengajuan->id_pengajuan}");

                foreach ($pengajuan->detailSesis as $detailSesi) {
                    // Debugging: Periksa keberadaan relasi
                    // Log::info("DetailSesi ID: {$detailSesi->id_detail_sesi} -> Sesi: " . ($detailSesi->sesi ? $detailSesi->sesi->id_sesi : 'NULL'));
                    // Log::info("DetailSesi ID: {$detailSesi->id_detail_sesi} -> Jadwal: " . ($detailSesi->sesi && $detailSesi->sesi->jadwal ? $detailSesi->sesi->jadwal->id_jadwal : 'NULL'));
                    // Log::info("DetailSesi ID: {$detailSesi->id_detail_sesi} -> Golongan: " . ($detailSesi->golongan ? $detailSesi->golongan->id_golongan : 'NULL'));
                    // Log::info("Pengajuan ID: {$pengajuan->id_pengajuan} -> Matkul: " . ($pengajuan->matkul ? $pengajuan->matkul->id_matkul : 'NULL'));

                    // Pastikan semua relasi yang diperlukan ada sebelum mencoba mengakses propertinya
                    if ($detailSesi->sesi && $detailSesi->sesi->jadwal && $pengajuan->matkul && $detailSesi->golongan) {
                        $formattedSchedules[] = [
                            'user_nama' => $user->nama,
                            'sesi_nama' => $detailSesi->sesi->nama,
                            'start' => $detailSesi->sesi->start,
                            'end' => $detailSesi->sesi->end,
                            'jadwal_hari' => $detailSesi->sesi->jadwal->Hari,
                            'nama_matkul' => $pengajuan->matkul->nama_matkul, // Mengambil matkul dari pengajuan bimbingan
                            'catatan' => $pengajuan->catatan,
                            'golongan' => $detailSesi->golongan->golongan,
                        ];
                    } else {
                        // Debugging: Log jika ada data yang tidak lengkap
                        Log::warning("Data jadwal tidak lengkap untuk DetailSesi ID: {$detailSesi->id_detail_sesi}. Skipping.");
                    }
                }
            }

            // 4. Urutkan data sesuai permintaan: nama sesi, start, end, hari
            usort($formattedSchedules, function($a, $b) {
                $cmpSesiNama = strcmp($a['sesi_nama'], $b['sesi_nama']);
                if ($cmpSesiNama !== 0) {
                    return $cmpSesiNama;
                }
                $cmpStart = strcmp($a['start'], $b['start']);
                if ($cmpStart !== 0) {
                    return $cmpStart;
                }
                $cmpEnd = strcmp($a['end'], $b['end']);
                if ($cmpEnd !== 0) {
                    return $cmpEnd;
                }
                return strcmp($a['jadwal_hari'], $b['jadwal_hari']);
            });

            Log::info("Jadwal berhasil diambil dan diformat.");
            return response()->json($formattedSchedules);

        } catch (\Exception $e) {
            // 5. Penanganan Error
            Log::error("Terjadi kesalahan saat mengambil jadwal: " . $e->getMessage());
            Log::error("Stack Trace: " . $e->getTraceAsString());
            return response()->json(['message' => 'An error occurred while fetching the schedule.', 'error' => $e->getMessage()], 500);
        }
    }
}