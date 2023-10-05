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
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Purchase Request
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.purchase_request.update_PR', $PR->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No Dokumen</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="no_doku" value="{{ $PR->no_doku }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tanggal</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="tgl_diajukan"
                                                value="{{ $PR->tgl_diajukan ? date('d/m/Y', strtotime($PR->tgl_diajukan)) : '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Pemohon</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="pemohon" value="{{ $PR->pemohon }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Menyetujui</label>
                                            <select class="form-control" id="exampleFormControlSelect1"
                                                name="nama_menyetujui">
                                                <option value=""> --- Pilih --- </option>
                                                @foreach ($menyetujui as $item)
                                                    <option value="{{ $item->nama }}"
                                                        {{ $item->nama == $PR->menyetujui ? 'selected' : '' }}>
                                                        {{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-text text-muted"
                                            style="font-size: 16px; font-family: Arial; color: red">
                                            * Aris (Keperluan Direksi) <br>
                                            * Sujiono (Keperluan Project) <br>
                                            * Yacob (Keperluan Office)
                                        </div>
                                        <div class="form-group mt-3">
                                            <div id="detail"></div>
                                        </div>
                                        <div class="d-flex justify-content-center" style="margin-top: 20px">
                                            <a href="javascript:;" class="btn btn-info" id="add_pr"><i
                                                    class="fa-solid fa-circle-plus fa-bounce"></i>&nbsp;Tambah PR</a>
                                            &nbsp;&nbsp;
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa-solid fa-floppy-disk fa-bounce"></i>&nbsp;Submit</button>
                                            &nbsp;&nbsp;
                                            <a href="{{ route('admin.purchase_request') }}" class="btn btn-danger"><i
                                                    class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
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
        let i = 0;
        document.getElementById('add_pr').onclick = function() {
            let template =
                `<center>
                    <div class = 'container'>
                        <div class = 'row'>
                            <div class = 'col-md-12'>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" class="form-control" name="ket[]" value="{{ $PR_detail->judul }}">
                                </div>
                            </div>
                            <div class = 'col-md-12'>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="">Tanggal</label>
                                            <input type="date" class="form-control" placeholder="Tanggal" name='tgl_1[]' value="{{ $PR_detail->tgl_1 }}">
                                        </div>
                                        <div class="col">
                                            <label for="">Tanggal</label>
                                            <input type="date" class="form-control" placeholder="Tanggal" name='tgl_2[]' value="{{ $PR_detail->tgl_2 }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = 'col-md-12'>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="number" class="form-control" placeholder="Jumlah" name='jum[]' value="{{ $PR_detail->jumlah }}">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Qty" name='qty[]' value = "{{ $PR_detail->satuan }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = 'col-md-12'>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="">Tanggal Pakai</label>
                                            <input type="date" class="form-control" placeholder="Jumlah" name='tgl_pakai[]' value="{{ $PR_detail->tgl_pakai }}">
                                        </div>
                                        <div class="col">
                                            <label for="">Nama Project</label>
                                            <input type="text" class="form-control" placeholder="Project" name='project[]' value="{{ $PR_detail->project }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = 'row'>
                            <div class='col-md-12'>
                                <div class="form-group">
                                    <button name="delete${i}" id="delete${i}" onclick="deleteRow(this)" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>`;
            // Kode lanjutan untuk opsi yang valid dipilih
            let container = document.getElementById('detail');
            let div = document.createElement('div');
            div.innerHTML = template;
            container.appendChild(div);

            i++;
        }

        function deleteRow(id) {
            var row;
            row = id.name.substring(id.name.length - 1, id.name.length);
            var id = $('#id' + row).val();
            $('#delete' + row).closest('center').remove();
        }
    </script>
</body>


</html>
