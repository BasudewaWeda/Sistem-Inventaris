<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Kantor;
use App\Models\Lantai;
use App\Models\Ruangan;
use App\Models\Kategori;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use App\Models\InputInventaris;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\AddInventarisRequest;

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
        $inventarisDetails = Inventaris::getInvetarisDetails($inventaris);

        return view('inventaris.view', compact('inventarisDetails'));
    }

    public function showInputInventaris() {
        $inputInventarisRecord = InputInventaris::getInputInventarisByApprover();

        return view('input-inventaris.index', compact('inputInventarisRecord'));
    }

    public function showInputInventarisDetails(InputInventaris $inputInventaris) {
        $inputInventarisDetails = InputInventaris::getInputInventarisDetails($inputInventaris);
        $currentUser = User::getCurrentUser();

        return view('input-inventaris.view', compact('inputInventarisDetails', 'currentUser'));
    }

    public function showAddInventaris() {
        $firstApprovers = User::getFirstApprovers();
        $secondApprovers = User::getSecondApprovers();
        $kategoriRecord = Kategori::getKategori();
        $kantorRecord = Kantor::getKantorRecords();

        return view('inventaris.add', compact('firstApprovers', 'secondApprovers', 'kategoriRecord', 'kantorRecord'));
    }

    public function addInventaris(AddInventarisRequest $request) {
        $request->validated();

        $inputInventaris = InputInventaris::createInputInventaris($request->all());

        Inventaris::createInventaris($request->all(), $inputInventaris->input_inventaris_id);

        Alert::toast('Inventaris added');

        return redirect('/inventaris-management')->with('success', 'Inventaris added');
    }

    public function approveInputInventaris(InputInventaris $inputInventaris) {
        InputInventaris::approveInputInventaris($inputInventaris);

        // Inventaris::approveInventaris($inputInventaris->inventaris, $inputInventaris->status_input_inventaris);

        Inventaris::approveInventaris($inputInventaris->load(['kantor']));

        Alert::toast('Approved ' . $inputInventaris->judul_input_inventaris);

        return redirect('/approval-inventaris')->with('success', 'Input Inventaris approved');
    }

    public function rejectInputInventaris(InputInventaris $inputInventaris, Request $request) {
        $request->validate(['alasan_rejection' => 'required|string|max:255']);
        
        InputInventaris::rejectInputInventaris($inputInventaris, $request->all()['alasan_rejection']);

        Alert::toast('Rejected ' . $inputInventaris->judul_input_inventaris);

        return redirect('/approval-inventaris')->with('success', 'Input Inventaris rejected');
    }
}
