@extends('layouts.user.master')

@section('content')
    <div class="card shadow mb-4" style="height: 550px;">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Status Validasi</h5>
                        </div>
                        <div class="card-body">
                            @if (session('status_terbit', false))
                                <div class="alert alert-info" role="alert">
                                    Status Validasi: Data hasil akhir telah diterbitkan oleh admin.
                                </div>
                            @endif

                            @if ($calon)
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action status-pending">
                                        @if ($calon->status == 'pending')
                                            <div class="alert alert-warning" role="alert">
                                                <strong>Proses Validasi Sedang Berlangsung, Mohon Menunggu Validasi dari
                                                    Admin.</strong>
                                            </div>
                                            <strong>Status : Pending</strong> - Menunggu validasi admin.
                                        @elseif ($calon->status == 'accepted')
                                            <div class="alert alert-success" role="alert">
                                                <strong>Anda Dinyatakan Lolos Untuk Menjadi Calon RT/RW</strong>
                                            </div>
                                            <strong>Status : Diterima</strong> - Selamat, Anda telah diterima sebagai calon
                                            RT/RW dan menunggu proses selanjutnya yaitu penilaian sesuai kriteria.
                                        @elseif ($calon->status == 'rejected')
                                            <div class="alert alert-danger" role="alert">
                                                <strong>Maaf, Sepertinya Anda tidak memenuhi syarat untuk jadi calon RT/RW.
                                                    Tetapi terima kasih sudah tertarik!</strong>
                                            </div>
                                            <strong>Status : Ditolak</strong> - Maaf, Anda tidak memenuhi kriteria yang
                                            ditentukan.
                                        @endif
                                    </a>
                                </div>

                                <div class="proses-alur">
                                    <div class="proses-item">
                                        <div
                                            class="circle {{ $calon->status == 'pending' && !session('status_terbit', false) ? 'active' : '' }}">
                                            <div class="circle-text">1</div>
                                        </div>
                                        <p>Proses Validasi</p>
                                    </div>
                                    <div class="arrow"></div>
                                    <div class="proses-item">
                                        <div
                                            class="circle {{ ($calon->status == 'accepted' || $calon->status == 'rejected') && !session('status_terbit', false) ? 'active' : '' }}">
                                            <div class="circle-text">2</div>
                                        </div>
                                        <p>Hasil Validasi</p>
                                    </div>
                                    <div class="arrow"></div>
                                    <div class="proses-item">
                                        <div class="circle {{ session('status_terbit', false) ? 'active' : '' }}">
                                            <div class="circle-text">3</div>
                                        </div>
                                        <p>Pengumuman</p>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning" role="alert">
                                    Anda belum melakukan <strong>pendaftaran</strong> . Silahkan melakukan pendaftaran
                                    menjadi calon RT/RW
                                    terlebih dahulu.
                                </div>
                                <a href="{{ route('pendaftaran_rt_rw.create') }}" type="button" class="btn btn-primary">
                                    Pendaftaran
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .status-pending {
            animation: fadeInUp 1s ease-out;
        }

        .proses {
            font-style: italic;
        }

        .proses-alur {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 30px;
        }

        .proses-item {
            text-align: right;
        }

        .circle {
            width: 100px;
            height: 100px;
            background-color: #ccc;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: right;
            justify-content: right;
            margin-bottom: 5px;
            position: relative;
        }

        .circle.active {
            background-color: #4caf50;
            /* Warna hijau */
        }

        .circle-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .arrow {
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 15px 0 15px 30px;
            border-color: transparent transparent transparent #ccc;
        }

        /* Tambahkan gaya khusus untuk menghilangkan efek active pada Hasil Validasi ketika Pengumuman aktif */
        .circle.active+.arrow+.proses-item:last-child .circle {
            background-color: #ccc;
        }

        .circle.active+.arrow+.proses-item:last-child .circle-text {
            color: #fff;
        }

        .circle.active+.arrow+.proses-item:nth-child(2) .circle {
            background-color: #ccc;
        }

        .circle.active+.arrow+.proses-item:nth-child(2) .circle-text {
            color: #fff;
        }
    </style>
@endsection
