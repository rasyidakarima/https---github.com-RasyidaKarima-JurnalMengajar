<?php

namespace App\Http\Controllers;

use App\Exports\ExportJurnalWord;
use App\Exports\JurnalExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jurnal;
use Maatwebsite\Excel\Files\LocalTemporaryFile;

class jurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurnal = DB::table('jurnal')
                    ->join('rpp','rpp.id', '=', 'jurnal.rpp_id')
                    ->join('users', 'users.id', '=', 'jurnal.user_id')
                    ->where('jurnal.status', '=', 'sudah divalidasi')
                    ->get();
        $active = 'jurnal';

        return view('jurnal.jurnal', compact('jurnal', 'active'));
    }

    public function create()
    {
        $active = 'jurnal';
        return view('jurnal.jurnalCreate', compact('active'));
    }

    public function cetak()
    {
        $active = 'cetak_jurnal';
        return view('jurnal.cetakJurnal', compact('active'));
    }

    public function store(Request $req)
    {
        $file = $req->file('foto_kegiatan');
        DB::table('jurnal')->insert([
            'nama' => $req->nama,
            'kelas' => $req->kelas,
            'uraian_tugas' => $req->uraian_tugas,
            'hasil' => $req->hasil,
            'kendala' => $req->kendala,
            'tindak_lanjut' => $req->tindak_lanjut,
            'foto_kegiatan' => $file->move('images')
        ]);
        return redirect('jurnal');
    }

    public function edit($id)
    {

        $jurnal = Jurnal::find($id);
        return view('jurnal.jurnalEdit', compact('jurnal'));
    }

    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $file = $request->file('foto_kegiatan');
        if ($file != '') {
            // JIKA GAMBAR DIUBAH
            DB::table('jurnal')->where('id', $id)->update([
                'nama' => $request->nama,
                'kelas' => $request->kelas,
                'uraian_tugas' => $request->uraian_tugas,
                'hasil' => $request->hasil,
                'kendala' => $request->kendala,
                'tindak_lanjut' => $request->tindak_lanjut,
                'foto_kegiatan' => $file->move('images'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            // JIKA TIDAK MENGUBAH GAMBAR
            DB::table('jurnal')->where('id', $id)->update([
                'nama' => $request->nama,
                'kelas' => $request->kelas,
                'uraian_tugas' => $request->uraian_tugas,
                'hasil' => $request->hasil,
                'kendala' => $request->kendala,
                'tindak_lanjut' => $request->tindak_lanjut,
                'foto_kegiatan' => $request->foto_kegiatan_old,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        return redirect('jurnal');
    }

    public function destroy($id)
    {
        $jurnal = Jurnal::find($id);
        $jurnal->delete();
        return redirect('/jurnal');
    }

    public function exportWord(){
        $jurnal = DB::table('jurnal')
                ->join('rpp','rpp.id', '=', 'jurnal.rpp_id')
                ->join('users', 'users.id', '=', 'jurnal.user_id')
                ->where('jurnal.status', '=', 'sudah divalidasi')
                ->where('tanggal', Date("Y-m-d"))
                ->get();
        $ttdKepsek = DB::table('signature')
                ->join('users', 'users.id', '=', 'signature.user_id')
                ->where('users.role', '=', 'kepsek')
                ->latest('signature.tanggal')
                ->first(['signature.*', 'users.name', 'users.nip']);

        $file = (new ExportJurnalWord())->exportWord($jurnal, $ttdKepsek);
        return response()->download($file)->deleteFileAfterSend();

        //return view('jurnal.exportWord', compact('jurnal', 'ttdKepsek'));

    }


    public function cetakPertanggal($tglawal)
    {
        $jurnal = DB::table('jurnal')
                ->join('rpp','rpp.id', '=', 'jurnal.rpp_id')
                ->join('users', 'users.id', '=', 'jurnal.user_id')
                ->where('jurnal.status', '=', 'sudah divalidasi')
                ->whereDate('tanggal', $tglawal)
                ->get();
        
        $ttdKepsek = DB::table('signature')
                ->join('users', 'users.id', '=', 'signature.user_id')
                ->where('users.role', '=', 'kepsek')
                ->latest('signature.tanggal')
                ->first(['signature.*', 'users.name', 'users.nip']);

        $file = (new ExportJurnalWord())->exportWord($jurnal, $ttdKepsek);
        return response()->download($file)->deleteFileAfterSend();

        //return view('jurnal.exportWord', compact('jurnal', 'ttdKepsek'));
    }
}
