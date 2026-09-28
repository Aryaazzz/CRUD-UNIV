<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\mahasiswa;
use App\Models\MataKuliah;
use App\Models\prodi;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalMahasiswa = mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalProdi = prodi::count();
        $totalMataKuliah = MataKuliah::count();
        $totalSks = MataKuliah::sum('sks');

        $prodis = prodi::withCount(['mahasiswas', 'dosens'])->get();
        $recentMahasiswas = mahasiswa::with(['prodi', 'mataKuliahs'])->latest()->take(5)->get();
        $recentDosens = Dosen::with('prodi')->latest()->take(4)->get();
        $mataKuliahs = MataKuliah::withCount('mahasiswas')->get();

        return view('dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalProdi',
            'totalMataKuliah',
            'totalSks',
            'prodis',
            'recentMahasiswas',
            'recentDosens',
            'mataKuliahs'
        ));
    }
}
