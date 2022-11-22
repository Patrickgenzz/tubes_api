<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::all();
        if (count($pesanan) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function create()
    {
        $pesanan = Pesanan::all();

        if (count($pesanan) > 0) {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'nama' => 'required',
            'jenisPesanan' => 'required',
            'rincian' => 'required',
        ]);
       
        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pesanan = Pesanan::create($storeData);
        return response([
            'message' => 'Tambah pesanan Berhasil',
            'data' => $pesanan
        ], 200);
    }

    public function show($id)
    {
        $pesanan = Pesanan::find($id);

        if (!is_null($pesanan)) {
            return response([
                'message' => 'Berhasil Mendapatkan Data pesanan',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'Data pesanan Tidak Ditemukan',
            'data' => null
        ], 404);
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);
        if (is_null($pesanan)) {
            return response([
                'message' => 'Data pesanan Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama' => 'required',
            'jenisPesanan' => 'required',
            'rincian' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pesanan->nama = $updateData['nama'];
        $pesanan->jenisPesanan = $updateData['jenisPesanan'];
        $pesanan->rincian = $updateData['rincian'];

        if ($pesanan->save()) {
            return response([
                'message' => 'Data pesanan Berhasil di update',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'Data pesanan Gagal di update',
            'data' => null
        ], 400);
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::find($id);

        if (is_null($pesanan)) {
            return response([
                'message' => 'Data pesanan Tidak Ditemukan!',
                'data' => null
            ], 404);
        }

        if ($pesanan->delete()) {
            return response([
                'message' => 'Hapus Data Pesanan Berhasil',
                'data' => $pesanan
            ], 200);
        }

        return response([
            'message' => 'Hapus Data Pesanan Tidak Berhasil',
            'data' => null
        ], 400);
    }
}