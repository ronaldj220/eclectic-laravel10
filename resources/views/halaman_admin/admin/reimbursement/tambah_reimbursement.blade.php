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
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Reimbursement
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.reimbursement.simpan_reimbursement') }}"
                                        method="POST" enctype="multipart/form-data" id="formId">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No Dokumen</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="no_doku" value="{{ $no_dokumen }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tanggal</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="tgl_diajukan" value="{{ date('d/m/Y') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="judul_doku">
                                            <small id="emailHelp" class="form-text text-muted">Contoh: keperluan
                                                kantor, keperluan project ABC, keperluan tender ABC.</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Pemohon</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="pemohon">
                                                <option value="Zhomi"> Zhomi </option>
                                                @foreach ($karyawan as $item)
                                                    <option value="{{ $item->nama }}"
                                                        {{ $item->nama == '' ? 'selected' : '' }}>
                                                        {{ $item->nama }}</option>
                                                @endforeach
                                            </select>
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
                                            <select class="form-control" id="menyetujui" name="nama_menyetujui"
                                                onchange="updateFields2()"
                                                data-url="{{ route('admin.reimbursement.getNomor') }}">
                                                <option value=""> --- Pilih --- </option>
                                                @foreach ($menyetujui as $item)
                                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-text text-muted"
                                            style="font-size: 16px; font-family: Arial; color: red">
                                            * Aris (Keperluan Direksi) <br>
                                            * Sujiono (Keperluan Project) <br>
                                            * Yacob (Keperluan Office) <br>
                                            * Richard (Keperluan Marketing)
                                        </div>
                                        <div class="form-group" hidden>
                                            <label for="exampleInputPassword1">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                                readonly>
                                        </div>

                                        <div class="form-group" style="margin-top: 10px; margin-bottom: 2px">
                                            <label for="">Pilih</label>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="project"
                                                    id="inlineRadio1" value="RB (Reimbursement)">
                                                <label class="form-check-label" for="inlineRadio1">RB
                                                    (Reimbursement)</label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" name="project"
                                                    id="inlineRadio2" value="TS (Timesheet Support)">
                                                <label class="form-check-label" for="inlineRadio2">TS (Timesheet
                                                    Support)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="project"
                                                    id="inlineRadio3" value="ST (Support Ticket)">
                                                <label class="form-check-label" for="inlineRadio3">ST (Support
                                                    Ticket)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="project"
                                                    id="inlineRadio4" value="SL (Support Lembur)">
                                                <label class="form-check-label" for="inlineRadio4">SL (Support
                                                    Lembur)</label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3">
                                            <div id="detail"></div>
                                        </div>
                                        <div class="d-flex justify-content-center" style="margin-top: 20px">
                                            <a href="javascript:;" class="btn btn-info"
                                                onclick="confirmBeforeAddRB()"><i
                                                    class="fa-solid fa-circle-plus fa-bounce"></i>&nbsp;Tambah RB</a>
                                            &nbsp;&nbsp;
                                            <button type="submit" id="submitBtn" class="btn btn-primary"
                                                style="display: none"><i
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

    @include('layouts.halaman_admin.script')

    <script>
        function confirmBeforeAddRB() {
            if (isAnyRadioButtonSelected()) {
                // Jika salah satu radio button sudah dipilih, jalankan fungsi getRadioValueAndShowSubmitButton()
                getRadioValueAndShowSubmitButton();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Harap pilih salah satu project sebelum menambahkan RB.',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }

        // Fungsi untuk memeriksa apakah ada salah satu radio button yang dipilih
        function isAnyRadioButtonSelected() {
            const radioButtons = document.querySelectorAll('input[name="project"]');
            for (const radioButton of radioButtons) {
                if (radioButton.checked) {
                    return true; // Mengembalikan true jika ada radio button yang dipilih
                }
            }
            return false; // Mengembalikan false jika tidak ada radio button yang dipilih
        }

        // Fungsi untuk menampilkan tombol "Submit" ketika tombol "Tambah RB" ditekan
        function getRadioValueAndShowSubmitButton() {
            getRadioValue();
            showSubmitButton();
        }

        // Fungsi untuk menampilkan tombol "Submit"
        function showSubmitButton() {
            const submitButton = document.getElementById('submitBtn');
            submitButton.style.display = 'block';
        }

        function hideSubmitButton() {
            const submitButton = document.getElementById('submitBtn');
            submitButton.style.display = 'none';
        }


        function getRadioValue() {
            var radio = document.getElementsByName('project');
            var selectedValue = '';
            for (i = 0; i < radio.length; i++) {
                if (radio[i].checked) {

                    selectedValue = radio[i].value;

                    // Setelah validasi berhasil, atur template yang akan ditampilkan berdasarkan opsi yang dipilih
                    let template = '';

                    if (selectedValue === 'RB (Reimbursement)') {
                        template =
                            `<center>
                                <div class='container'>
                                    <div class = 'row'>
                                        <div class = 'col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Deskripsi</label>
                                                <textarea class='form-control' name='deskripsi[]' rows='6'></textarea>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">File Bukti</label>
                                                <input type="file" class="form-control-file" name='foto[]' accept='.png, .jpg'>
                                                <br>
                                                <div class="form-text text-muted"
                                                    style="font-size: 12px; font-family: Arial; margin-bottom: 20px">
                                                    Harus JPG atau PNG
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">No Bukti</label>
                                                <input type="text" class="form-control" name='nobu[]'>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mata Uang</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="kurs_rb[]">
                                                    <option value="" > --- Pilih --- </option>
                                                    @foreach ($kurs as $item)
                                                        <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nominal</label>
                                                <input type="number" class="form-control" name='nom_rb[]'>
                                            </div>
                                        </div>
                                        <div class='col-md-5'>
                                            <div class="form-group">
                                                <label for="tgl1">Tanggal</label>
                                                <input type="date" class="form-control" name='tgl1[]'>
                                            </div>
                                        </div>
                                        <div class='col' style = 'margin-top: 40px'>
                                            <span>s/d</span>
                                        </div>
                                        <div class='col-md-5'>
                                            <div class="form-group">
                                                <label for="tgl2">Tanggal</label>
                                                <input type="date" class="form-control" name='tgl2[]'>
                                                <div class="form-text text-muted"
                                                    style="font-size: 12px; font-family: Arial; margin-bottom: 20px">
                                                    * OPSIONAL (Gunakan jika memerlukan rentang tanggal)
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-md-5'>
                                            <div class="form-group">
                                                <label for="keprluan">Project/Instansi/Perusahaan Tujuan</label>
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
                                            <div class="form-group" style = 'margin-top: 20px'>
                                                <button name="delete${i}" id="delete${i}" onclick="deleteRow(this); hideSubmitButton();" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>`;
                    } else if (selectedValue === 'TS (Timesheet Support)') {
                        template =
                            `<center>
                                <div class='container'>
                                    <div class = 'row'>
                                        <div class = 'col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Karyawan</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="karyawan_ts[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($karyawan as $item)
                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class = 'col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mata Uang</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="kurs_ts[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($kurs as $item)
                                                        <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nominal</label>
                                                <input type="text" class="form-control" name='nom_ts[]' value = {{ $nominal_awal[0]->nominal }} readonly>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Hari (Secara Default)</label>
                                                <input type="text" class="form-control" name='hari_ts1[]' value = {{ $nominal_awal[0]->hari }} readonly>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Hari </label>
                                                <input type="number" class="form-control" name='hari_ts2[]'>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class = 'row'>
                                        <div class='col-md-12'>
                                            <div class="form-group">
                                                <button name="delete${i}" id="delete${i}" onclick="deleteRow(this); hideSubmitButton();" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>`;
                    } else if (selectedValue === 'ST (Support Ticket)') {
                        template =
                            `<center>
                                <div class='container'>
                                    <div class = 'row'>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Karyawan</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="karyawan_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($karyawan as $item)
                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nickname Project</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="project_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($aliases as $item)
                                                        <option value="{{ $item->aliases }}">{{ $item->aliases }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mata Uang</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="kurs_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($kurs as $item)
                                                        <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nominal</label>
                                                <input type="text" class="form-control" name='nom_st[]' value = {{ $nominal_project[0]->nominal }} readonly>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Jam </label>
                                                <input type="number" class="form-control" name='jam_st[]' step="0.001">
                                            </div>
                                        </div>
                                    </div>
                                    <div class = 'row'>
                                        <div class='col-md-12'>
                                            <div class="form-group">
                                                <button name="delete${i}" id="delete${i}" onclick="deleteRow(this); hideSubmitButton();" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>`;
                    } else if (selectedValue === 'SL (Support Lembur)') {
                        template =
                            `<center>
                                <div class='container'>
                                    <div class = 'row'>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Karyawan</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="karyawan_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($karyawan as $item)
                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nickname Project</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="project_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($aliases as $item)
                                                        <option value="{{ $item->aliases }}">{{ $item->aliases }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mata Uang</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="kurs_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($kurs as $item)
                                                        <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nominal</label>
                                                <input type="text" class="form-control" name='nom_st[]' value = {{ $nominal_project[0]->nominal }} readonly>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Jam </label>
                                                <input type="number" class="form-control" name='jam_st[]'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = 'row'>
                                        <div class='col-md-12'>
                                            <div class="form-group">
                                                <button name="delete${i}" id="delete${i}" onclick="deleteRow(this); hideSubmitButton();" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>`;
                    }





                    // Kode lanjutan untuk opsi yang valid dipilih
                    let container = document.getElementById('detail');
                    let div = document.createElement('div');
                    div.innerHTML = template;
                    container.appendChild(div);

                    i++;
                }
            }
        }


        function deleteRow(id) {
            var row;
            row = id.name.substring(id.name.length - 1, id.name.length);
            var id = $('#id' + row).val();
            $('#delete' + row).closest('center').remove();
        }

        function updateFields2() {
            var selectedSupplier = document.getElementById("menyetujui").value;
            var url = document.getElementById("menyetujui").getAttribute("data-url");

            // Lakukan permintaan AJAX ke endpoint getDataBySupplier
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        document.getElementById("no_telp").value = response.keterangan;
                    } else {
                        document.getElementById("pemohon").value = "";
                        document.getElementById("menyetujui").value = "";
                    }
                }
            };
            xhr.open("GET", url + "?menyetujui=" + selectedSupplier);
            xhr.send();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>
@include('sweetalert::alert')


</html>
