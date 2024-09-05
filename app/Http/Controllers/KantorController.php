<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Kantor;
use App\Models\Lantai;
use App\Models\Ruangan;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use App\Http\Requests\AddKantorRequest;
use App\Http\Requests\EditKantorRequest;
use RealRashid\SweetAlert\Facades\Alert;

class KantorController extends Controller
{
    public function getLantaiByKantor($kantorId) {
        return Lantai::getLantaiByKantor($kantorId);
    }

    public function getRuanganByLantai($lantaiId) {
        return Ruangan::getRuanganByLantai($lantaiId);
    }

    public function getKabupatenByProvinsi($provinsiId) {
        return Kabupaten::getKabupatenByProvinsi($provinsiId);
    }

    public function showKantor() {
        $addKantor = Role::checkPermission('add-kantor');
        $editKantor = Role::checkPermission('edit-kantor');
        $deleteKantor = Role::checkPermission('delete-kantor');

        $kantorRecords = Kantor::getDetailedKantorRecords();

        return view('kantor.index', compact('addKantor', 'editKantor', 'deleteKantor', 'kantorRecords'));
    }

    public function showKantorDetails(Kantor $kantor) {
        $editKantor = Role::checkPermission('edit-kantor');
        $deleteKantor = Role::checkPermission('delete-kantor');

        $kantorDetails = $kantor;
        $kantorDetails->getKantorDetails();
        
        return view('kantor.view', compact('editKantor', 'deleteKantor', 'kantorDetails'));
    }

    public function showRuanganDetails(Ruangan $ruangan) {
        $ruanganDetails = $ruangan;
        $ruanganDetails->getRuanganDetails();

        return view('kantor.ruangan', compact('ruanganDetails'));
    }

    public function showAddKantor() {
        $provinsiRecord = Provinsi::getProvinsiRecords();
        $kabupatenRecord = Kabupaten::getKabupatenRecords();

        return view('kantor.add', compact('provinsiRecord', 'kabupatenRecord'));
    }

    public function addKantor(AddKantorRequest $request) {
        $request = $request->validated();
        $data = $request['lantai'] ?? [];

        $kantor = Kantor::createKantor($request);

        foreach ($data as $lantaiData) {
            $lantai = Lantai::createLantai($lantaiData['nama_lantai'], $kantor->kantor_id);

            if (isset($lantaiData['ruangan']) && is_array($lantaiData['ruangan'])) {
                foreach ($lantaiData['ruangan'] as $ruanganData) {
                    Ruangan::createRuangan($ruanganData, $lantai->lantai_id);
                }
            }
        }

        Alert::toast('Kantor added');

        return redirect('/kantor-management')->with('success', 'Kantor added');
    }

    public function showEditKantor(Kantor $kantor) {
        $kantor->load(['provinsi.kabupaten', 'kabupaten', 'lantai.ruangan']);
        $provinsiRecord = Provinsi::getProvinsiRecords();

        return view('kantor.edit', compact('kantor', 'provinsiRecord'));
    }

    public function editKantor(Kantor $kantor, EditKantorRequest $request) {
        $request = $request->validated();

        $kantor->updateKantor($request);

        $lantaiData = $request['lantai'] ?? [];
        $lantaiIds = array();
        $ruanganIds = array();
        
        foreach ($lantaiData as $lantai) {
            if (isset($lantai['lantai_id']) && !empty($lantai['lantai_id'])) {
                Lantai::updateLantai($lantai['lantai_id'], $lantai);
            }
            else {
                $newLantai = Lantai::createLantai($lantai['nama_lantai'], $kantor->kantor_id);
                $lantaiIds[] = $newLantai->lantai_id;
            }

            $ruanganData = $lantai['ruangan'] ?? [];
            foreach ($ruanganData as $ruangan) {
                if (isset($ruangan['ruangan_id']) && !empty($ruangan['ruangan_id'])) {
                    Ruangan::updateRuangan($ruangan['ruangan_id'], $ruangan);
                }
                else {
                    $newRuangan = Ruangan::createRuangan($ruangan, $lantai['lantai_id'] ?? $newLantai->lantai_id);
                    $ruanganIds[] = $newRuangan->ruangan_id;
                }
            }

            if (isset($lantai['lantai_id']) && !empty($lantai['lantai_id'])) {
                $existingRuanganIds = array_merge(array_column($ruanganData, 'ruangan_id'), $ruanganIds);
                Ruangan::deleteRuangan($existingRuanganIds, $lantai['lantai_id']);
            }
        }

        $existingLantaiIds = array_merge(array_column($lantaiData, 'lantai_id'), $lantaiIds);
        Lantai::deleteLantai($existingLantaiIds, $kantor->kantor_id);

        Alert::toast('Kantor edited');

        return redirect('/kantor-management')->with('success', 'Kantor edited');
    }

    public function deleteKantor(Kantor $kantor) {
        $kantor->delete();

        Alert::toast('Kantor deleted');

        return redirect('/kantor-management')->with('success', 'Kantor deleted');        
    }
}
