<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function showKategori() {
        $addKategori = Role::checkPermission('add-kategori');
        $editKategori = Role::checkPermission('edit-kategori');
        $deleteKategori = Role::checkPermission('delete-kategori');

        $kategoriRecord = Kategori::getKategori();

        return view('kategori.index', compact('addKategori', 'editKategori', 'deleteKategori', 'kategoriRecord'));
    }

    public function showAddKategori() {
        return view('kategori.add');
    }

    public function addKategori(Request $request) {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
        ]);

        Kategori::createKategori($request->all());

        Alert::toast('Kategori created');

        return redirect('/kategori-management')->with('success', 'New kategori created');
    }

    public function showEditKategori(Kategori $kategori) {
        if(!$kategori) return redirect('/kategori-management')->with('error', 'Kategori not found');

        $namaKategori = $kategori->nama_kategori;

        return view('kategori.edit', compact('namaKategori'));
    }

    public function editKategori(Kategori $kategori, Request $request) {
        $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kategori')->ignore($kategori->kategori_id, 'kategori_id'),
            ]
        ]);

        Kategori::updateKategori($kategori, $request->all());

        Alert::toast('Kategori updated');

        return redirect('/kategori-management')->with('success', 'Kategori updated');        
    }

    public function deleteKategori(Kategori $kategori) {
        $kategori->delete();

        Alert::toast('Kategori deleted');

        return redirect('/kategori-management')->with('success', 'Kategori deleted');        
    }
}
