<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard() {
        $kategoriCount = Kategori::getKategoriCount();
        $kondisiCount = Inventaris::getInventarisKondisiCount();
        $statusCount = Inventaris::getInventarisStatusCount();

        return view('dashboard', compact('kategoriCount', 'kondisiCount', 'statusCount'));
    }
}
