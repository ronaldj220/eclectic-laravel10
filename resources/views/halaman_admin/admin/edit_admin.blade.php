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
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Edit Admin</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.admin.update_admin', $admin->id) }}" method="POST"
                                        id="formId">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat Email</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="email" value="{{ $admin->email }}">
                                            <small id="emailHelp" class="form-text text-muted">Digunakan untuk login
                                                sebagai admin</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nama</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="nama" value="{{ $admin->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">No Rekening</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1"
                                                name="no_rekening" value="{{ $admin->no_rekening }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Bank</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="bank" value="{{ $admin->bank }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="no_telp" value="{{ $admin->no_telp }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Jabatan</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="jabatan">
                                                <option value="{{ $admin->jabatan }}">{{ $admin->jabatan }}</option>
                                                <option value="Project Manager">Project Manager</option>
                                                <option value="Support Manager">Support Manager</option>
                                                <option value="Staff">Staff</option>
                                                <option value="Admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">TTD</label>
                                            <div id="signatureContainer">
                                                <canvas id="signatureCanvas" width="500" height="200"></canvas>
                                            </div>
                                            <button id="clearButton" class="btn btn-warning text-center">Hapus Tanda
                                                Tangan</button>

                                            <input type="hidden" name="signature" id="signatureInput">
                                        </div>
                                        <div class="d-flex justify-content-center">

                                            <button type="submit" class="btn btn-primary" id="updateBtn"><i
                                                    class="fa-solid fa-floppy-disk fa-bounce"></i>&nbsp;Update</button>

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
            @include('layouts.halaman_admin.footer')
            <!-- End of Footer -->

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
        document.getElementById('updateBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Untuk mencegah pengiriman formulir secara otomatis

            Swal.fire({
                title: 'Apakah anda yakin ingin update? ',
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
        document.getElementById('clearButton').addEventListener('click', function(event) {
            event.preventDefault();

            // ...

            // Setel nilai input tersembunyi dengan data tanda tangan base64
            signatureInput.value = signaturePad.toDataURL(); // Menyimpan tanda tangan dalam bentuk base64

            Swal.fire({
                title: 'Apakah anda yakin ingin update? ',
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
