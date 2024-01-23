    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            table.static {
                position: relative;
                border: 1px solid
            }
        </style>
        <title>CETAK DATA HASIL PERHITUNGAN</title>
    </head>

    <body>
        <div class="form-group">
            <p style="text-align: center">
                <b>Laporan Hasil Pemilihan RT/RW Menggunakan Metode TOPSIS</b>
            </p>
            <p style="text-align: center"><b>Perum Griya Satria Bukit Permata Purwokerto RT.02 RW.22</b></p>
            <table classs="static" align="center" rules="all" border="1px" style="width: 95%">
                <thead>
                    <tr>
                        <th>Nama Calon</th>
                        <th>Nilai Preferensi</th>
                        <th>Ranking</th>
                    </tr>
                </thead>
                <tbody style="text-align: center">
                    @php
                        $no = 1;
                        arsort($nilaiPreferensi);
                    @endphp
                    @foreach ($nilaiPreferensi as $index => $nilai)
                        <tr style="text-align: center">
                            <td>{{ $calon[$index]->nama_calon }}</td>
                            <td>{{ number_format($nilai, 3) }}</td>
                            <td>{{ $no++ }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>

    </html>
