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
                <a class="nav-link" href="{{ route('kasir.beranda') }}">
                    <i class="fa-solid fa-home"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.reimbursement') }}">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <span>Reimbursement</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.cash_advance') }}">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <span>Cash Advance</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.cash_advance_report') }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Cash Advance Report</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.purchase_request') }}">
                    <i class="fa-solid fa-chart-bar"></i>
                    <span>Purchase Request</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.purchase_order') }}">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                    <span>Purchase Order</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link"
                    href="https://drive.google.com/file/d/1uCNOVvTxZFA5X6Qeyqae2CbhJ5hq903y/view?usp=sharing">
                    <i class="fa-regular fa-circle-question"></i>
                    <span>Help</span></a>
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
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('kasir')->user()->nama }}
                                    <br>
                                    <small>Finance</small></span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets') }}/img/undraw_profile_3.svg">
                            </a>
                            <!-- Dropdown - User Information -->

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="{{ route('kasir.beranda.profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile ({{ Auth::guard('kasir')->user()->nama }}) | Finance
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
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Daftar dan Lihat Purchase Order
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('kasir.purchase_order.tambah_PO') }}" class="btn btn-success">
                                    <i class="fa-solid fa-plus fa-flip"></i>&nbsp;Ajukan PO
                                </a>


                                <form id="formBulan" action="{{ route('kasir.purchase_order') }}" method="GET"
                                    class="ml-auto">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="bulan">Bulan</label>
                                        <input type="month" class="form-control" id="bulan" name="bulan"
                                            value="{{ request('bulan') }}">
                                    </div>
                                </form>

                                &nbsp;
                                <form action="" style="margin-top: 30px">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="search" class="form-control" id="exampleFormControlInput1"
                                            name="search" placeholder="Search...">
                                    </div>
                                </form>
                            </div>
                            @if (session('success'))
                                <script>
                                    window.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: '{{ session('success') }}',
                                            icon: 'success',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    });
                                </script>
                            @elseif (session('error'))
                                <script>
                                    window.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: '{{ session('error') }}',
                                            icon: 'error',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    });
                                </script>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 2%">No Dokumen</th>
                                            <th style="width: 2%">Dasar PR</th>
                                            <th style="width: 1%">Tanggal</th>
                                            <th style="width: 10%">Keterangan</th>
                                            <th style="width: 10%">Supplier</th>
                                            @if ($PO && count($PO) > 0)
                                                @php
                                                    $item = $PO[0];
                                                @endphp
                                                @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                    <th style="width: 3%">Status</th>
                                                    <th style="width: 3%">Aksi</th>
                                                @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                    <th style="width: 3%">Status</th>
                                                    <th style="width: 3%">Aksi</th>
                                                @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                    <th style="width: 3%">Status</th>
                                                    <th style="width: 3%">Aksi</th>
                                                @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                    <th style="width: 3%">Status</th>
                                                    <th style="width: 3%">Aksi</th>
                                                @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                    <th style="width: 3%">Status</th>
                                                    <th style="width: 3%">Aksi</th>
                                                @endif
                                            @endif

                                        </tr>

                                    </thead>
                                    <tbody>
                                        @if ($PO)
                                            @foreach ($PO as $item)
                                                <tr>
                                                    <td><a
                                                            href="{{ route('kasir.purchase_order.view_PO', $item->id) }}">{{ $item->no_doku }}</a>
                                                    </td>
                                                    <td>
                                                        @if ($item->id_pr)
                                                            <a
                                                                href="{{ route('kasir.purchase_order.view_PR', ['id' => $item->id_pr]) }}">{{ $item->tipe_pr }}</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d.m.Y', strtotime($item->tgl_purchasing)) }}</td>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ $item->supplier }}</td>
                                                    @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                        <td style="text-align: center; color: #FF3131">
                                                            <label style="font-weight: bold">Submitted</label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <div style="display: flex; justify-content: center;">
                                                                <a href="{{ route('kasir.purchase_order.print_PO', $item->id) }}"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="Print Dokumen">
                                                                    <i class="fa-solid fa-print"
                                                                        style="color: #900C3F"></i>
                                                                </a>
                                                                &nbsp; &nbsp; &nbsp;
                                                                <a href="{{ route('kasir.purchase_order.excel_PO', $item->id) }}"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="Download Excel">
                                                                    <i class="fa-solid fa-file-excel"
                                                                        style="color: #900C3F"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                        <td style="text-align: center; color: #FF3131">
                                                            <label style="font-weight: bold">Rejected</label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <div style="display: flex; justify-content: center;">
                                                                <a href="{{ route('kasir.purchase_order.print_PO', $item->id) }}"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="Print Dokumen">
                                                                    <i class="fa-solid fa-print"
                                                                        style="color: #900C3F"></i>
                                                                </a>
                                                                &nbsp; &nbsp; &nbsp;
                                                                <a href="{{ route('kasir.purchase_order.excel_PO', $item->id) }}"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="Download Excel">
                                                                    <i class="fa-solid fa-file-excel"
                                                                        style="color: #900C3F"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                        <td
                                                            style="text-align: center; color: #6D6F28; text-transform: capitalize;">
                                                            <b><label>Waiting for Approval</label></b>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <div style="display: flex; justify-content: center;">
                                                                <a href="{{ route('kasir.purchase_order.print_PO', $item->id) }}"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="Print Dokumen">
                                                                    <i class="fa-solid fa-print"
                                                                        style="color: #900C3F"></i>
                                                                </a>
                                                                &nbsp; &nbsp; &nbsp;
                                                                <a href="{{ route('kasir.purchase_order.excel_PO', $item->id) }}"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="Download Excel">
                                                                    <i class="fa-solid fa-file-excel"
                                                                        style="color: #900C3F"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                        <td style="text-align: center; color: #FF914D">
                                                            <label style="font-weight: bold">Waiting For
                                                                Payment</label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <div style="display: flex; justify-content: center;">
                                                                <a href="{{ route('kasir.purchase_order.print_PO', $item->id) }}"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="Print Dokumen">
                                                                    <i class="fa-solid fa-print"
                                                                        style="color: #900C3F"></i>
                                                                </a>

                                                                &nbsp; &nbsp; &nbsp;
                                                                <a href="{{ route('kasir.purchase_order.view_PO', $item->id) }}"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="Bayar">
                                                                    <i class="fa fa-credit-card"
                                                                        style="color:#900C3F"></i>
                                                                </a>
                                                                &nbsp; &nbsp; &nbsp;
                                                                <a href="{{ route('kasir.purchase_order.excel_PO', $item->id) }}"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="Download Excel">
                                                                    <i class="fa-solid fa-file-excel"
                                                                        style="color: #900C3F"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                        <td style="text-align: center;color: #00BF63;">
                                                            <label
                                                                style="font-weight: bold; text-transform: uppercase">paid</label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <div style="display: flex; justify-content: center;">
                                                                <a href="{{ route('kasir.purchase_order.print_PO', $item->id) }}"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="Print Dokumen">
                                                                    <i class="fa-solid fa-print"
                                                                        style="color: #900C3F"></i>
                                                                </a>

                                                                &nbsp; &nbsp; &nbsp;
                                                                <a href="{{ route('kasir.purchase_order.view_PO', $item->id) }}"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="Lihat Dokumen">
                                                                    <i class="fa-solid fa-eye"
                                                                        style="color: #900C3F"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <!-- /.container-fluid -->
                                {{ $PO->links('pagination::bootstrap-5') }}
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#bulan').change(function() {
                $('#formBulan').submit(); // Mengirimkan form saat bulan berubah
            });
        });
    </script>



</body>

</html>
