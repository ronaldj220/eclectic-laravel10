@php
    date_default_timezone_set('Asia/Jakarta');
@endphp
@include('layouts.halaman_admin.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.halaman_admin.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.halaman_admin.topbar')

                <!-- Begin Page Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Cash Advance
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.cash_advance.simpan_cash_advance') }}" method="POST"
                                        id="formId">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No Dokumen</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="no_doku" value="{{ $no_dokumen }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tanggal</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="tgl_diajukan" value="{{ Date::now()->format('d/m/Y') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tanggal</label>
                                            <input type="date" class="form-control" id="exampleInputPassword1"
                                                name="tgl_diajukan2">
                                        </div>
                                        <div class="form-text text-muted"
                                            style="font-size: 12px; font-family: Arial; margin-bottom: 5px">
                                            * OPSIONAL (Gunakan jika memerlukan rentang tanggal)
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="judul_doku">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Mata Uang</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="kurs">
                                                <option value=""> --- Pilih --- </option>
                                                @foreach ($kurs as $item)
                                                    <option value="{{ $item->mata_uang }}"
                                                        {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>
                                                        {{ $item->mata_uang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nominal</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1"
                                                name="nominal" step="0.001">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Pemohon</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="pemohon">
                                                <option value="Zhomi"> Zhomi </option>
                                                @foreach ($karyawan as $item)
                                                    <option value="{{ $item->nama }}"
                                                        {{ $item->nama == '' ? 'selected' : '' }}>
                                                        {{ $item->nama }}</option>
                                                @endforeach
                                            </select>
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
                                                data-url="{{ route('admin.cash_advance.getNomor') }}">
                                                <option value=""> --- Pilih --- </option>
                                                @foreach ($menyetujui as $item)
                                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="exampleInputPassword1">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                                readonly>
                                        </div>
                                        <div class="form-text text-muted"
                                            style="font-size: 16px; font-family: Arial; color: red">
                                            * Aris (Keperluan Direksi) <br>
                                            * Sujiono (Keperluan Project) <br>
                                            * Yacob (Keperluan Office) <br>
                                            * Richard (Keperluan Marketing)
                                        </div>
                                        <div class="d-flex justify-content-center" style="margin-top: 20px">
                                            <button type="submit" class="btn btn-primary" id="submitBtn"><i
                                                    class="fa-solid fa-floppy-disk fa-bounce"></i>&nbsp;Submit</button>
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

            @include('layouts.halaman_admin.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layouts.halaman_admin.logout')
    <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Untuk mencegah pengiriman formulir secara otomatis

            Swal.fire({
                title: 'Apakah anda yakin ingin submit? ',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                denyButtonText: `Jangan Simpan`,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tindakan jika tombol "Save" diklik
                    document.getElementById('formId').submit(); // Submit formulir secara manual
                } else if (result.isDenied) {
                    // Tindakan jika tombol "Don't save" diklik
                    Swal.fire('Perubahan tidak akan disimpan', '', 'info');
                }
            });
        });
    </script>

    @include('layouts.halaman_admin.script')

    <script>
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
</body>


</html>
