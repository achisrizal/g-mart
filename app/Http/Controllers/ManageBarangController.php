<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Barang;

class ManageBarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $barang=Barang::orderBy('id_produkkoperasi','DESC')->paginate(5);
        return view('admin.managebarang.index',compact('barang'))->with('i',($request->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.managebarang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_produk' => 'required',
            'gambar' => 'required',
        ]);

        $input = $request->all();
        
        $barang = Barang::create($input);
        return redirect()->route('managebarang.index')
        ->with('Sukses','Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_produkkoperasi)
    {
        $barang = Barang::find($id_produkkoperasi);
        return view('admin.managebarang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_produkkoperasi)
    {
        $barang=Barang::find($id_produkkoperasi);
        return view('admin.managebarang.edit',compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_produkkoperasi)
    {
        $this->validate($request, [
            'nama_produk' => 'required',
            'gambar' => 'required',
            
        ]);
    
            $input = $request->all();
            
            $barang = Barang::find($id_produkkoperasi);
            $barang -> update($input);
    
            return redirect()->route('managebarang.index')
            ->with('Sukses','Produk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_produkkoperasi)
    {
        
        Barang::find($id_produkkoperasi)->delete();
        return redirect()->route('managebarang.index')
        ->with('Sukses','Produk berhasil dihapus');
    }
}
