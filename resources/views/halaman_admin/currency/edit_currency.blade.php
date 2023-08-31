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
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Edit Mata Uang</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.currency.update_currency', $kurs->id) }}"
                                        method="POST" id="formId">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Mata Uang</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="kurs" value="{{ $kurs->mata_uang }}">
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

</body>
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


</html>
