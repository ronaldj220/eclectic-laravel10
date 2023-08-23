<html>

<head>
    <title>Eclectic (Karyawan) | {{ $title }}</title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets') }}/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="icon" href="{{ asset('logo.png') }}">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar"
            style="background-color: #900C3F">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('karyawan.beranda') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('ECLECTIC GSM CROP1.png') }}" alt="" width="90%">
                </div>
                <div class="sidebar-brand-text">
                    <img src="{{ asset('ECLECTIC GSM CROP2.png') }}" alt="" width="100%">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('karyawan.beranda') }}">
                    <i class="fa-solid fa-home"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('karyawan.reimbursement') }}">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <span>Reimbursement</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('karyawan.cash_advance') }}">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <span>Cash Advance</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('karyawan.cash_advance_report') }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Cash Advance Report</span></a>
            </li>

            @if (Auth::guard('karyawan')->user()->jabatan == 'Staff')
                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('karyawan.purchase_request') }}">
                        <i class="fa-solid fa-chart-bar"></i>
                        <span>Purchase Request</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('karyawan.purchase_order') }}">
                        <i class="fa-solid fa-cart-arrow-down"></i>
                        <span>Purchase Order</span></a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            @if (Auth::guard('karyawan')->user()->jabatan == 'Konsultan')
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://drive.google.com/file/d/1FYmGvS7aYSU4HFpk7zngHP5TPRfcQSVf/view?usp=sharing">
                        <i class="fa-regular fa-circle-question"></i>
                        <span>Help</span></a>
                </li>
            @elseif (Auth::guard('karyawan')->user()->jabatan == 'Project Manager')
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://drive.google.com/file/d/1AFEoQgVbNCqmZuyB98W3pvWQflVISr-5/view?usp=sharing">
                        <i class="fa-regular fa-circle-question"></i>
                        <span>Help</span></a>
                </li>
            @elseif (Auth::guard('karyawan')->user()->jabatan == 'Support Manager')
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://drive.google.com/file/d/1AFEoQgVbNCqmZuyB98W3pvWQflVISr-5/view?usp=sharing">
                        <i class="fa-regular fa-circle-question"></i>
                        <span>Help</span></a>
                </li>
            @elseif (Auth::guard('karyawan')->user()->jabatan == 'Staff')
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://drive.google.com/file/d/1AFEoQgVbNCqmZuyB98W3pvWQflVISr-5/view?usp=sharing">
                        <i class="fa-regular fa-circle-question"></i>
                        <span>Help</span></a>
                </li>
            @endif

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

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('karyawan')->user()->nama }}
                                    <br>
                                    <small>{{ Auth::guard('karyawan')->user()->jabatan }}</small></span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets') }}/img/undraw_profile_3.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="{{ route('karyawan.beranda.profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile ({{ Auth::guard('karyawan')->user()->nama }}) |
                                    {{ Auth::guard('karyawan')->user()->jabatan }}
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container" style="margin-right: 60px;">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Update Profil
                                        Karyawan</h6>
                                </div>
                                <div class="card-body">
                                    <form
                                        action="{{ route('karyawan.beranda.profile.update_profile_karyawan', Auth::guard('karyawan')->user()->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="col-md-12">
                                            <label class="" for="">Email:</label>
                                            <input type="text" name="email" class="form-group form-control"
                                                value="{{ Auth::guard('karyawan')->user()->email }}" readonly>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="" for="">Nama:</label>
                                            <input type="text" name="nama" class="form-group form-control"
                                                value="{{ Auth::guard('karyawan')->user()->nama }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="" for="">No Rekening:</label>
                                            <input type="number" name="no_rekening" class="form-group form-control"
                                                value="{{ Auth::guard('karyawan')->user()->no_rekening }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="" for="">Bank:</label>
                                            <input type="text" name="bank" class="form-group form-control"
                                                value="{{ Auth::guard('karyawan')->user()->bank }}">
                                        </div>
                                        <button class="btn btn-primary"><i
                                                class="fa-solid fa-pen-nib fa-bounce"></i>&nbsp;Update</button>
                                        <a href="{{ route('karyawan.beranda.profile') }}" class="btn btn-danger"><i
                                                class="fa-solid fa-backward fa-bounce"></i>&nbsp;Kembali</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Eclectic {{ date('Y') }}</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets') }}/js/sb-admin-2.min.js"></script>
</body>

</html>
