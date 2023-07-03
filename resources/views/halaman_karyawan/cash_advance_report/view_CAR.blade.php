<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

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
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">pt. eclectic</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('karyawan.beranda') }}">
                    <i class="fa-solid fa-home fa-beat-fade"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('karyawan.reimbursement') }}">
                    <i class="fa-solid fa-money-bill-transfer fa-beat-fade"></i>
                    <span>Reimbursement</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('karyawan.cash_advance') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Cash Advance</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('karyawan.cash_advance_report') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Cash Advance Report</span></a>
            </li>

            @if (Auth::guard('karyawan')->user()->jabatan == 'Staff')
                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('karyawan.purchase_request') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Purchase Request</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('karyawan.purchase_order') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Purchase Order</span></a>
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

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


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
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container" style="margin-right: 60px">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Lihat Cash Advance Report dengan
                                No
                                {{ $cash_advance_report->no_doku }}</h6>
                        </div>
                        <div class="card-body">
                            <form
                                action="{{ route('admin.cash_advance.setujui_cash_advance', $cash_advance_report->id) }}"
                                method="POST">
                                @csrf
                                <table class="table is-striped table-bordered border-dark table-sm"
                                    style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 3%">No.</th>
                                            <th class="text-center" style="width: 68%">Keterangan</th>
                                            <th class="text-center" style="width: 12%;">No. Bukti</th>
                                            <th class="text-center" style="width: 5%">Curr</th>
                                            <th class="text-center" style="width: 12%">Nominal</th>
                                        </tr>
                                    </thead>
                                    <!-- Details -->
                                    <?php $no = 1; ?>
                                    @foreach ($car_detail as $item)
                                        <tr>
                                            <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                                            </td>
                                            <td style="text-transform:capitalize;">{{ $item->deskripsi }}
                                                {{ date('d/m/Y', strtotime($item->tanggal_1)) }}
                                            </td>
                                            <td class="text-center" style="max-width: 12%; word-break: break-all;">
                                                {{ $item->no_bukti }}</td>
                                            <td class="text-center" style="max-width: 5%;">{{ $item->curr }}
                                            </td>
                                            <td class="text-right">
                                                {{ number_format($item->nominal, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Total Price -->
                                    <tr style="font-weight: bold">
                                        <td colspan="3" class="text-right">Jumlah</td>
                                        <td class="text-center">{{ $item->curr }}</td>
                                        <td class="text-right">{{ number_format($nominal, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr style="font-weight: bold">
                                        <td colspan="3" class="text-right">Cash Advance
                                            {{ $cash_advance_report->tipe_ca }}</td>
                                        <td class="text-center">{{ $item->curr }}</td>
                                        <td class="text-right">
                                            {{ number_format($cash_advance_report->nominal_ca, 0, ',', '.') }}</td>
                                    </tr>
                                    @if ($nominal < $cash_advance_report->nominal_ca)
                                        <tr style="font-weight: bold">
                                            <td colspan="3" class="text-right">Lebih</td>
                                            <td class="text-center">{{ $item->curr }}</td>
                                            <td class="text-right">
                                                {{ number_format(abs($nominal - $cash_advance_report->nominal_ca), 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @elseif ($nominal > $cash_advance_report->nominal_ca)
                                        <tr style="font-weight: bold">
                                            <td colspan="3" class="text-right" style="color: red">Kurang</td>
                                            <td class="text-center">{{ $item->curr }}</td>
                                            <td class="text-right">
                                                {{ number_format(abs($nominal - $cash_advance_report->nominal_ca), 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @elseif ($nominal = $cash_advance_report->nominal_ca)
                                        <tr style="font-weight: bold">
                                            <td colspan="3" class="text-right">Kurang</td>
                                            <td class="text-center">{{ $item->curr }}</td>
                                            <td class="text-right">
                                                {{ number_format(abs($nominal - $cash_advance_report->nominal_ca), 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                                <div>
                                    <table class="table is-striped table-bordered border-dark text-center"
                                        style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
                                        <tr style="height:3cm;">
                                            <td style="width:25%">
                                                <div class="center" style="font-weight: bold">Pemohon,</div>
                                                <div style="margin-top: 80px"></div>
                                                <div class="center">{{ $cash_advance_report->pemohon }}</div>
                                            </td>
                                            <td style="width:25%">
                                                <div class="center" style="font-weight: bold">Accounting,</div>
                                                <div style="margin-top: 80px"></div>
                                                <div class="center">{{ $cash_advance_report->accounting }}</div>
                                            </td>
                                            <td style="width:25%">
                                                <div class="center" style="font-weight: bold">Kasir,</div>
                                                <div style="margin-top: 80px"></div>
                                                <div class="center">{{ $cash_advance_report->kasir }}</div>
                                            </td>
                                            <td style="width:25%">
                                                <div class="center" style="font-weight: bold">Menyetujui,</div>
                                                <div style="margin-top: 80px"></div>
                                                <div class="center">{{ $cash_advance_report->menyetujui }}</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="container d-flex justify-content-center">

                                    <a href="{{ route('karyawan.beranda') }}" class="btn btn-danger"><i
                                            class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
                                </div>
                            </form>
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
    <script src="{{ asset('assets/js/tooltip.js') }}"></script>
    @include('sweetalert::alert')


</body>

</html>
