<?php

namespace App\Http\Controllers;

use App\Models\Pelatih;
use Illuminate\Http\Request;

class PelatihController extends Controller
{
    // GET /api/pelatih
    public function index()
    {
        $data = Pelatih::with('kelas')->get();
        return response()->json($data);
    }

    // POST /api/pelatih
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelatih' => 'required|string|max:255',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $pelatih = Pelatih::create($validated);

        return response()->json([
            'message' => 'Pelatih berhasil ditambahkan.',
            'data' => $pelatih
        ], 201);
    }

    // GET /api/pelatih/{id}
    public function show($id)
    {
        $pelatih = Pelatih::with(['kelas.pesertas'])->find($id);

        if (!$pelatih) {
            return response()->json(['message' => 'Pelatih tidak ditemukan.'], 404);
        }

        return response()->json($pelatih);
    }

    // PUT /api/pelatih/{id}
    public function update(Request $request, $id)
    {
        $pelatih = Pelatih::find($id);

        if (!$pelatih) {
            return response()->json(['message' => 'Pelatih tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'nama_pelatih' => 'sometimes|required|string|max:255',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $pelatih->update($validated);

        return response()->json([
            'message' => 'Pelatih berhasil diperbarui.',
            'data' => $pelatih
        ]);
    }

    // DELETE /api/pelatih/{id}
    public function destroy($id)
    {
        $pelatih = Pelatih::find($id);

        if (!$pelatih) {
            return response()->json(['message' => 'Pelatih tidak ditemukan.'], 404);
        }

        $pelatih->delete();

        return response()->json(['message' => 'Pelatih berhasil dihapus.']);
    }
}
