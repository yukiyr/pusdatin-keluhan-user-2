<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /// mengambil data terakhir dan pagination 5 list
        $pertanyaans = Pertanyaan::latest()->paginate(5);
    
        /// mengirimkan variabel $pertanyaans ke halaman views pertanyaans/index.blade.php
        /// include dengan number index
        return view('pertanyaans.index',compact('pertanyaans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /// menampilkan halaman create
        return view('pertanyaans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /// membuat validasi untuk title dan content wajib diisi
        $request->validate([
            'pertanyaan' => 'required',
        ]);
         
        /// insert setiap request dari form ke dalam database via model
        /// jika menggunakan metode ini, maka nama field dan nama form harus sama
        Pertanyaan::create($request->all());
         
        /// redirect jika sukses menyimpan data
        return redirect()->route('pertanyaans.index')
                        ->with('success','Pertanyaan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /// dengan menggunakan resource, kita bisa memanfaatkan model sebagai parameter
        /// berdasarkan id yang dipilih
        /// href="{{ route('pertanyaans.show',$pertanyaan->id) }}
        return view('pertanyaans.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /// dengan menggunakan resource, kita bisa memanfaatkan model sebagai parameter
        /// berdasarkan id yang dipilih
        /// href="{{ route('pertanyaans.edit',$pertanyaan->id) }}
        return view('pertanyaans.edit',compact('pertanyaan'));
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
        /// membuat validasi untuk title dan content wajib diisi
        $request->validate([
            'pertanyaan' => 'required',
        ]);
         
        /// mengubah data berdasarkan request dan parameter yang dikirimkan
        $pertanyaan->update($request->all());
         
        /// setelah berhasil mengubah data
        return redirect()->route('pertanyaans.index')
                        ->with('success','Pertanyaan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /// melakukan hapus data berdasarkan parameter yang dikirimkan
        $pertanyaan->delete();
  
        return redirect()->route('pertanyaans.index')
                        ->with('success','Pertanyaan deleted successfully');
    }
}
