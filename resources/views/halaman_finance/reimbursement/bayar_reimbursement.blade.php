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
                href="{{ route('kasir.beranda') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">pt. eclectic</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('kasir.beranda') }}">
                    <i class="fa-solid fa-home fa-beat-fade"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.reimbursement') }}">
                    <i class="fa-solid fa-money-bill-transfer fa-beat-fade"></i>
                    <span>Reimbursement</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.cash_advance') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Cash Advance</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.cash_advance_report') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Cash Advance Report</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.purchase_request') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Purchase Request</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.purchase_order') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Purchase Order</span></a>
            </li>

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
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets') }}/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

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
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Lihat Reimbursement dengan No
                                {{ $reimbursement->no_doku }}</h6>
                        </div>
                        <div class="card-body">
                            <form action=#>
                                @csrf
                                @if ($reimbursement->halaman == 'RB')
                                    <table class="table is-striped table-bordered border-dark table-sm"
                                        style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
                                        @if ($reimbursement->status_approved == 'rejected' && $reimbursement->status_paid == 'pending')
                                            <thead>
                                                <div class="alert alert-danger" role="alert">
                                                    Alasan : {{ $reimbursement->alasan }}
                                                </div>
                                            </thead>
                                        @elseif ($reimbursement->status_approved == 'approved' && $reimbursement->status_paid == 'pending')
                                            <thead>
                                                <div class="alert alert-success" role="alert">
                                                    Approved on
                                                    {{ date('d/m/Y', strtotime($reimbursement->tgl_persetujuan)) }}
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
                                                <th class="text-center"
                                                    style="width: 100%; text-transform:capitalize;" colspan="5">
                                                    {{ $reimbursement->judul_doku }}</th>
                                            </tr>
                                        </thead>
                                        <!-- Details -->
                                        <?php $no = 1; ?>
                                        @foreach ($rb_detail as $item)
                                            <tr>
                                                <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                                                </td>
                                                <td style="text-transform:capitalize;">{{ $item->deskripsi }}
                                                    {{ date('d/m/Y', strtotime($item->tanggal_1)) }}
                                                </td>
                                                <td class="text-center"
                                                    style="max-width: 12%; word-break: break-all;">
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
                                    </table>
                                    <!-- /.container-fluid -->
                                    <div>
                                        <table class="table is-striped table-bordered border-dark text-center"
                                            style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
                                            <tr style="height:3cm;">
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Pemohon,</div>
                                                    <div style="margin-top: 100px"></div>

                                                    <div class="center">{{ $reimbursement->pemohon }}</div>
                                                </td>
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Accounting,</div>
                                                    <div style="margin-top: 100px"></div>
                                                    <div class="center">{{ $reimbursement->accounting }}</div>
                                                </td>
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Kasir,</div>
                                                    <div style="margin-top: 100px"></div>
                                                    <div class="center">{{ $reimbursement->kasir }}</div>
                                                </td>
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Menyetujui,</div>

                                                    <div style="margin-top: 100px"></div>
                                                    <div class="center">{{ $reimbursement->menyetujui }}</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="container">
                                        <table class="table is-striped table-borderless border-dark"
                                            style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
                                            @foreach ($rb_detail as $item)
                                                <td class="text-center"><img
                                                        src="{{ asset('bukti_reim/' . $item->bukti_reim) }}"
                                                        alt="" width="100%">
                                                    <br>{{ $item->no_bukti }}
                                                </td>
                                            @endforeach
                                        </table>
                                    </div>
                                @elseif ($reimbursement->halaman == 'TS')
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
                                            <tr>
                                                <th class="text-center"
                                                    style="width: 100%; text-transform:capitalize;" colspan="5">
                                                    {{ $reimbursement->judul_doku }}</th>
                                            </tr>
                                        </thead>
                                        <!-- Details -->
                                        <?php $no = 1; ?>
                                        @foreach ($timesheet_project_detail as $index => $item)
                                            <tr>
                                                <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                                                </td>
                                                <td style="text-transform:capitalize;">{{ $item->nama_karyawan }}</td>
                                                <td></td>
                                                <td class="text-center">{{ $item->curr }}</td>
                                                <td class="text-right">
                                                    {{ number_format($results_TS[$index], 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                        <!-- Total Price -->
                                        <tr style="font-weight: bold">
                                            <td colspan="3" class="text-right">Jumlah</td>
                                            <td class="text-center">{{ $item->curr }}</td>
                                            <td class="text-right">{{ number_format($total_TS, 0, ',', '.') }}</td>
                                        </tr>
                                    </table>
                                    <!-- /.container-fluid -->
                                    <div>
                                        <table class="table is-striped table-bordered border-dark text-center"
                                            style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
                                            <tr style="height:3cm;">
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Pemohon,</div>
                                                    <br><br><br><br>
                                                    <div class="center">{{ $reimbursement->pemohon }}</div>
                                                </td>
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Accounting,</div>
                                                    <br><br><br><br>
                                                    <div class="center">{{ $reimbursement->accounting }}</div>
                                                </td>
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Kasir,</div>
                                                    <br><br><br><br>
                                                    <div class="center">{{ $reimbursement->kasir }}</div>
                                                </td>
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Menyetujui,</div>
                                                    <br><br><br><br>
                                                    <div class="center">{{ $reimbursement->menyetujui }}</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                @elseif ($reimbursement->halaman == 'ST')
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
                                            <tr>
                                                <th class="text-center"
                                                    style="width: 100%; text-transform:capitalize;" colspan="5">
                                                    {{ $reimbursement->judul_doku }}</th>
                                            </tr>
                                        </thead>
                                        <!-- Details -->
                                        <?php $no = 1; ?>
                                        @foreach ($support_ticket_detail as $index => $item)
                                            <tr>
                                                <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                                                </td>
                                                <td style="text-transform:capitalize;">{{ $item->nama_karyawan }}
                                                    ({{ $item->aliases }})
                                                </td>
                                                <td></td>
                                                <td class="text-center">{{ $item->curr }}</td>
                                                <td class="text-right">
                                                    {{ number_format($results[$index], 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach

                                        <!-- Total Price -->
                                        <tr style="font-weight: bold">
                                            <td colspan="3" class="text-right">Jumlah</td>
                                            <td class="text-center">{{ $item->curr }}</td>
                                            <td class="text-right">{{ number_format($total, 0, ',', '.') }}
                                        </tr>
                                    </table>
                                    <!-- /.container-fluid -->
                                    <div>
                                        <table class="table is-striped table-bordered border-dark text-center"
                                            style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
                                            <tr style="height:3cm;">
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Pemohon,</div>
                                                    <br><br><br><br>
                                                    <div class="center">{{ $reimbursement->pemohon }}</div>
                                                </td>
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Accounting,</div>
                                                    <br><br><br><br>
                                                    <div class="center">{{ $reimbursement->accounting }}</div>
                                                </td>
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Kasir,</div>
                                                    <br><br><br><br>
                                                    <div class="center">{{ $reimbursement->kasir }}</div>
                                                </td>
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Menyetujui,</div>
                                                    <br><br><br><br>
                                                    <div class="center">{{ $reimbursement->menyetujui }}</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                @elseif ($reimbursement->halaman == 'SL')
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
                                            <tr>
                                                <th class="text-center"
                                                    style="width: 100%; text-transform:capitalize;" colspan="5">
                                                    {{ $reimbursement->judul_doku }}</th>
                                            </tr>
                                        </thead>
                                        <!-- Details -->
                                        <?php $no = 1; ?>
                                        @foreach ($support_lembur_detail as $index => $item)
                                            <tr>
                                                <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                                                </td>
                                                <td style="text-transform:capitalize;">{{ $item->nama_karyawan }}
                                                    ({{ $item->aliases }})
                                                </td>
                                                <td></td>
                                                <td class="text-center">{{ $item->curr }}</td>
                                                <td class="text-right">
                                                    {{ number_format($results[$index], 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                        <!-- Total Price -->
                                        <tr style="font-weight: bold">
                                            <td colspan="3" class="text-right">Jumlah</td>
                                            <td class="text-center">{{ $item->curr }}</td>
                                            <td class="text-right">{{ number_format($total_ST, 0, ',', '.') }}
                                        </tr>
                                    </table>
                                    <!-- /.container-fluid -->
                                    <div>
                                        <table class="table is-striped table-bordered border-dark text-center"
                                            style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
                                            <tr style="height:3cm;">
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Pemohon,</div>
                                                    <br><br><br><br>
                                                    <div class="center">{{ $reimbursement->pemohon }}</div>
                                                </td>
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Accounting,</div>
                                                    <br><br><br><br>
                                                    <div class="center">{{ $reimbursement->accounting }}</div>
                                                </td>
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Kasir,</div>
                                                    <br><br><br><br>
                                                    <div class="center">{{ $reimbursement->kasir }}</div>
                                                </td>
                                                <td style="width:25%">
                                                    <div class="center" style="font-weight: bold">Menyetujui,</div>
                                                    <br><br><br><br>
                                                    <div class="center">{{ $reimbursement->menyetujui }}</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                @endif
                                <div class="container d-flex justify-content-center">
                                    @if ($reimbursement->status_approved == 'approved' && $reimbursement->status_paid == 'pending')
                                        @if ($reimbursement->halaman == 'RB')
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#staticBackdrop"><i
                                                    class="fa-solid fa-cash-register fa-beat"></i>
                                                Bayar
                                            </button>
                                            &nbsp; &nbsp;
                                            <a href="{{ route('kasir.reimbursement') }}" class="btn btn-danger"><i
                                                    class="fa-solid fa-backward fa-beat"></i>&nbsp;Kembali</a>
                                        @endif
                                    @elseif ($reimbursement->status_approved == 'approved' && $reimbursement->status_paid == 'paid')
                                        <a href="{{ route('kasir.reimbursement') }}" class="btn btn-danger"><i
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
                                                action="{{ route('kasir.reimbursement.paid_RB', $reimbursement->id) }}"
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
