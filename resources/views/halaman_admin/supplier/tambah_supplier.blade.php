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
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Supplier</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.supplier.simpan_supplier') }}" method="POST"
                                        id="formId">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Supplier</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="nama">
                                            <small id="emailHelp" class="form-text text-muted">Digunakan untuk
                                                PR/PO</small>
                                        </div>
                                        @error('nama')
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ $message }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @enderror
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">PIC</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="pic">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Menyetujui</label>
                                            <select class="form-control" id="exampleFormControlSelect1"
                                                name="nama_menyetujui">
                                                <option value=""> --- Pilih --- </option>
                                                @foreach ($menyetujui as $item)
                                                    <option value="{{ $item->nama }}">{{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">No Rekening</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="no_rek">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Bank</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="bank">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Pemilik Bank (A/N)</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="pemilik_bank">
                                        </div>
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
