<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SPK TOPSIS</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin') }}/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('administrator.dashboard_admin') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="sidebar-brand-text mx-1"><sup>SPK Pemilihan RT/RW</sup>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->routeIs('administrator.dashboard_admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('administrator.dashboard_admin') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard Admin</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                TOPSIS
            </div>

            <!-- Nav Item - Kelola Kriteria -->
            <li class="nav-item {{ request()->routeIs('kelola_kriteria.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kelola_kriteria.index') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Kelola Kriteria</span></a>
            </li>

            <!-- Nav Item - Kelola Calon  -->
            <li class="nav-item {{ request()->routeIs('kelola_calon.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kelola_calon.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Kelola Calon</span></a>
            </li>

            <!-- Nav Item - Validasi   -->
            <li class="nav-item {{ request()->routeIs('administrator.validasi_calon.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('administrator.validasi_calon.index') }}">
                    <i class="fas fa-fw fa-check"></i>
                    <span>Validasi Calon</span></a>
            </li>

            <!-- Nav Item - Data Penilaian -->
            <li class="nav-item {{ request()->routeIs('administrator.data_penilaian.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('administrator.data_penilaian.index') }}">
                    <i class="fas fa-fw  fa-edit"></i>
                    <span>Data Penilaian</span>
                </a>
            </li>

            <!-- Nav Item - Data Perhitungan -->
            <li class="nav-item {{ request()->routeIs('administrator.data_perhitungan') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('administrator.data_perhitungan') }}">
                    <i class="fas fa-fw fa-calculator"></i>
                    <span>Data Perhitungan</span>
                </a>
            </li>

            <!-- Nav Item - Data Hasil Akhir -->
            <li class="nav-item {{ request()->routeIs('administrator.data_hasil_akhir') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('administrator.data_hasil_akhir') }}">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Data Hasil Akhir</span>
                </a>
            </li>

            <!-- Nav Item - Data Pendaftaran RT/RW -->
            <li class="nav-item {{ request()->routeIs('administrator.data_pendaftaran_rt_rw') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('administrator.data_pendaftaran_rt_rw') }}">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>Data Pendaftaran RT/RW</span>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manajemen Akun</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manajemen Akun:</h6>
                        <a class="collapse-item" href="{{ route('administrator.manajemen_akun/kelola_admin') }}">Kelola
                            Admin</a>
                        <a class="collapse-item"
                            href="{{ route('administrator.manajemen_akun/kelola_penilai') }}">Kelola
                            Penilai</a>
                        <a class="collapse-item" href="{{ route('administrator.manajemen_akun/kelola_user') }}">Kelola
                            User</a>

                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('admin') }}/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('administrator.logout') }}"
                                    data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                    <form id="logout-form" action="{{ route('administrator.logout') }}"
                                        method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;Sistem Pendukung Keputusan</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Siap untuk mengakhiri sesi?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">cancel</button>
                    <a class="btn btn-danger"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin') }}/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin') }}/vendor/chart.js/Chart.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin') }}/js/demo/chart-area-demo.js"></script>
    <script src="{{ asset('admin') }}/js/demo/chart-pie-demo.js"></script>
    <script src="{{ asset('admin') }}/js/demo/datatables-demo.js"></script>

</body>

</html>
