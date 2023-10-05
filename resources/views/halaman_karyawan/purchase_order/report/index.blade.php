@include('layouts.halaman_karyawan.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.halaman_karyawan.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.halaman_karyawan.topbar')

                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Cari Tanggal Dokumen PO</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('karyawan.PO.search_date_PO') }}" method="POST" id="formId">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <label for="">Tanggal Awal</label>
                                        <input type="date" class="form-control @error('tgl_1') is-invalid @enderror"
                                            name="tgl_1" id="tgl_1">
                                        @error('tgl_1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">Tanggal Akhir</label>
                                        <input type="date" class="form-control @error('tgl_2') is-invalid @enderror"
                                            name="tgl_2" id="tgl_2">
                                        @error('tgl_2')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary" style="margin-top: 20px;"
                                        id="findBtn"><i class="fa-solid fa-magnifying-glass"></i> Find</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

            @include('layouts.halaman_karyawan.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layouts.halaman_karyawan.logout')

    @include('layouts.halaman_karyawan.script')

    <script>
        document.getElementById('findBtn').addEventListener('click', function(event) {
            const tanggalAwal = document.getElementById("tgl_1").value;
            const tanggalAkhir = document.getElementById("tgl_2").value;
            event.preventDefault(); // Untuk mencegah pengiriman formulir secara otomatis
            if (tanggalAwal && tanggalAkhir) {
                Swal.fire({
                    title: "Pencarian Berdasarkan Tanggal",
                    text: `Apakah anda yakin mencari data antara ${tanggalAwal} dan ${tanggalAkhir}?`,
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonText: 'Cari',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tindakan jika tombol "Save" diklik
                        document.getElementById('formId').submit(); // Submit formulir secara manual
                    }
                });
            } else {
                Swal.fire({
                    title: "Oops!...",
                    text: "Mohon isi kedua tanggal dengan benar.",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500
                });
            }

        });
    </script>


</body>

</html>
