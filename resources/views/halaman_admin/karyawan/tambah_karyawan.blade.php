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
                        <div class="col-lg-6">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Daftar Karyawan</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.karyawan.simpan_karyawan') }}" method="POST"
                                        id="formId">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat Email</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="email">
                                            <small id="emailHelp" class="form-text text-muted">Digunakan untuk login
                                                sebagai karyawan</small>
                                        </div>
                                        @error('email')
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ $message }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @enderror
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nama</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="nama">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">No Rekening</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1"
                                                name="no_rekening">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Bank</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="bank">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="no_telp">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Jabatan</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="jabatan">
                                                <option value="Konsultan">Konsultan</option>
                                                <option value="Project Manager">Project Manager</option>
                                                <option value="Support Manager">Support Manager</option>
                                                <option value="Staff">Staff</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">TTD</label>
                                            <div id="signatureContainer">
                                                <canvas id="signatureCanvas" width="500" height="200"></canvas>
                                            </div>
                                            <button id="clearButton" class="btn btn-warning text-center"
                                                type="button">Hapus Tanda
                                                Tangan</button>
                                            <input type="hidden" name="signature" id="signatureInput">
                                        </div>
                                        @error('signature')
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ $message }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @enderror
                                        <div class="d-flex justify-content-center">
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

    @include('layouts.halaman_admin.script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <script>
        const signaturePad = new SignaturePad(document.getElementById('signatureCanvas'));
        const signatureInput = document.getElementById('signatureInput');

        clearButton.addEventListener('click', () => {
            signaturePad.clear();
            signatureInput.value = ''; // Hapus nilai tanda tangan dari input tersembunyi
        });
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            event.preventDefault();

            // ...

            // Setel nilai input tersembunyi dengan data tanda tangan base64
            signatureInput.value = signaturePad.toDataURL(); // Menyimpan tanda tangan dalam bentuk base64

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
</body>


</html>
