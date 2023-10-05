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
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Edit Project/Client
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.client.update_client', $client->id) }}" method="POST"
                                        id="formId">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kode Project</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="kode"
                                                value="{{ $client->kode_project }}" readonly>
                                            <small id="emailHelp" class="form-text text-muted">Digunakan untuk
                                                Timesheet dan Support</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nama Project</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="nama" value="{{ $client->nama_perusahaan }}">
                                        </div>
                                        <div class="form-row"
                                            style="display: flex;
                                        flex-direction: row;
                                        align-items: center;">
                                            <div class="col-6">
                                                Nickname (Secara singkat)
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control" id="exampleInputPassword1"
                                                    name="nickname" value="{{ $client->aliases }}">
                                            </div>
                                        </div>
                                        <div class="form-row"
                                            style="display: flex;
                                        flex-direction: row;
                                        align-items: center; margin-top: 20px">
                                            <div class="col-6">
                                                Group
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control" id="exampleInputPassword1"
                                                    name="group" value="{{ $client->group }}">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center" style="margin-top: 20px">
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

    <script>
        document.getElementById('updateBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Untuk mencegah pengiriman formulir secara otomatis

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
