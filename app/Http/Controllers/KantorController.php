<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use App\Models\Role;
use Illuminate\Http\Request;

class KantorController extends Controller
{
    public function showKantor() {
        $addKantor = Role::checkPermission('add-kantor');
        $editKantor = Role::checkPermission('edit-kantor');
        $deleteKantor = Role::checkPermission('delete-kantor');

        $kantorRecords = Kantor::getDetailedKantorRecords();

        $title = 'Delete Kantor';
        $text = "Are you sure you want to delete kantor?";
        confirmDelete($title, $text);

        return view('kantor.index', compact('addKantor', 'editKantor', 'deleteKantor', 'kantorRecords'));
    }

    public function showKantorDetails(Kantor $kantor) {
        $editKantor = Role::checkPermission('edit-kantor');
        $deleteKantor = Role::checkPermission('delete-kantor');

        $kantorDetails = Kantor::getKantorDetails($kantor);
        
        return view('kantor.view', compact('editKantor', 'deleteKantor', 'kantorDetails'));
    }
}
