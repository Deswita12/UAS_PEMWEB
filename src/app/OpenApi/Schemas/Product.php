<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     required={"id", "nama_kelas", "sesi", "hari", "kuota_peserta", "harga", "nama_instruktur"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama_kelas", type="string", example="Renang Dasar"),
 *     @OA\Property(property="sesi", type="string", example="Pagi"),
 *     @OA\Property(property="hari", type="string", example="Senin"),
 *     @OA\Property(property="kuota_peserta", type="integer", example=10),
 *     @OA\Property(property="harga", type="number", format="float", example=150000),
 *     @OA\Property(property="nama_instruktur", type="string", example="Pak Budi"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T12:00:00Z")
 * )
 */
class Product {}
