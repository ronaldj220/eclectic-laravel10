<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Eclectic (Direksi) | {{ $title }}</title>

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
                href="{{ route('direksi.beranda') }}">
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
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('direksi.beranda') }}">
                    <i class="fa-solid fa-home"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('direksi.reimbursement') }}">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <span>Reimbursement</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('direksi.cash_advance') }}">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <span>Cash Advance</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('direksi.cash_advance_report') }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Cash Advance Report</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('direksi.purchase_request') }}">
                    <i class="fa-solid fa-chart-bar"></i>
                    <span>Purchase Request</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('direksi.purchase_order') }}">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                    <span>Purchase Order</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link"
                    href="https://drive.google.com/file/d/1BygET-_qrafRbWvjUho_qb8m3GOdQzqF/view?usp=sharing">
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

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('direksi')->user()->nama }}
                                    <br>
                                    <small>{{ Auth::guard('direksi')->user()->jabatan }}</small></span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets') }}/img/undraw_profile_2.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="{{ route('direksi.beranda.profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile ({{ Auth::guard('direksi')->user()->nama }}) |
                                    {{ Auth::guard('direksi')->user()->jabatan }}
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
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Purchase Request
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('direksi.purchase_request.simpan_PR') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No Dokumen</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="no_doku" readonly
                                                value="{{ $no_dokumen }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tanggal Invoice</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="tgl_diajukan" value="{{ date('d/m/Y') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Pemohon</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="pemohon" value="{{ Auth::guard('direksi')->user()->nama }}"
                                                readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Menyetujui</label>
                                            <select class="form-control" id="exampleFormControlSelect1"
                                                name="nama_menyetujui">
                                                <option value=""> --- Pilih --- </option>
                                                @foreach ($menyetujui as $item)
                                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-text text-muted"
                                            style="font-size: 16px; font-family: Arial; color: red">
                                            * Aris (Keperluan Direksi) <br>
                                            * Sujiono (Keperluan Project) <br>
                                            * Yacob (Keperluan Office) <br>
                                            * Richard (Keperluan Marketing)
                                        </div>
                                        <div class="form-group mt-3">
                                            <div id="detail"></div>
                                        </div>
                                        <div class="d-flex justify-content-center" style="margin-top: 20px">
                                            <a href="javascript:;" class="btn btn-info" id="add_pr"><i
                                                    class="fa-solid fa-circle-plus fa-bounce"></i>&nbsp;Tambah PR</a>
                                            &nbsp;&nbsp;
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa-solid fa-floppy-disk fa-bounce"></i>&nbsp;Submit</button>
                                            &nbsp;&nbsp;
                                            <a href="{{ route('direksi.purchase_request') }}"
                                                class="btn btn-danger"><i
                                                    class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
                                        </div>
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

    <script>
        let i = 0;
        document.getElementById('add_pr').onclick = function() {
            let template =
                `<center>
                    <div class = 'container'>
                        <div class = 'row'>
                            <div class = 'col-md-12'>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" class="form-control" name="ket[]">
                                </div>
                            </div>
                            <div class = 'col-md-12'>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="">Tanggal</label>
                                            <input type="date" class="form-control" placeholder="Tanggal" name='tgl_1[]'>
                                        </div>
                                        <div class="col">
                                            <label for="">Tanggal</label>
                                            <input type="date" class="form-control" placeholder="Tanggal" name='tgl_2[]'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = 'col-md-12'>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="number" class="form-control" placeholder="Jumlah" name='jum[]' step="0.001">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Qty" name='qty[]'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = 'col-md-12'>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="">Tanggal Pakai</label>
                                            <input type="date" class="form-control" placeholder="Jumlah" name='tgl_pakai[]'>
                                        </div>
                                        <div class="col">
                                            <label for="">Nama Project</label>
                                            <input type="text" class="form-control" placeholder="Project" name='project[]'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = 'row'>
                            <div class='col-md-12'>
                                <div class="form-group">
                                    <button name="delete${i}" id="delete${i}" onclick="deleteRow(this)" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>`;
            // Kode lanjutan untuk opsi yang valid dipilih
            let container = document.getElementById('detail');
            let div = document.createElement('div');
            div.innerHTML = template;
            container.appendChild(div);

            i++;
        }

        function deleteRow(id) {
            var row;
            row = id.name.substring(id.name.length - 1, id.name.length);
            var id = $('#id' + row).val();
            $('#delete' + row).closest('center').remove();
        }
    </script>
</body>
@include('sweetalert::alert')


</html>
