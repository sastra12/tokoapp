<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Yajra\DataTables\DataTables;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penjualan.index');
    }

    public function data()
    {
        $listdata = Produk::leftJoin('kategori', 'kategori.id_kategori', '=', 'produk.id_kategori')
            ->select('produk.*', 'kategori.nama_kategori')
            ->orderBy('id_produk', 'desc')
            ->get();
        return Datatables::of($listdata)
            // for number
            ->addIndexColumn()
            ->addColumn('select_all', function ($listdata) {
                return '<div class="form-check">
                <input class="form-check-input checkMultiple" type="checkbox" name="id_produk[]" data-id="' . $listdata->id_produk . '">
              </div>';
            })
            // buat yang didalam kolom
            ->addColumn('kode_produk', function ($listdata) {
                return '<span class="badge badge-success">' . $listdata->kode_produk . '</span>';
            })
            ->addColumn('harga_beli', function ($listdata) {
                return format_uang($listdata->harga_beli);
            })
            ->addColumn('harga_jual', function ($listdata) {
                return format_uang($listdata->harga_jual);
            })
            // buat yang didalam kolom
            ->addColumn('action', function ($listdata) {
                return '
                <button onclick="deleteData(`' . route('produk.destroy', $listdata->id_produk) . '`)" class="btn btn-xs btn-success">Pilih</button>
            ';
            })
            // buat menampilkan
            ->rawColumns(['action', 'kode_produk', 'select_all'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
