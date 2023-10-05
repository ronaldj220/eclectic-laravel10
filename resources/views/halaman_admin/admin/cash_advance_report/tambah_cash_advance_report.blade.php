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
                <div class="container" style="margin-top: -10px; margin-right: 60px">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Cash Advance
                                        Report
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.cash_advance_report.simpan_cash_advance_report') }}"
                                        method="POST" enctype="multipart/form-data" id="formId">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No Dokumen</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="no_doku" value="{{ $no_dokumen }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tanggal Diajukan</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="tgl_diajukan" value="{{ date('d/m/Y') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Judul Dokumen</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="judul_doku">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor CA</label>
                                            <select class="form-control" name="tipe_ca_id" id="no_doku">
                                                <option value=""> --- Pilih --- </option>
                                                @foreach ($cash_advance as $item)
                                                    <option value="{{ $item->no_doku }}">{{ $item->no_doku }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nominal</label>
                                            <input type="text" class="form-control" name="nominal_ca" id="nominal_ca"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Pemohon</label>
                                            <input type="text" class="form-control" id="pemohon" name="pemohon"
                                                readonly>
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
                                            <input type="text" class="form-control" id="menyetujui"
                                                name="nama_menyetujui" readonly>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="exampleInputPassword1">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                                readonly>
                                        </div>
                                        <div class="form-text text-muted"
                                            style="font-size: 12px; font-family: Arial; color: red">
                                            * Aris (Keperluan Direksi) <br>
                                            * Sujiono (Keperluan Project) <br>
                                            * Yacob (Keperluan Office) <br>
                                            * Richard (Keperluan Marketing)
                                        </div>
                                        <div class="form-group mt-3">
                                            <div id="detail"></div>
                                        </div>
                                        <div class="d-flex justify-content-center" style="margin-top: 20px">
                                            <a href="javascript:;" class="btn btn-info" id="add-new-detail"><i
                                                    class="fa-solid fa-circle-plus fa-bounce"></i>&nbsp;Tambah
                                                Detail</a>
                                            &nbsp;&nbsp;
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
        let i = 0;
        document.getElementById('add-new-detail').onclick = function() {
            let template =
                `<center>
        <div class = 'container'>
          <div class = 'row'>
            <div class = 'col-md-12'>
              <div class="form-group">
                <label for="exampleInputPassword1">Deskripsi</label>
                <textarea class = 'form-control' name='deskripsi[]' rows=5></textarea>
              </div>
            </div>
            @error('email')
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @enderror
            <div class = 'col-md-6'>
              <div class="form-group">
                <label for="exampleInputPassword1">Bukti Cash Advance</label>
                <input type="file" class="form-control-file" name='foto[]' accept = '.png, .jpg'>
              </div>
            </div>
            <div class = 'col-md-6'>
              <div class="form-group">
                <label for="exampleInputPassword1">No Bukti</label>
                <input type="text" class="form-control" name='nobu[]'>
              </div>
            </div>
            <div class = 'col-md-6' hidden>
              <div class="form-group">
                <label for="exampleInputPassword1">Mata Uang</label>
                <select class="form-control" id="exampleFormControlSelect1" name="kurs[]">
                  <option value=""> --- Pilih --- </option>
                  @foreach ($kurs as $item)
                    <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class = 'col-md-6'>
              <div class="form-group">
                <label for="exampleInputPassword1">Nominal</label>
                <input type="number" class="form-control" name='nom[]' step='0.001'>
              </div>
            </div>
            <div class = 'col-md-6'>
              <div class="form-group">
                <label for="exampleInputPassword1">Tanggal Pengeluaran 1</label>
                <input type="date" class="form-control" name='tgl1[]'>
              </div>
            </div>
            <div class = 'col-md-6'>
              <div class="form-group">
                <label for="exampleInputPassword1">Tanggal Pengeluaran 2</label>
                <input type="date" class="form-control" name='tgl2[]'>
              </div>
            </div>
            <div class='col-md-6'>
                <div class="form-group">
                    <label for="keprluan">Project/Instansi/Perusahaan</label>
                        <input type="text" class="form-control @error('keperluan') is-invalid @enderror" name='keperluan[]' autofocus >
                            @error('keperluan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted"
                                style="font-size: 12px; font-family: Arial; margin-bottom: 20px">
                                    * Isi buat keperluan Project
                            </div>
                </div>
            </div>
          </div>
          <div class = 'row'>
            <div class = 'col-md-12'>
              <div class="form-group">
                <button name="delete${i}" id="delete${i}" onclick="deleteRow(this)" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
              </div>
            </div>
          </div>
        </div>
    </center>`;

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
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            $(document).ready(function() {
                $("select").on("change", function() {
                    var tipe_ca_id = $(this).val();
                    $.ajax({
                        url: "{{ route('admin.CAR.getNominal') }}",
                        type: "GET",
                        data: {
                            tipe_ca_id: tipe_ca_id
                        },
                        success: function(data) {
                            $("#nominal_ca").val(data.nominal_ca);
                            $("#pemohon").val(data.pemohon);
                            $("#menyetujui").val(data.nama_menyetujui);
                            $("#no_telp").val(data.no_telp);
                            // console.log(data);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Handle error
                            console.log(textStatus, errorThrown);
                        }
                    });
                });
            });
        });
    </script>
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

</body>


</html>
