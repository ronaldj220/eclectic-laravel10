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
                                    <small>Kasir</small></span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets') }}/img/undraw_profile_2.svg">
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
                <div class="container" style="margin-top: -10px; margin-right: -20px">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Reimbursement
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('kasir.reimbursement.simpan_RB') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No Dokumen</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="no_doku" readonly
                                                value="{{ $no_dokumen }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tanggal</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="tgl_diajukan" value="{{ date('d/m/Y') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="judul_doku" autofocus @error('judul_doku') is-invalid @enderror
                                                value="{{ old('judul_doku') }}">
                                            @error('judul_doku')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Pemohon</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="pemohon" value="{{ Auth::guard('kasir')->user()->nama }}"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Accounting</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="accounting" value="{{ $accounting[0]->nama }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Kasir</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="kasir" value="{{ $kasir[0]->nama }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Menyetujui</label>
                                            <select class="form-control" id="menyetujui" name="nama_menyetujui"
                                                onchange="updateFields2()"
                                                data-url="{{ route('kasir.reimbursement.getNomor') }}">
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
                                        <div class="form-group" hidden>
                                            <label for="exampleInputPassword1">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                                readonly>
                                        </div>
                                        <div class="form-group" style="margin-top: 10px">
                                            <label for="">File Excel</label> <br>
                                            <input type="file" id="file-input" accept=".xlsx">
                                        </div>
                                        <div class="form-group" style="margin-top: 10px">
                                            <label for="exampleInputPassword1">File Bukti</label>
                                            <input type="file"
                                                class="form-control-file @error('bukti') is-invalid @enderror"
                                                name='bukti' accept='.pdf, .zip, .rar'>
                                            <br>
                                            <small id="passwordHelpBlock" class="form-text text-muted"
                                                style="font-family: Arial, Helvetica, sans-serif; margin-top: -10px">
                                                Gunakan PDF atau ZIP atau RAR
                                            </small>
                                            @error('bukti')
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    {{ $message }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group" style="margin-top: 10px; margin-bottom: 2px">
                                            <label for="">Pilih</label>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="project"
                                                    id="inlineRadio1" value="RB (Reimbursement)">
                                                <label class="form-check-label" for="inlineRadio1">RB
                                                    (Reimbursement)</label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" name="project"
                                                    id="inlineRadio2" value="TS (Timesheet Support)">
                                                <label class="form-check-label" for="inlineRadio2">TS (Timesheet
                                                    Project)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="project"
                                                    id="inlineRadio3" value="ST (Support Ticket)">
                                                <label class="form-check-label" for="inlineRadio3">ST (Support
                                                    Ticket)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="project"
                                                    id="inlineRadio4" value="SL (Support Lembur)">
                                                <label class="form-check-label" for="inlineRadio4">SL (Support
                                                    Lembur)</label>
                                            </div>

                                        </div>

                                        <div class="form-group mt-3">
                                            <div id="detail"></div>
                                        </div>
                                        <div class="d-flex justify-content-center" style="margin-top: 20px">
                                            <a href="javascript:;" class="btn btn-info" onclick="getRadioValue()"><i
                                                    class="fa-solid fa-circle-plus fa-bounce"></i>&nbsp;Tambah RB</a>
                                            &nbsp;&nbsp;
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa-solid fa-floppy-disk fa-bounce"></i>&nbsp;Submit</button>
                                            &nbsp;&nbsp;
                                            <a href="{{ route('kasir.reimbursement') }}" class="btn btn-danger"><i
                                                    class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

    <script>
        function getRadioValue() {
            var radio = document.getElementsByName('project');
            var selectedValue = '';
            for (i = 0; i < radio.length; i++) {
                if (radio[i].checked) {

                    selectedValue = radio[i].value;

                    // Validasi berdasarkan jabatan pengguna
                    var userRole = {!! $userRoleJSON !!};

                    // Setelah validasi berhasil, atur template yang akan ditampilkan berdasarkan opsi yang dipilih
                    let template = '';

                    if (selectedValue === 'RB (Reimbursement)') {
                        template =
                            `<center>
                                <div class='container'>
                                    <div class = 'row'>
                                        <div class = 'col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi[]" rows="6"></textarea>
                                            </div>                                           
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">File Bukti</label>
                                                <input type="file" class="form-control-file" name='foto[]' accept='.png, .jpg, .jpeg, .pdf'>
                                                <br>
                                                <div class="form-text text-muted"
                                                    style="font-size: 12px; font-family: Arial; margin-bottom: 20px">
                                                    Harus JPG atau PNG
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">No Bukti</label>
                                                <input type="text" class="form-control" name='nobu[]'>
                                            </div>
                                            <div class="form-text text-muted"
                                                    style="font-size: 12px; font-family: Arial; margin-top: -15px;">
                                                    Struk, Nota, Atau <i>Receipt</i>
                                                </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mata Uang</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="kurs_rb[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($kurs as $item)
                                                        <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nominal</label>
                                                <input type="number" class="form-control" name='nom_rb[]'>
                                            </div>
                                        </div>
                                        <div class='col-md-5'>
                                            <div class="form-group">
                                                <label for="tgl1">Tanggal</label>
                                                <input type="date" class="form-control" name='tgl1[]'>
                                            </div>
                                        </div>
                                        <div class='col' style = 'margin-top: 40px'>
                                            <span>s/d</span>
                                        </div>
                                        <div class='col-md-5'>
                                            <div class="form-group">
                                                <label for="tgl2">Tanggal</label>
                                                <input type="date" class="form-control" name='tgl2[]'>
                                                <div class="form-text text-muted"
                                                    style="font-size: 12px; font-family: Arial; margin-bottom: 20px">
                                                    * OPSIONAL (Gunakan jika memerlukan rentang tanggal)
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-md-5'>
                                            <div class="form-group">
                                                <label for="keprluan">Project/Instansi/Perusahaan</label>
                                                <input type="text" class="form-control @error('keperluan') is-invalid @enderror" name='keperluan[]' autofocus >
                                                @error('keperluan')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text text-muted"
                                                    style="font-size: 12px; font-family: Arial; margin-bottom: 20px">
                                                    * Isi buat keperluan Project
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = 'row'>
                                        <div class = 'col-md-12'>
                                            <div class="form-group" style = 'margin-top: 20px'>
                                                <button name="delete${i}" id="delete${i}" onclick="deleteRow(this)" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>`;
                    } else if (selectedValue === 'TS (Timesheet Support)') {
                        template =
                            `<center>
                                <div class='container'>
                                    <div class = 'row'>
                                        <div class = 'col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Karyawan</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="karyawan_ts[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($karyawan as $item)
                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-2'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Hari </label>
                                                <input type="number" class="form-control" name='hari_ts2[]'>
                                            </div>
                                        </div>
                                        <div class = 'col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" hidden>Mata Uang</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="kurs_ts[]" hidden>
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($kurs as $item)
                                                        <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" hidden>Nominal</label>
                                                <input type="text" class="form-control" name='nom_ts[]' value = {{ $nominal_awal[0]->nominal }} hidden>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1" hidden>Hari (Secara Default)</label>
                                                <input type="text" class="form-control" name='hari_ts1[]' value = {{ $nominal_awal[0]->hari }} hidden>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class = 'row'>
                                        <div class='col-md-2'>
                                            <div class="form-group">
                                                <button name="delete${i}" id="delete${i}" onclick="deleteRow(this)" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>`;
                    } else if (selectedValue === 'ST (Support Ticket)') {
                        template =
                            `<center>
                                <div class='container'>
                                    <div class = 'row'>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Karyawan</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="karyawan_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($karyawan as $item)
                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nickname Project</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="project_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($aliases as $item)
                                                        <option value="{{ $item->aliases }}">{{ $item->aliases }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mata Uang</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="kurs_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($kurs as $item)
                                                        <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nominal</label>
                                                <input type="text" class="form-control" name='nom_st[]' value = {{ $nominal_project[0]->nominal }} readonly>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Jam </label>
                                                <input type="number" class="form-control" name='jam_st[]' >
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
                    } else if (selectedValue === 'SL (Support Lembur)') {
                        template =
                            `<center>
                                <div class='container'>
                                    <div class = 'row'>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Karyawan</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="karyawan_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($karyawan as $item)
                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nickname Project</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="project_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($aliases as $item)
                                                        <option value="{{ $item->aliases }}">{{ $item->aliases }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mata Uang</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="kurs_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($kurs as $item)
                                                        <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nominal</label>
                                                <input type="text" class="form-control" name='nom_st[]' value = {{ $nominal_project[0]->nominal }} readonly>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Jam </label>
                                                <input type="number" class="form-control" name='jam_st[]' step="0.1">
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
                    }



                    // Kode lanjutan untuk opsi yang valid dipilih
                    let container = document.getElementById('detail');
                    let div = document.createElement('div');
                    div.innerHTML = template;
                    container.appendChild(div);

                    i++;
                }
            }
        }


        function deleteRow(id) {
            var row;
            row = id.name.substring(id.name.length - 1, id.name.length);
            var id = $('#id' + row).val();
            $('#delete' + row).closest('center').remove();
        }

        function updateFields2() {
            var selectedSupplier = document.getElementById("menyetujui").value;
            var url = document.getElementById("menyetujui").getAttribute("data-url");

            // Lakukan permintaan AJAX ke endpoint getDataBySupplier
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        document.getElementById("no_telp").value = response.keterangan;
                    } else {
                        document.getElementById("pemohon").value = "";
                        document.getElementById("menyetujui").value = "";
                    }
                }
            };
            xhr.open("GET", url + "?menyetujui=" + selectedSupplier);
            xhr.send();
        }
    </script>

    <script src="https://unpkg.com/read-excel-file@4.x/bundle/read-excel-file.min.js"></script>

    <script>
        const input = document.getElementById('file-input');
        input.addEventListener('change', function() {
            readXlsxFile(input.files[0]).then(function(data) {
                console.log(data);

                // Trace data bagian Deskripsi
                const deskripsiData = [];
                for (let i = 0; i < data.length; i++) {
                    const deskripsi = data[4][1]; // Asumsikan Deskripsi berada di kolom kedua (indeks 1)
                    deskripsiData.push(deskripsi);
                }
                // console.log(deskripsiData);

                // // Trace data bagian No Bukti
                const nobuData = data[4][5]; // Asumsikan No Bukti berada di kolom keempat (indeks 3)
                // console.log(nobuData);


                // Tampilkan data deskripsi dalam textarea
                const textarea = document.querySelectorAll('textarea[name="deskripsi[]"]');
                for (let i = 0; i < textarea.length; i++) {
                    textarea[i].value = deskripsiData[4] ||
                        ''; // Jika data tidak ada, beri nilai default string kosong
                }


                // // Tampilkan data No Bukti dalam input text
                const nobuInputs = document.querySelectorAll('input[name="nobu[]"]');
                for (let i = 0; i < nobuInputs.length; i++) {
                    nobuInputs[i].value = nobuData ||
                        ''; // Jika data tidak ada, beri nilai default string kosong
                }

                // Trace data bagian Nominal
                const nominalData = data[4][7]; // Asumsikan Nominal berada di kolom keenam (indeks 5)
                // console.log(nominalData);

                // Tampilkan data Nominal dalam input number
                const nominalInputs = document.querySelectorAll('input[name="nom_rb[]"]');
                for (let i = 0; i < nominalInputs.length; i++) {
                    nominalInputs[i].value = nominalData ||
                        ''; // Jika data tidak ada, beri nilai default string kosong
                }
            });
        });
    </script>

</body>

@include('sweetalert::alert')

</html>
