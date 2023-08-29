<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Eclectic (Admin) | {{ $title }}</title>

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
                <a class="nav-link" href="{{ route('admin.beranda') }}">
                    <i class="fa-solid fa-home "></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reimbursement') }}">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <span>Reimbursement</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.cash_advance') }}">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <span>Cash Advance</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.cash_advance_report') }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Cash Advance Report</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.purchase_request') }}">
                    <i class="fa-solid fa-chart-bar"></i>
                    <span>Purchase Request</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.purchase_order') }}">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                    <span>Purchase Order</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog "></i>
                    <span>Setting</span>
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
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-print"></i>
                    <span>Report</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="{{ route('admin.reimbursement.report_RB') }}">Reimbursement</a>
                        <a class="collapse-item" href="{{ route('admin.CA.report_CA') }}">Cash Advance</a>
                        <a class="collapse-item" href="#">Cash Advance Report</a>
                        <a class="collapse-item" href="#">Purchase Request</a>
                        <a class="collapse-item" href="#">Purchase Order</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link"
                    href="https://drive.google.com/file/d/1RJmZuL2LmXJKe3NlkAESjgsCJc9pcX8l/view?usp=sharing">
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
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets') }}/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item"
                                    href="{{ route('admin.admin.edit_admin', Auth::user()->id) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile ({{ Auth::user()->nama }}) | {{ Auth::user()->jabatan }}
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

                <div class="container">
                    <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                        <b><a style="text-transform: uppercase;">reimbursement</a></b>
                        <br>
                        <b><a style="text-transform: uppercase;">PT. Eclectic Consulting</a></b>
                    </figure>
                    <form action=# method="POST" id="formId" enctype="multipart/form-data">
                        @csrf
                        <!-- Tambahkan input tersembunyi untuk menandai tombol "Save as Draft" ditekan -->
                        <input type="hidden" name="draftAction" value="true">
                        <input type="hidden" name="submitAction" value="true">
                        <table class="table table-borderless table-sm"
                            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin-left: -5px;">
                            <tr>
                                <td>No<br>Tanggal</td>
                                <td>: @if ($reimbursement->status_approved == 'hold' && $reimbursement->status_paid == 'hold')
                                        <input type="text" name="no_doku"
                                            value="{{ $reimbursement->no_doku_draft }}"><br>
                                    @else
                                        <input type="text" name="no_doku"
                                            value="{{ $reimbursement->no_doku_real }}"><br>
                                    @endif
                                    :<input type="text" name="tgl_diajukan" value="{{ date('d/m/Y') }}">
                                </td>
                            </tr>
                        </table>
                        <table class="table is-striped table-bordered border-dark table-sm"
                            style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin-top: -20px;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 6%">No.</th>
                                    <th class="text-center" style="width: 50%">Keterangan</th>
                                    <th class="text-center" style="width: 10%;">No. Bukti</th>
                                    <th class="text-center" style="width: 5%">Curr</th>
                                    <th class="text-center" style="width: 15%">Nominal</th>
                                </tr>

                                <!-- table title --->
                                <tr>
                                    <th class="text-center " style="width: 100%; text-transform:capitalize;"
                                        colspan="5">
                                        <input type="text" name="judul_doku"
                                            placeholder="Isikan Keterangan RB disini. Contoh: keperluan kantor, keperluan project ABC, keperluan tender ABC."
                                            style="width: 50%" value="{{ $reimbursement->judul_doku }}">

                                    </th>
                                </tr>
                            </thead>
                            <tbody id="detail">
                                <?php $no = 1; ?>
                                @foreach ($rb_detail as $item)
                                    <tr>
                                        <td class="text-center" style="max-width: 5%; text-align: center;">
                                            {{ $no++ . '.' }}</td>
                                        <td style="text-transform:capitalize;">
                                            <input type="hidden" name="id[]" value="{{ $item->id }}">
                                            <input type="hidden" name=flag[] value='u'>
                                            <input type="text" name="deskripsi[]"
                                                placeholder="Tuliskan deskripsi di kolom ini." style="width: 50%"
                                                value="{{ $item->deskripsi }}">
                                            &nbsp;
                                            <input type="text" name="project[]"
                                                placeholder="Isi Keperluan Project" style="width: 25%"
                                                value="{{ $item->keperluan }}"> &nbsp; <input type="file"
                                                name="foto[]" accept=".jpg, .png, .jpeg" style="width: 20%;">
                                            <br>
                                            <input type="date" name="tgl1[]" style="width:20%"
                                                value="{{ $item->tanggal_1 }}">
                                            &nbsp; s/d &nbsp;
                                            <input type="date" name="tgl2[]" style="width:23%"
                                                value="{{ $item->tanggal_2 }}">
                                            <span style="margin-left: 170px">Harus JPG atau PNG</span>
                                        </td>
                                        <td class="text-center" style="max-width: 5%;">
                                            <input type="text" name="nobu[]" placeholder="Nomor Bukti"
                                                style="text-align: center; width: 100%"
                                                value="{{ $item->no_bukti }}">
                                            Nomor Struk, Nota, Atau <i>Receipt</i>
                                        </td>
                                        <td class="text-end">
                                            <select name="kurs_rb[]" style="text-align: center;">
                                                <option value={{ $item->curr }}>{{ $item->curr }} </option>
                                                @foreach ($kurs as $KursItem)
                                                    <option value="{{ $KursItem->mata_uang }}"
                                                        {{ $KursItem->mata_uang == 'IDR' ? 'selected' : '' }}>
                                                        {{ $KursItem->mata_uang }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name='nom_rb[]'
                                                style="text-align:right; width: 100%" placeholder="Input Nominal"
                                                value="{{ $item->nominal }}" step="0.001">
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- Tabel detail akan ditambahkan di sini oleh JavaScript -->
                            </tbody>
                        </table>
                        <a href="javascript:;" class="btn btn-info justify-content-between btn-sm"
                            onclick="addRB()"><i class="fa-solid fa-circle-plus fa-bounce"></i>&nbsp;Add
                            More</a>
                        <div style="margin-top: 30px;">
                            <table class="table is-striped table-bordered border-dark text-center"
                                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin-top: -20px;">
                                <tr>
                                    <td style="width:25%">
                                        <div class="text-center" style="font-weight: bold">Pemohon, &nbsp;<select
                                                name="pemohon" style="text-align: center">
                                                <option value={{ $reimbursement->pemohon }}>
                                                    {{ $reimbursement->pemohon }} </option>
                                                {{-- @foreach ($karyawan as $item)
                                                    <option value="{{ $item->nama }}"
                                                        {{ $item->nama == '' ? 'selected' : '' }}>
                                                        {{ $item->nama }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>

                                    </td>
                                    <td style="width:25%" hidden>
                                        <div class="text-center" style="font-weight: bold">Accounting,</div>
                                        <div style="margin-top: 40px"></div>
                                        <div class="text-center">
                                            <input type="text" name="accounting"
                                                value="{{ $reimbursement->accounting }}" readonly
                                                style="text-align: center">
                                        </div>
                                    </td>
                                    <td style="width:25%" hidden>
                                        <div class="text-center" style="font-weight: bold">Kasir,</div>
                                        <div style="margin-top: 40px"></div>
                                        <div class="text-center">
                                            <input type="text" name="kasir" value="{{ $reimbursement->kasir }}"
                                                readonly style="text-align: center">
                                        </div>
                                    </td>
                                    <td style="width:25%">
                                        <div class="text-center" style="font-weight: bold">Menyetujui, &nbsp;<select
                                                id="menyetujui" name="nama_menyetujui" onchange="updateFields2()"
                                                data-url="{{ route('admin.reimbursement.getNomor') }}"
                                                style="text-align: center">
                                                <option value={{ $reimbursement->menyetujui }}>
                                                    {{ $reimbursement->menyetujui }}</option>
                                                @foreach ($menyetujui as $item)
                                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group" hidden>
                                            <label for="exampleInputPassword1">Nomor Telepon</label>
                                            <input type="text" id="no_telp" name="no_telp" readonly
                                                value="{{ $reimbursement->no_telp_direksi }}">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">

                            <button type="button" class="btn btn-warning" id="draftBtn" name="draftBtn"><i
                                    class="fa-solid fa-floppy-disk fa-bounce"></i>&nbsp;Save as Draft</button>
                            &nbsp;
                            <button type="button" class="btn btn-primary" id="submitBtn" name="submitBtn"><i
                                    class="fa-solid fa-floppy-disk fa-bounce"></i>&nbsp;Submit</button>

                        </div>
                    </form>

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
        $(document).ready(function() {
            $('#bulan').change(function() {
                $('#formBulan').submit(); // Mengirimkan form saat bulan berubah
            });
        });
    </script>
    <script></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let no = 2;

        function addRB() {
            var project = document.getElementById('detail');

            // Buat elemen <tr> baru untuk tabel
            var newRow = document.createElement('tr');

            // Isi konten untuk <tr> baru
            newRow.innerHTML = `
                <td class="text-center">${no++ + '.'}</td>
                <td style="text-transform:capitalize;">
                    <input type="text" name="deskripsi[]" placeholder="Tuliskan deskripsi di kolom ini." style="width: 50%">
                    &nbsp;
                    <input type="text" name="project[]" placeholder="Isi Keperluan Project" style="width: 25%">
                    &nbsp;
                    <input type="file" name="foto[]" accept=".jpg, .png, .jpeg" style="width: 20%;">
                    <br>
                    <input type="date" name="tgl1[]" style="width:20%">
                    &nbsp; s/d &nbsp;
                    <input type="date" name="tgl2[]" style="width:23%">
                    <span style="margin-left: 170px">Harus JPG atau PNG</span>
                </td>
                <td class="text-center">
                    <input type="text" name="nobu[]" placeholder="Nomor Bukti" style="text-align: center; width: 100%">
                    Nomor Struk, Nota, Atau <i>Receipt</i>
                </td>
                <td class="text-end">
                    <select name="kurs_rb[]" style="text-align: center;">
                        <option value=""> --- Pilih --- </option>
                        @foreach ($kurs as $item)
                            <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>
                                {{ $item->mata_uang }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name='nom_rb[]' style="text-align:right; width: 75%" placeholder="Input Nominal"> &nbsp; <button name="delete${no}" id="delete${no}" onclick="deleteRow(this);" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i></button>
                </td>
            `;

            // Tambahkan <tr> baru ke dalam tabel
            project.appendChild(newRow);
        }

        function deleteRow(button) {
            // Dapatkan elemen induk dari tombol yang diklik (yaitu <tr>)
            let row = button.parentNode.parentNode;

            // Dapatkan elemen tabel yang berisi baris yang ingin dihapus
            let table = row.parentNode;

            // Hapus baris dari tabel
            table.removeChild(row);
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const draftBtn = document.getElementById('draftBtn');
            const submitBtn = document.getElementById('submitBtn');
            const draftActionInput = document.querySelector('input[name="draftAction"]');
            const submitActionInput = document.querySelector('input[name="submitAction"]');

            draftBtn.addEventListener('click', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: 'Do you want to save your changes as a draft?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Save as Draft',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        draftActionInput.value = 'true'; // Isi nilai input tersembunyi
                        submitActionInput.value = 'false'; // Isi nilai input tersembunyi
                        document.getElementById('formId').submit();
                    }
                });
            });
            submitBtn.addEventListener('click', function() {
                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: 'Do you want to submit?',
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitActionInput.value = 'true'; // Isi nilai input tersembunyi
                        draftActionInput.value = 'false'; // Isi nilai input tersembunyi
                        document.getElementById('formId').submit();
                    }
                });
            });
        });
    </script>



</body>

</html>
