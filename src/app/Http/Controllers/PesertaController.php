<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Pelatih;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    // GET /api/peserta
    public function index()
    {
        $peserta = Peserta::with(['kelas', 'pelatih'])->get();
        return response()->json($peserta);
    }

    // POST /api/peserta
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_peserta' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'sesi' => 'required',
        ]);

        // Misal kamu dapat pelatih dari sesi + kelas_id
        $instruktur = \App\Models\Sesi::where('kelas_id', $validated['kelas_id'])
                        ->where('sesi', $validated['sesi'])
                        ->first()
                        ?->pelatih_id; // asumsi kolomnya pelatih_id

        Peserta::create([
            'nama_peserta' => $validated['nama_peserta'],
            'kelas_id' => $validated['kelas_id'],
            'sesi' => $validated['sesi'],
            'instruktur' => $instruktur, // ← tambahkan ini
        ]);

        return redirect()->route('peserta.index');
    }


    // GET /api/peserta/{id}
    public function show($id)
    {
        $peserta = Peserta::with(['kelas', 'pelatih'])->find($id);

        if (!$peserta) {
            return response()->json(['message' => 'Peserta tidak ditemukan'], 404);
        }

        return response()->json($peserta);
    }

    // PUT /api/peserta/{id}
    public function update(Request $request, $id)
    {
        $peserta = Peserta::find($id);

        if (!$peserta) {
            return response()->json(['message' => 'Peserta tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama_peserta' => 'sometimes|required|string|max:255',
            'kelas_id' => 'sometimes|required|exists:products,id',
            'sesi' => 'sometimes|required|in:pagi,malam',
            'pelatih_id' => 'sometimes|exists:pelatih,id',
            'payment' => 'sometimes|required|in:lunas,belum lunas',
        ]);

        $peserta->update($validated);

        return response()->json([
            'message' => 'Peserta berhasil diperbarui.',
            'data' => $peserta
        ]);
    }

    // DELETE /api/peserta/{id}
    public function destroy($id)
    {
        $peserta = Peserta::find($id);

        if (!$peserta) {
            return response()->json(['message' => 'Peserta tidak ditemukan'], 404);
        }

        $peserta->delete();

        return response()->json(['message' => 'Peserta berhasil dihapus.']);
    }
}
