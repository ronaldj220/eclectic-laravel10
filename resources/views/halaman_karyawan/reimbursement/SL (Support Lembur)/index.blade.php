@php
    date_default_timezone_set('Asia/Jakarta');
@endphp
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

                <div class="container">
                    <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                        <b><a style="text-transform: uppercase;">reimbursement</a></b>
                        <br>
                        <b><a style="text-transform: uppercase;">PT. Eclectic Consulting</a></b>
                    </figure>
                    <form action="{{ route('karyawan.RB.save_ST') }}" method="POST" id="formId">
                        @csrf
                        <input type="hidden" name="submitAction" value="true">
                        <table class="table table-borderless table-sm"
                            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin-left: -5px;">
                            <tr>
                                <td>No<br>
                                    <p style="margin-top: 19px">Tanggal</p>
                                </td>
                                <td>: <input type="text" name="no_doku" readonly><br>:&nbsp;<input type="text"
                                        readonly name="tgl_diajukan" value="{{ date('d/m/Y') }}"
                                        style="margin-top: 10px">
                                </td>
                            </tr>
                        </table>
                        <table class="table is-striped table-bordered border-dark table-sm"
                            style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin-top: -10px;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 6%">No.</th>
                                    <th class="text-center" style="width: 50%">Keterangan</th>
                                    <th class="text-center" style="width: 10%;">No. Bukti</th>
                                    <th class="text-center" style="width: 10%">Curr</th>
                                    <th class="text-center" style="width: 15%">Nominal</th>
                                </tr>

                                <!-- table title --->
                                <tr>
                                    <th class="text-center " style="width: 100%; text-transform:capitalize;"
                                        colspan="5">
                                        <input type="text" name="judul_doku"
                                            placeholder="Isikan Keterangan RB disini. Contoh: Timesheet Lembur, Timesheet Jarvies"
                                            style="width: 50%">
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="detail">
                                <?php $no = 1; ?>
                                <tr>
                                    <td class="text-center" style="max-width: 5%; text-align: center;">
                                        {{ $no . '.' }}</td>
                                    <td style="text-transform: capitalize;">
                                        <select name="karyawan_st[]" class="js-example-basic-single"
                                            data-placeholder="Pilih Nama Karyawan" style=" width: 25%">
                                            <option></option>
                                            @foreach ($karyawan as $item)
                                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        &nbsp;
                                        <select name="project_st[]" class="js-example-basic-single"
                                            data-placeholder="Pilih Nama Project" style=" width: 25%">
                                            <option></option>
                                            @foreach ($aliases as $item)
                                                <option value="{{ $item->aliases }}">{{ $item->aliases }}</option>
                                            @endforeach
                                        </select>
                                        &nbsp;
                                        <input type="text" style="width: 20%" name='nom_st[]'
                                            value={{ $nominal_project[0]->nominal }} readonly hidden>
                                        &nbsp;
                                        <input type="number" name='jam_st[]' step="0.001" style="width: 20%"
                                            placeholder="Jam" id="jam_st">
                                    </td>

                                    <td></td>
                                    <td class="text-center">
                                        <select name="kurs_st[]"
                                            style="text-align: center; justify-items: center; width: 100%"
                                            class="js-example-basic-single">
                                            @foreach ($kurs as $item)
                                                <option value="{{ $item->mata_uang }}"
                                                    {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>
                                                    {{ $item->mata_uang }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" id="hasil_st" hidden>
                                    </td>
                                </tr>
                                <!-- Tabel detail akan ditambahkan di sini oleh JavaScript -->
                            </tbody>
                        </table>
                        <a href="javascript:;" class="btn btn-info justify-content-between btn-sm" onclick="addRB()"><i
                                class="fa-solid fa-circle-plus fa-bounce"></i>&nbsp;Add
                            More</a>
                        <div style="margin-top: 30px;">
                            <table class="table is-striped table-bordered border-dark text-center"
                                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin-top: -20px;">
                                <tr>
                                    <td style="width:25%">
                                        <div class="text-center" style="font-weight: bold">Pemohon, &nbsp;<input
                                                type="text" name="pemohon" value="{{ Auth::user()->nama }}"
                                                readonly>
                                            </select>
                                        </div>

                                    </td>
                                    <td style="width:25%" hidden>
                                        <div class="text-center" style="font-weight: bold">Accounting,</div>
                                        <div style="margin-top: 40px"></div>
                                        <div class="text-center">
                                            <input type="text" name="accounting" value="{{ $accounting[0]->nama }}"
                                                readonly style="text-align: center">
                                        </div>
                                    </td>
                                    <td style="width:25%" hidden>
                                        <div class="text-center" style="font-weight: bold">Kasir,</div>
                                        <div style="margin-top: 40px"></div>
                                        <div class="text-center">
                                            <input type="text" name="kasir" value="{{ $kasir[0]->nama }}"
                                                readonly style="text-align: center">
                                        </div>
                                    </td>
                                    <td style="width:25%">
                                        <div class="text-center" style="font-weight: bold">Menyetujui, &nbsp;<select
                                                id="menyetujui" name="nama_menyetujui" onchange="updateFields2()"
                                                data-url="{{ route('karyawan.reimbursement.getNomor') }}"
                                                style="text-align: center">
                                                <option value=""> --- Pilih --- </option>
                                                @foreach ($menyetujui as $item)
                                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group" hidden>
                                            <label for="exampleInputPassword1">Nomor Telepon</label>
                                            <input type="text" id="no_telp" name="no_telp" readonly>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">

                            <button type="button" class="btn btn-primary" id="submitBtn" name="submitBtn"><i
                                    class="fa-solid fa-floppy-disk fa-bounce"></i>&nbsp;Submit</button>

                        </div>
                    </form>
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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        // Menangkap elemen input nominal_st, jam_st, dan hasil_st
        var nominalInput = document.getElementById('nom_st');
        var jamInput = document.getElementById('jam_st');
        var hasilInput = document.getElementById('hasil_st');

        // Menambahkan event listener pada input jam_st
        jamInput.addEventListener('input', function() {
            // Mengambil nilai dari input nominal_st dan jam_st
            var nominal = parseFloat(nominalInput.value);
            var jam = parseFloat(jamInput.value);

            // Menghitung hasil perkalian
            var hasil = nominal * jam;

            // Mengisi hasil perkalian ke dalam input hasil_st
            hasilInput.value = hasil.toFixed(2); // Menampilkan hasil dengan tiga angka desimal
        });
    </script>

    <script>
        let no = 2;

        function addRB() {
            var project = document.getElementById('detail');

            // Buat elemen <tr> baru untuk tabel
            var newRow = document.createElement('tr');

            newRow.innerHTML = `
  <td class="text-center">${no}</td>
  <td style="text-transform: capitalize;">
    <select name="karyawan_st[]" class="js-example-basic-single"
                                            data-placeholder="Pilih Nama Karyawan" style=" width: 25%">
                                            <option></option>
                                            @foreach ($karyawan as $item)
                                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        &nbsp;
                                        <select name="project_st[]" class="js-example-basic-single"
                                            data-placeholder="Pilih Nama Project" style=" width: 25%">
                                            <option></option>
                                            @foreach ($aliases as $item)
                                                <option value="{{ $item->aliases }}">{{ $item->aliases }}</option>
                                            @endforeach
                                        </select>
                                        &nbsp;
                                        <input type="text" style="width: 20%" name='nom_st[]' 
                                            value={{ $nominal_project[0]->nominal }} readonly hidden>
                                        &nbsp;
                                        <input type="number" name='jam_st[]' step="0.001" style="width: 20%"
                                            placeholder="Jam" id="jam_st_${no}">
  </td>
  <td></td>
  <td class="text-center">
    <select name="kurs_st[]"
                                            style="text-align: center; justify-items: center; width: 100%"
                                            class="js-example-basic-single">
                                            @foreach ($kurs as $item)
                                                <option value="{{ $item->mata_uang }}"
                                                    {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>
                                                    {{ $item->mata_uang }}</option>
                                            @endforeach
                                        </select>
  </td>
  <td>
    <button name="delete${no}" id="delete${no}" onclick="deleteRow(this);" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i></button>
  </td>
`;


            // Tambahkan <tr> baru ke dalam tabel
            project.appendChild(newRow);


            $(newRow).find('.js-example-basic-single').select2();
        }




        function deleteRow(button) {
            // Dapatkan elemen induk dari tombol yang diklik (yaitu <tr>)
            let row = button.parentNode.parentNode;

            // Dapatkan elemen tabel yang berisi baris yang ingin dihapus
            let table = row.parentNode;

            // Hapus baris dari tabel
            table.removeChild(row);
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitBtn = document.getElementById('submitBtn');
            const submitActionInput = document.querySelector('input[name="submitAction"]');
            submitBtn.addEventListener('click', function() {
                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: 'Do you want to submit?',
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitActionInput.value = 'true'; // Isi nilai input tersembunyi
                        document.getElementById('formId').submit();
                    }
                });
            });
        });
    </script>





</body>

</html>
