<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Calon;
use App\Models\DataPenilaian;
use Dompdf\Dompdf;
use Illuminate\View\View;

class HitungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function data_perhitungan()
    {
        $kriteria = Kriteria::all();
        $calon = Calon::all();
        $dataPenilaian = DataPenilaian::all();
        
        $totalKuadrat = [];

        foreach ($kriteria as $kriteriaItem) {
            $totalKuadrat[$kriteriaItem->kriteria_id] = 0;
        }

        foreach ($calon as $item) {
            if ($item->dataPenilaian->isNotEmpty()) {
                foreach ($kriteria as $kriteriaItem) {
                    $penilaian = $item->dataPenilaian
                        ->whereIn('penilai_id', [1, 2, 3, 4, 5])
                        ->where('id_kriteria', $kriteriaItem->kriteria_id)
                        ->sum('nilai');

                    $nilaiKuadrat = pow($penilaian, 2);
                    $totalKuadrat[$kriteriaItem->kriteria_id] += $nilaiKuadrat;
                }
            }
        }

        $akarKuadratTotal = [];

        foreach ($totalKuadrat as $kriteriaId => $total) {
            $akarKuadratTotal[$kriteriaId] = sqrt($total);
        }

       // Menghitung matriks normalisasi (R)
        $matriksNormalisasi = [];
        
        foreach ($calon as $item) {
            if ($item->dataPenilaian->isNotEmpty()) {
                $barisNormalisasi = [];
                foreach ($kriteria as $kriteriaItem) {
                    $penilaian = $item->dataPenilaian
                        ->whereIn('penilai_id', [1, 2, 3, 4, 5])
                        ->where('id_kriteria', $kriteriaItem->kriteria_id)
                        ->sum('nilai');

                    // Normalisasi nilai menggunakan akar kuadrat total
                    $nilaiNormalisasi = $penilaian / $akarKuadratTotal[$kriteriaItem->kriteria_id];
                    $barisNormalisasi[] = $nilaiNormalisasi;
                }
                $matriksNormalisasi[] = $barisNormalisasi;
            }
        }

        
        // Perhitungan matriks terbobot
        $matriksBobot = [];

        foreach ($calon as $index => $item) {
            if ($item->dataPenilaian->isNotEmpty()) {
                $barisBobot = [];
                foreach ($kriteria as $kriteriaItem) {
                    $penilaian = $item->dataPenilaian
                        ->whereIn('penilai_id', [1, 2, 3, 4, 5])
                        ->where('id_kriteria', $kriteriaItem->kriteria_id)
                        ->sum('nilai');

                    $bobot = $kriteriaItem->bobot;
                    $nilaiNormalisasi = $penilaian / $akarKuadratTotal[$kriteriaItem->kriteria_id];

                    // Operasi perkalian elemen demi elemen
                    $nilaiMatriksBobot = $nilaiNormalisasi * $bobot;
                    $barisBobot[] = $nilaiMatriksBobot;
                }
                $matriksBobot[] = $barisBobot;
            }
        }


        // Tabel untuk menampilkan A+ dan A-
        $aPlus = [];
        $aMinus = [];

        foreach ($kriteria as $kriteriaItem) {
            $aPlus[$kriteriaItem->kriteria_id] = 0;
            $aMinus[$kriteriaItem->kriteria_id] = PHP_INT_MAX;

            foreach ($matriksBobot as $barisBobot) {
                $nilaiKriteria = $barisBobot[$kriteriaItem->kriteria_id - 1];

                // Mencari nilai maksimum dan minumum untuk kriteria benefit
                if ($kriteriaItem->jenis_kriteria === 'benefit') {
                    $aPlus[$kriteriaItem->kriteria_id] = max($aPlus[$kriteriaItem->kriteria_id], $nilaiKriteria);
                    $aMinus[$kriteriaItem->kriteria_id] = min($aMinus[$kriteriaItem->kriteria_id], $nilaiKriteria);
                }
                // Mencari nilai minimum dan maksimum untuk kriteria cost
                elseif ($kriteriaItem->jenis_kriteria === 'cost') {
                    $aPlus[$kriteriaItem->kriteria_id] = min($aMinus[$kriteriaItem->kriteria_id], $nilaiKriteria);
                }
            }
        }

        
        // Hitung jarakPlus dan jarakMinus
        $jarakPlus = [];
        $jarakMinus = [];

        foreach ($calon as $index => $item) {
            if ($item->dataPenilaian->isNotEmpty()) {
                $jarakPlus[$index] = 0;
                $jarakMinus[$index] = 0;

                foreach ($kriteria as $kriteriaItem) {
                    $nilaiKriteria = $matriksBobot[$index][$kriteriaItem->kriteria_id - 1];

                    // Hitung jarakPlus
                    $jarakPlus[$index] += pow($nilaiKriteria - $aPlus[$kriteriaItem->kriteria_id], 2);

                    // Hitung jarakMinus
                    $jarakMinus[$index] += pow($nilaiKriteria - $aMinus[$kriteriaItem->kriteria_id], 2);
                }

                $jarakPlus[$index] = sqrt($jarakPlus[$index]);
                $jarakMinus[$index] = sqrt($jarakMinus[$index]);
            }
        }
       // Menghitung nilai preferensi
        $nilaiPreferensi = [];

        foreach ($calon as $index => $item) {
            // Periksa apakah calon sudah dinilai (sesuaikan dengan properti yang menandakan bahwa calon sudah dinilai)
            if (isset($jarakMinus[$index], $jarakPlus[$index])) {
                // Menghitung nilai preferensi
                $nilaiPreferensi[$index] = $jarakMinus[$index] / ($jarakMinus[$index] + $jarakPlus[$index]);
            }
        }

        // Mendapatkan peringkat
        arsort($nilaiPreferensi);
        $peringkat = array_keys($nilaiPreferensi);



        // 6. Rangking
        arsort($nilaiPreferensi);
        $rangking = 1;

        return view('admin.data_perhitungan.index',compact('kriteria', 'calon','totalKuadrat','akarKuadratTotal','matriksNormalisasi','matriksBobot', 'aPlus', 'aMinus','jarakPlus','jarakMinus', 'nilaiPreferensi', 'rangking'));
    }

    public function data_perhitungan_penilai()
    {
        $dataHasilAkhir = $this->data_perhitungan();
        $kriteria = $dataHasilAkhir['kriteria'];
        $calon = $dataHasilAkhir['calon'];
        $totalKuadrat = $dataHasilAkhir ['totalKuadrat'];
        $akarKuadratTotal = $dataHasilAkhir ['akarKuadratTotal'];
        $matriksNormalisasi = $dataHasilAkhir['matriksNormalisasi'];
        $matriksBobot = $dataHasilAkhir ['matriksBobot'];
        $aPlus = $dataHasilAkhir ['aPlus'];
        $aMinus = $dataHasilAkhir ['aMinus'];
        $jarakPlus = $dataHasilAkhir ['jarakPlus'];
        $jarakMinus = $dataHasilAkhir ['jarakMinus'];
        $nilaiPreferensi = $dataHasilAkhir['nilaiPreferensi'];
        $rangking = $dataHasilAkhir['rangking'];

        return view('penilai.data_perhitungan.index',compact('kriteria', 'calon','totalKuadrat','akarKuadratTotal','matriksNormalisasi','matriksBobot', 'aPlus', 'aMinus','jarakPlus','jarakMinus', 'nilaiPreferensi', 'rangking'));
    }

    public function data_hasil_akhir()
    {
        $dataHasilAkhir = $this->data_perhitungan();
        $kriteria = $dataHasilAkhir['kriteria'];
        $calon = $dataHasilAkhir['calon'];
        $nilaiPreferensi = $dataHasilAkhir['nilaiPreferensi'];
        $rangking = $dataHasilAkhir['rangking'];
        // dd($calon, $nilaiPreferensi);

        return view('admin.data_hasil_akhir.index',compact('kriteria','calon','nilaiPreferensi', 'rangking'));
    }
    public function data_hasil_akhir_penilai()
    {
        $dataHasilAkhir = $this->data_perhitungan();
        $kriteria = $dataHasilAkhir['kriteria'];
        $calon = $dataHasilAkhir['calon'];
        $nilaiPreferensi = $dataHasilAkhir['nilaiPreferensi'];
        $rangking = $dataHasilAkhir['rangking'];

        return view('penilai.data_hasil_akhir.index',compact('kriteria', 'calon','nilaiPreferensi', 'rangking'));
    }

    public function data_hasil_akhir_user()
    {
        $dataHasilAkhir = $this->data_perhitungan();
        $kriteria = $dataHasilAkhir['kriteria'];
        $calon = $dataHasilAkhir['calon'];
        $nilaiPreferensi = $dataHasilAkhir['nilaiPreferensi'];
        $rangking = $dataHasilAkhir['rangking'];

        return view('user.data_hasil_akhir.index',compact('kriteria', 'calon','nilaiPreferensi', 'rangking'));
    }

    public function cetakPDF()
    {
        $dataHasilAkhir = $this->data_hasil_akhir();

        $kriteria = $dataHasilAkhir['kriteria'];
        $calon = $dataHasilAkhir['calon'];
        $nilaiPreferensi = $dataHasilAkhir['nilaiPreferensi'];
        $rangking = $dataHasilAkhir['rangking'];

        $view = view('admin.data_hasil_akhir.cetak_data_hasil_akhir', compact('kriteria', 'calon', 'nilaiPreferensi', 'rangking'));
        $html = $view->render();

        // Buat instance Dompdf
        $dompdf = new Dompdf();

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Konfigurasi opsi rendering dan ukuran kertas
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream('data-hasil-akhir.pdf');
    }
    


}