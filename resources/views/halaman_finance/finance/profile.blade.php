@include('layouts.halaman_kasir.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.halaman_kasir.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.halaman_kasir.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Update Profil
                                        Finance</h6>
                                </div>
                                <form action="{{ route('kasir.beranda.update_profile', Auth::user()->id) }}"
                                    method="POST" id="formId">
                                    @csrf
                                    <div class="card-body">
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
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary" id="submitBtn"><i
                                                    class="fa-solid fa-floppy-disk fa-bounce"></i>&nbsp;Submit</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            @include('layouts.halaman_kasir.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layouts.halaman_kasir.logout')

    @include('layouts.halaman_kasir.script')
    <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Untuk mencegah pengiriman formulir secara otomatis

            Swal.fire({
                title: 'Apakah anda yakin ingin submit? ',
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
