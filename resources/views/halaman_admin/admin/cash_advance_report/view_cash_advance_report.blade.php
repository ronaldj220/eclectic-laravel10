<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Eclectic (Finance) | {{ $title }}</title>

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
                href="{{ route('admin.beranda') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">pt. eclectic</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.beranda') }}">
                    <i class="fa-solid fa-home fa-beat-fade"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading text-center">
                Halaman Master
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog fa-beat-fade"></i>
                    <span>Master</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.admin') }}"><i
                                class="fa-solid fa-lock fa-beat"></i>&nbsp;Admin</a>
                        <a class="collapse-item" href="{{ route('admin.karyawan') }}"><i
                                class="fa-solid fa-user fa-beat"></i>&nbsp;Karyawan</a>
                        <a class="collapse-item" href="{{ route('admin.currency') }}"><i
                                class="fa-solid fa-money-check fa-beat"></i>&nbsp;Mata Uang</a>
                        <a class="collapse-item" href="{{ route('admin.accounting') }}"><i
                                class="fa-solid fa-calculator fa-beat"></i>&nbsp;Accounting</a>
                        <a class="collapse-item" href="{{ route('admin.kasir') }}"><i
                                class="fa-solid fa-cash-register fa-beat"></i>&nbsp;Kasir</a>
                        <a class="collapse-item" href="{{ route('admin.menyetujui') }}"><i
                                class="fa-solid fa-user fa-beat"></i>&nbsp;Menyetujui</a>
                        <a class="collapse-item" href="{{ route('admin.master_timesheet') }}"><i
                                class="fa-solid fa-coins fa-beat"></i>&nbsp;Rate Timesheet Project</a>
                        <a class="collapse-item" href="{{ route('admin.master_fee_project') }}"><i
                                class="fa-solid fa-coins fa-beat"></i>&nbsp;Rate Lembur & Ticket</a>
                        <a class="collapse-item" href="{{ route('admin.supplier') }}">
                            <i class="fa-solid fa-truck-field-un fa-beat"></i>&nbsp;Supplier</a>
                        <a class="collapse-item" href="{{ route('admin.client') }}">
                            <i class="fa-solid fa-user fa-beat"></i>&nbsp;Client</a>
                        <a class="collapse-item" href="{{ route('admin.master_PO') }}">
                            <i class="fa-solid fa-user fa-beat"></i>&nbsp;Master PO</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading text-center">
                Halaman Admin
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder fa-beat-fade"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.reimbursement') }}">Reimbursement</a>
                        <a class="collapse-item" href="{{ route('admin.cash_advance') }}">Cash Advance</a>
                        <a class="collapse-item" href="{{ route('admin.cash_advance_report') }}">Cash Advance
                            Report</a>
                        <a class="collapse-item" href="{{ route('admin.purchase_request') }}">Purchase Request</a>
                        <a class="collapse-item" href="{{ route('admin.purchase_order') }}">Purchase Order</a>
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

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets') }}/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

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
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Bayar CAR dengan No
                                {{ $cash_advance_report->no_doku }}</h6>
                        </div>
                        <div class="card-body">
                            <form
                                action={{ route('admin.cash_advance_report.setujui_cash_advance_report', $cash_advance_report->id) }}
                                method="POST">
                                @csrf
                                <table class="table is-striped table-bordered border-dark table-sm"
                                    style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
                                    @if ($cash_advance_report->status_approved == 'approved' && $cash_advance_report->status_paid == 'pending')
                                        <thead>
                                            <div class="alert alert-success" role="alert">
                                                Approved on
                                                {{ date('d/m/Y', strtotime($cash_advance_report->tgl_persetujuan)) }}
                                            </div>
                                        </thead>
                                    @endif
                                    @if ($nominal < $cash_advance_report->nominal_ca)
                                        <thead>
                                            <div class="alert alert-danger" role="alert">
                                                Ada Kelebihan Dana Sejumlah
                                                {{ number_format(abs($nominal - $cash_advance_report->nominal_ca), 0, ',', '.') }}.
                                                <br> Silahkan ditransfer ke Finance Eclectic di Nomor Rekening <br>
                                                4632005788 (BCA) A/N PT. ECLECTIC CONSULTING
                                            </div>
                                        </thead>
                                    @endif

                                    <!-- Details -->
                                </table>
                                <table class="table is-striped table-bordered border-dark table-sm"
                                    style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 3%">No.</th>
                                            <th class="text-center" style="width: 30%">Keterangan</th>
                                            <th class="text-center" style="width: 8%;">No. Bukti</th>
                                            <th class="text-center" style="width: 5%">Curr</th>
                                            <th class="text-center" style="width: 5%">Nominal</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center" style="width: 100%; text-transform:capitalize;"
                                                colspan="5">
                                                {{ $cash_advance_report->judul_doku }}</th>
                                        </tr>
                                    </thead>
                                    <!-- Details -->
                                    <?php $no = 1; ?>
                                    @foreach ($car_detail as $item)
                                        <tr>
                                            <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                                            </td>
                                            <td style="text-transform:capitalize;">{{ $item->deskripsi }}
                                                @if ($item->tanggal_1 && $item->tanggal_2)
                                                    @php
                                                        $tanggal1 = \Carbon\Carbon::parse($item->tanggal_1);
                                                        $tanggal2 = \Carbon\Carbon::parse($item->tanggal_2);
                                                        $selisihHari = $tanggal2->diffInDays($tanggal1);
                                                    @endphp
                                                    {{ date('d/m/Y', strtotime($item->tanggal_1)) }} -
                                                    {{ date('d/m/Y', strtotime($item->tanggal_2)) }}
                                                @elseif ($item->tanggal_1)
                                                    {{ date('d/m/Y', strtotime($item->tanggal_1)) }}
                                                @endif
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
                                            <td class="text-center" style="color: red">{{ $item->curr }}</td>
                                            <td class="text-right" style="color: red">
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
                                <div class="container  text-center">
                                    <div class="row gx-5">
                                        <div class="col">
                                            <div class="p-3"></div>
                                        </div>
                                        <div class="col" style="margin-right: -39px; margin-top: -30px;">
                                            <div class="p-3">
                                                <table class="table is-striped table-bordered border-dark text-center"
                                                    style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
                                                    <tr>

                                                        <td style="width: 50%; text-align: center; ">
                                                            <div style="font-weight: bold;">Pembuat,</div>
                                                            <br><br><br><br>
                                                            <div style="text-align: center; margin-top: -3px;">
                                                                {{ $cash_advance_report->pemohon }}</div>
                                                        </td>
                                                        <td style="width: 50%; text-align: center;">
                                                            <div style="font-weight: bold;">Menyetujui,</div>
                                                            <br><br><br><br>
                                                            <div style="text-align: center; margin-top: -3px;">
                                                                {{ $cash_advance_report->menyetujui }}</div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container d-flex justify-content-center">
                                    @if ($cash_advance_report->status_approved == 'approved' && $cash_advance_report->status_paid == 'pending')
                                        @if ($nominal < $cash_advance_report->nominal_ca)
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#staticBackdrop"><i
                                                    class="fa-solid fa-cash-register fa-beat"></i>
                                                Bayar
                                            </button>
                                            &nbsp; &nbsp;
                                        @elseif ($nominal > $cash_advance_report->nominal_ca)
                                            <a href="{{ route('admin.cash_advance_report') }}"
                                                class="btn btn-danger"><i
                                                    class="fa-solid fa-backward fa-beat"></i>&nbsp;Kembali</a>
                                        @elseif ($nominal = $cash_advance_report->nominal_ca)
                                            <a href="{{ route('admin.cash_advance_report') }}"
                                                class="btn btn-danger"><i
                                                    class="fa-solid fa-backward fa-beat"></i>&nbsp;Kembali</a>
                                        @endif
                                    @elseif ($cash_advance_report->status_approved == 'rejected' && $cash_advance_report->status_paid == 'rejected')
                                        <button class="btn btn-primary"><i
                                                class="fa-solid fa-square-check fa-beat"></i>&nbsp;Verify</button>
                                        <a href="{{ route('admin.cash_advance_report') }}" class="btn btn-danger"><i
                                                class="fa-solid fa-backward fa-beat"></i>&nbsp;Kembali</a>
                                    @endif

                                </div>
                            </form>




                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Masukkan Nomor Referensi
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="{{ route('kasir.reimbursement.paid_RB', $cash_advance_report->id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="text" name="no_ref" class="form-control"
                                                    placeholder="Masukkan Nomor Referensi">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-danger">Bayar</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
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
    <script src="{{ asset('assets/js/tooltip.js') }}"></script>
    @include('sweetalert::alert')


</body>

</html>
