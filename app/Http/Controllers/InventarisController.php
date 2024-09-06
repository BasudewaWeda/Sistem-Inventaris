<?php

namespace App\Http\Controllers;

use App\Exports\InventarisExport;
use App\Exports\PemindahanInventarisExport;
use App\Models\Role;
use App\Models\User;
use App\Models\Kantor;
use App\Models\Lantai;
use App\Models\Ruangan;
use App\Models\Kategori;
use App\Models\Inventaris;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\InputInventaris;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\AddInventarisRequest;
use App\Http\Requests\AddPemindahanInventarisRequest;
use App\Models\PemindahanInventaris;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class InventarisController extends Controller
{
    public function getLantaiByKantor($id) {
        return Lantai::where('kantor_id', $id)->get();
    }

    public function getRuanganByLantai($id) {
        return Ruangan::where('lantai_id', $id)->get();
    }

    public function showInventaris() {
        $inputInventaris = Role::checkPermission('input-inventaris');
        $addPemindahanInventaris = Role::checkPermission('add-pemindahan-inventaris');

        $inventarisRecord = Inventaris::getInventarisRecord();

        return view('inventaris.index', compact('inputInventaris', 'addPemindahanInventaris', 'inventarisRecord'));
    }

    public function showInventarisDetails(Inventaris $inventaris) {
        $inventarisDetails = $inventaris;
        $inventarisDetails->getInventarisDetails();

        return view('inventaris.view', compact('inventarisDetails'));
    }

    public function showInputInventaris() {
        $inputInventarisRecord = InputInventaris::getInputInventarisByApprover();

        return view('input-inventaris.index', compact('inputInventarisRecord'));
    }

    public function showInputInventarisDetails(InputInventaris $inputInventaris) {
        $inputInventarisDetails = $inputInventaris;
        $inputInventarisDetails->getInputInventarisDetails();
        $currentUser = User::getCurrentUser();

        return view('input-inventaris.view', compact('inputInventarisDetails', 'currentUser'));
    }

    public function downloadQrCodeInventaris($filename) {
        $filePath = 'public/qrcodes/' . $filename;

        if (!Storage::exists($filePath)) {
            return abort(404);
        }

        return Response::download(storage_path('app/' . $filePath));
    }

    public function showEditKondisiInventaris(Inventaris $inventaris) {
        return view('inventaris.kondisi', compact('inventaris'));
    }

    public function editKondisiInventaris(Inventaris $inventaris, Request $request) {
        $request = $request->validate([
            'kondisi' => 'required|string:255',
        ]);

        $inventaris->ubahKondisiInventaris($request['kondisi']);

        Alert::toast('Kondisi inventaris berubah');

        return redirect('/inventaris-management/inventaris/' . $inventaris->inventaris_id)->with('success', 'Kondisi inventaris berubah');
    }

    public function showAddInventaris() {
        $firstApprovers = User::getFirstApprovers();
        $secondApprovers = User::getSecondApprovers();
        $kategoriRecord = Kategori::getKategori();
        $kantorRecord = Kantor::getKantorRecords();

        return view('inventaris.add', compact('firstApprovers', 'secondApprovers', 'kategoriRecord', 'kantorRecord'));
    }

    public function addInventaris(AddInventarisRequest $request) {
        $price = $request->all()['harga_inventaris'];
        $price = preg_replace('/Rp\.|[.,]/', '', $price);

        $request = $request->validated();

        $request['harga_inventaris'] = $price;

        $inputInventaris = InputInventaris::createInputInventaris($request);

        Inventaris::createInventaris($request, $inputInventaris->input_inventaris_id);

        Alert::toast('Inventaris added');

        return redirect('/inventaris-management')->with('success', 'Inventaris added');
    }

    public function approveInputInventaris(InputInventaris $inputInventaris) {
        $inputInventaris->approveInputInventaris();

        Inventaris::approveInventaris($inputInventaris->load(['kantor']));

        Alert::toast('Approved ' . $inputInventaris->judul_input_inventaris);

        return redirect('/approval-inventaris')->with('success', 'Input Inventaris approved');
    }

    public function rejectInputInventaris(InputInventaris $inputInventaris, Request $request) {
        $request->validate(['alasan_rejection' => 'required|string|max:255']);
        
        $inputInventaris->rejectInputInventaris($request->all()['alasan_rejection']);

        Inventaris::rejectInventaris($inputInventaris);

        Alert::toast('Rejected ' . $inputInventaris->judul_input_inventaris);

        return redirect('/approval-inventaris')->with('success', 'Input Inventaris rejected');
    }

    public function showAddPemindahanInventaris(Request $request) {
        $inventarisIds = Str::of($request->all()['selected_items'])->explode(',');

        $inventarisRecords = Inventaris::getInventarisByIds($inventarisIds);
        $firstApprovers = User::getPemindahanFirstApprovers();
        $secondApprovers = User::getPemindahanSecondApprovers();
        $kantorRecord = Kantor::getKantorRecords();

        return view('inventaris.pemindahan', compact('firstApprovers', 'secondApprovers', 'kantorRecord', 'inventarisRecords'));
    }

    public function addPemindahanInventaris(AddPemindahanInventarisRequest $request) {
        $request = $request->validated();

        PemindahanInventaris::createPemindahanInventaris($request);

        Alert::toast('Pemindahan Inventaris added');

        return redirect('/inventaris-management')->with('success', 'Pemindahan Inventaris added');
    }

    public function showPemindahanInventaris() {
        $pemindahanInventarisRecord = PemindahanInventaris::getPemindahanInventarisByApprover();

        return view('pemindahan-inventaris.index', compact('pemindahanInventarisRecord'));
    }

    public function showPemindahanInventarisDetails(PemindahanInventaris $pemindahanInventaris) {
        $pemindahanInventarisDetails = $pemindahanInventaris;
        $pemindahanInventarisDetails->getPemindahanInventarisDetails();
        $currentUser = User::getCurrentUser();

        return view('pemindahan-inventaris.view', compact('pemindahanInventarisDetails', 'currentUser'));
    }

    public function approvePemindahanInventaris(PemindahanInventaris $pemindahanInventaris) {
        $pemindahanInventaris->approvePemindahanInventaris();

        Inventaris::approvePemindahanInventaris($pemindahanInventaris->load(['kantorTujuan', 'lantaiTujuan', 'ruanganTujuan']));

        Alert::toast('Approved ' . $pemindahanInventaris->judul_pemindahan_inventaris);

        return redirect('/approval-pemindahan-inventaris')->with('success', 'Pemindahan Inventaris approved');
    }

    public function rejectPemindahanInventaris(PemindahanInventaris $pemindahanInventaris, Request $request) {
        $request->validate(['alasan_rejection' => 'required|string|max:255']);

        $pemindahanInventaris->rejectPemindahanInventaris($request->all()['alasan_rejection']);

        Inventaris::rejectPemindahanInventaris($pemindahanInventaris);

        Alert::toast('Approved ' . $pemindahanInventaris->judul_pemindahan_inventaris);

        return redirect('/approval-pemindahan-inventaris')->with('success', 'Pemindahan Inventaris approved');
    }

    public function inputLaporanInventaris() {
        $kategoriRecord = Kategori::getKategoriRecords();
        $kantorRecord = Kantor::getKantorRecords();

        return view('laporan-inventaris.input', compact('kategoriRecord', 'kantorRecord'));
    }

    public function laporanInventaris(Request $request) {
        $request = $request->validate([
            'start_date' => 'required_unless:proporsi,on|date|before_or_equal:end_date|before_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date|before_or_equal:today',
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
                'before_or_equal:today',
                function ($attribute, $value, $fail) use ($request){
                    if ($request->has('proposisi')) {
                        $startDate = Carbon::parse($request->start_date);
                        $endDate = Carbon::parse($value);
        
                        if ($startDate->diffInMonths($endDate) > 1) {
                            $fail('The end date must be within 1 month of the start date');
                        }
                    }
                },
            ],
            'proporsi' => 'nullable',
            'kategori_id' => 'nullable|numeric|exists:kategori,kategori_id',
            'kantor_id' => 'nullable|numeric|exists:kantor,kantor_id',
            'status' => 'nullable|in:Approval 1,Approval 2,Pending Approval',
            'kondisi' => 'nullable|in:Normal,Rusak'
        ]);

        $laporanRecord = Inventaris::getLaporanInventaris($request);

        return view('laporan-inventaris.result', compact('laporanRecord', 'request'));
    }

    public function downloadLaporanInventaris(Request $request) {
        return Excel::download(new InventarisExport($request->all()), 'laporan_inventaris-' . Carbon::now()->toDateString() . '.csv');
    }

    public function inputLaporanPemindahanInventaris() {
        $kantorRecord = Kantor::getKantorRecords();

        return view('laporan-pemindahan-inventaris.input', compact('kantorRecord'));
    }

    public function laporanPemindahanInventaris(Request $request) {
        $request = $request->validate([
            'start_date' => 'required_unless:proporsi,on|date|before_or_equal:end_date|before_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date|before_or_equal:today',
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
                'before_or_equal:today',
                function ($attribute, $value, $fail) use ($request){
                    $startDate = Carbon::parse($request->start_date);
                    $endDate = Carbon::parse($value);
    
                    if ($startDate->diffInMonths($endDate) > 1) {
                        $fail('The end date must be within 1 month of the start date');
                    }
                },
            ],
            'proporsi' => 'nullable',
            'kantor_id' => 'nullable|numeric|exists:kantor,kantor_id',
            'status' => 'nullable|in:Approval 1,Approval 2,Pending Approval',
        ]);

        $laporanRecord = PemindahanInventaris::getLaporanPemindahanInventaris($request);

        return view('laporan-pemindahan-inventaris.result', compact('laporanRecord', 'request'));
    }

    public function downloadLaporanPemindahanInventaris(Request $request) {
        return Excel::download(new PemindahanInventarisExport($request->all()), 'laporan_pemindahan_inventaris-' . Carbon::now()->toDateString() . '.csv');
    }
}
