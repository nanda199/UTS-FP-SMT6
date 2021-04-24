<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\List_;

class SuratController extends Controller
{
    public function list()
    {
        $hasil = DB::select('select * from tb_surat');
        return view('list-surat', ['data' => $hasil]);
    }
    public function simpan(Request $req)
    {
        DB::insert(
            'insert into tb_surat (nomor_surat,tanggal_surat, pengirim) values (?, ?, ?)',
            [$req->no_surat, $req->tgl_surat, $req->pengirim]
        );
        $hasil = DB::select('select * from tb_surat');
        return view('list-surat', ['data' => $hasil]);
    }
    public function hapus($req)
    {
        Log::info('proses hapus dengan id=' . $req);
        DB::delete('delete from tb_surat where id = ?', [$req]);

        $hasil = DB::select('select * from tb_surat');
        return view('list-surat', ['data' => $hasil]);
    }
    public function ubah($req)
    {
        $hasil = DB::select('select * from tb_surat where id = ?', [$req]);
        return view('form-ubah', ['data' => $hasil]);
    }
    public function rubah(Request $req)
    {
        Log::info('Hallo');
        Log::info($req);
        DB::update(
            'update tb_surat set ' .
                'nomor_surat=?, ' .
                'tanggal_surat=?, ' .
                'pengirim=? where id=? ',
            [
                $req->nomor_surat,
                $req->tanggal_surat,
                $req->pengirim,
                $req->id
            ]
        );
        $hasil = DB::select('select * from tb_surat');
        return view('list-surat', ['data' => $hasil]);
    }
}
