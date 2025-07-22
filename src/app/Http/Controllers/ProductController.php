<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;


class ProductController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/products",
 *     operationId="getProducts",
 *     tags={"Products"},
 *     summary="Get all products",
 *     description="Returns a list of all products.",
 *     security={{"ApiKeyAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="success"),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(ref="#/components/schemas/Product")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - Invalid API Key"
 *     )
 * )
 */

    // GET /api/products
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($product, 200);
    }

    // POST /api/products

/**
 * @OA\Post(
 *     path="/api/products",
 *     operationId="storeProduct",
 *     tags={"Products"},
 *     summary="Buat data kelas renang baru",
 *     description="Menyimpan data kelas renang baru (produk) ke dalam database.",
 *     security={{"ApiKeyAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nama_kelas", "sesi", "hari", "kuota_peserta", "harga", "nama_instruktur"},
 *             @OA\Property(property="nama_kelas", type="string", example="Kelas Renang Pagi"),
 *             @OA\Property(property="sesi", type="string", example="Pagi"),
 *             @OA\Property(property="hari", type="string", example="Senin, Rabu, Jumat"),
 *             @OA\Property(property="kuota_peserta", type="integer", example=15),
 *             @OA\Property(property="harga", type="number", format="float", example=250000),
 *             @OA\Property(property="nama_instruktur", type="string", example="Budi Santoso")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Kelas berhasil dibuat",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Produk berhasil dibuat"),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="nama_kelas", type="string", example="Kelas Renang Pagi"),
 *                 @OA\Property(property="sesi", type="string", example="Pagi"),
 *                 @OA\Property(property="hari", type="string", example="Senin, Rabu, Jumat"),
 *                 @OA\Property(property="kuota_peserta", type="integer", example=15),
 *                 @OA\Property(property="harga", type="number", format="float", example=250000),
 *                 @OA\Property(property="nama_instruktur", type="string", example="Budi Santoso"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T12:00:00Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T12:00:00Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Gagal membuat kelas",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Terjadi kesalahan saat menyimpan data")
 *         )
 *     )
 * )
 */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'sesi' => 'required|in:pagi,malam',
            'hari' => 'required|string',
            'kuota_peserta' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'nama_instruktur' => 'nullable|string|max:255',
        ]);

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    // PUT /api/products/{id}
    /**
 * @OA\Get(
 *     path="/api/products/{id}",
 *     operationId="getProductById",
 *     tags={"Products"},
 *     summary="Ambil data produk (kelas renang) berdasarkan ID",
 *     description="Mengembalikan satu data produk (kelas renang) sesuai ID",
 *     security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID produk",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Operasi berhasil",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="nama_kelas", type="string", example="Kelas Renang Pagi"),
 *             @OA\Property(property="sesi", type="string", example="Pagi"),
 *             @OA\Property(property="hari", type="string", example="Senin, Rabu, Jumat"),
 *             @OA\Property(property="kuota_peserta", type="integer", example=15),
 *             @OA\Property(property="harga", type="number", format="float", example=250000),
 *             @OA\Property(property="nama_instruktur", type="string", example="Budi Santoso"),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T12:00:00Z"),
 *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T12:00:00Z")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Produk tidak ditemukan"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Tidak terautentikasi"
 *     )
 * )
 */

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama_kelas' => 'sometimes|required|string|max:255',
            'sesi' => 'sometimes|required|in:pagi,malam',
            'hari' => 'sometimes|required|string',
            'kuota_peserta' => 'sometimes|required|integer|min:1',
            'harga' => 'sometimes|required|numeric|min:0',
            'nama_instruktur' => 'nullable|string|max:255',
        ]);

        $product->update($validated);
        return response()->json($product, 200);
    }

    // DELETE /api/products/{id}
    /**
 * @OA\Delete(
 *     path="/api/products/{id}",
 *     operationId="deleteProduct",
 *     tags={"Products"},
 *     summary="Delete a product",
 *     description="Deletes a product by ID",
 *     security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Data berhasil dihapus")
 *         )
 *     ),
 *     @OA\Response(response=404, description="Product not found"),
 *     @OA\Response(response=401, description="Unauthorized")
 * )
 */

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }

/**
 * @OA\Post(
 *     path="/api/products/{id}/pay",
 *     operationId="payForProduct",
 *     tags={"Products"},
 *     summary="Buat pembayaran untuk produk tertentu",
 *     description="Membuat Snap Token dari Midtrans untuk melakukan pembayaran produk.",
 *     security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID produk",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Snap token berhasil dibuat",
 *         @OA\JsonContent(
 *             @OA\Property(property="snap_token", type="string", example="dummy-snap-token"),
 *             @OA\Property(property="redirect_url", type="string", example="https://app.sandbox.midtrans.com/snap/v2/vtweb/...")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Produk tidak ditemukan"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Terjadi kesalahan saat membuat transaksi"
 *     )
 * )
 */
public function pay($id)
{
    $product = Product::find($id);
    if (!$product) {
        return response()->json(['message' => 'Produk tidak ditemukan'], 404);
    }

    // Konfigurasi Midtrans
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    try {
        $orderId = 'ORDER-' . uniqid();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $product->harga,
            ],
            'item_details' => [
                [
                    'id' => $product->id,
                    'price' => $product->harga,
                    'quantity' => 1,
                    'name' => $product->nama_kelas
                ]
            ],
            'customer_details' => [
                'first_name' => 'User',
                'email' => 'user@example.com',
                'phone' => '08123456789'
            ]
        ];

        $snap = Snap::createTransaction($params);

        return response()->json([
            'snap_token' => $snap->token,
            'redirect_url' => $snap->redirect_url,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Gagal membuat transaksi',
            'error' => $e->getMessage()
        ], 500);
    }
}


}