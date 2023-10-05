@include('layouts.halaman_direksi.header')

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.halaman_direksi.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.halaman_direksi.topbar')

                <!-- Begin Page Content -->
                <div class="container" style="margin-right: 60px;">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Update Profil Direksi
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('direksi.beranda.update_profile', Auth::user()->id) }}"
                                        method="POST" id="formId">
                                        @csrf
                                        <div class="col-md-12">
                                            <label class="" for="">Email:</label>
                                            <input type="text" name="email" class="form-group form-control"
                                                value="{{ Auth::user()->email }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="" for="">Nama:</label>
                                            <input type="text" name="nama" class="form-group form-control"
                                                value="{{ Auth::user()->nama }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="" for="">No Rekening:</label>
                                            <input type="number" name="no_rekening" class="form-group form-control"
                                                value="{{ Auth::user()->no_rekening }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="" for="">Bank:</label>
                                            <input type="text" name="bank" class="form-group form-control"
                                                value="{{ Auth::user()->bank }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="" for="">No Telepon:</label>
                                            <input type="text" name="no_telp" class="form-group form-control"
                                                value="{{ Auth::user()->no_telp }}">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Jabatan</label>
                                                <select class="form-control" id="exampleFormControlSelect1"
                                                    name="jabatan">
                                                    <option value="Direktur">Direktur</option>
                                                    <option value="Project Manager">Project Manager</option>
                                                    <option value="Head of Business Development">Head of Business
                                                        Development</option>
                                                    <option value="Support Manager">Support Manager</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
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

            @include('layouts.halaman_direksi.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layouts.halaman_direksi.logout')

    @include('layouts.halaman_direksi.script')
    <script>
        const signaturePad = new SignaturePad(document.getElementById('signatureCanvas'));
        const signatureInput = document.getElementById('signatureInput');

        clearButton.addEventListener('click', () => {
            signaturePad.clear();
            signatureInput.value = ''; // Hapus nilai tanda tangan dari input tersembunyi
        });
        document.getElementById('updateBtn').addEventListener('click', function(event) {
            event.preventDefault();

            // ...

            // Setel nilai input tersembunyi dengan data tanda tangan base64
            signatureInput.value = signaturePad.toDataURL(); // Menyimpan tanda tangan dalam bentuk base64

            Swal.fire({
                title: 'Apakah anda yakin ingin update? ',
                showCancelButton: true,
                confirmButtonText: 'Simpan',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tindakan jika tombol "Save" diklik
                    document.getElementById('formId').submit(); // Submit formulir secara manual
                }
            });
        });
    </script>
</body>

</html>
