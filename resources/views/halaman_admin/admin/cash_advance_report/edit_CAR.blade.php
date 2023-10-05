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

                <div class="container">
                    <figure class="text-center"
                        style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 10px;">
                        <b><a style="text-transform: uppercase;">cash advance report</a></b>
                        <br>
                        <a style="text-transform: capitalize;">PT. Eclectic Consulting</a>
                    </figure>

                    <form action="{{ route('admin.cash_advance_report.update_CAR', $CAR->id) }}"
                        enctype="multipart/form-data" id="formId" method="POST">
                        @csrf
                        <input type="hidden" name=flag[] value='i'>
                        <input type="hidden" name="submitAction" value="true">
                        <table class="table table-borderless table-sm"
                            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin-left: -5px;">
                            <tr>
                                <td>No<br>Tanggal</td>
                                <td>: <input type="text" name="no_doku" value="{{ $CAR->no_doku }}" readonly><br>
                                    :<input type="text" name="tgl_diajukan" value="{{ $tgl_diajukan }}">
                                </td>
                            </tr>
                        </table>
                        <table class="table is-striped table-bordered border-dark table-sm"
                            style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin-top: -20px;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 6%">No.</th>
                                    <th class="text-center" style="width: 50%">Keterangan</th>
                                    <th class="text-center" style="width: 10%;">No. Bukti</th>
                                    <th class="text-center" style="width: 5%">Curr</th>
                                    <th class="text-center" style="width: 15%">Nominal</th>
                                </tr>

                                <!-- table title --->
                                <tr>
                                    <th class="text-center " style="width: 100%; text-transform:capitalize;"
                                        colspan="5">
                                        <input type="text" name="judul_doku"
                                            placeholder="Isikan Keterangan RB disini. Contoh: keperluan kantor, keperluan project ABC, keperluan tender ABC."
                                            style="width: 50%" value="{{ $CAR->judul_doku }}">
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="detail">
                                <?php $no = 1; ?>
                                @foreach ($CAR_detail as $item)
                                    <tr>
                                        <td class="text-center" style="max-width: 5%; text-align: center;">
                                            {{ $no++ . '.' }}</td>
                                        <td style="text-transform:capitalize;">
                                            <input type="hidden" name="id[]" value="{{ $item->id }}">
                                            <input type="hidden" name=flag[] value='u'>
                                            <input type="text" name="deskripsi[]"
                                                placeholder="Tuliskan deskripsi di kolom ini." style="width: 50%"
                                                value="{{ $item->deskripsi }}">
                                            &nbsp;
                                            <input type="text" name="project[]" placeholder="Isi Keperluan Project"
                                                style="width: 25%" value="{{ $item->keperluan }}"> &nbsp; <input
                                                type="file" name="foto[]" accept=".jpg, .png, .jpeg"
                                                style="width: 20%;">
                                            <br>
                                            <input type="date" name="tgl1[]" style="width:20%"
                                                value="{{ $item->tanggal_1 }}">
                                            &nbsp; s/d &nbsp;
                                            <input type="date" name="tgl2[]" style="width:23%"
                                                value="{{ $item->tanggal_2 }}">
                                            <span style="margin-left: 170px">Harus JPG atau PNG</span>
                                        </td>
                                        <td class="text-center" style="max-width: 5%;">
                                            <input type="text" name="nobu[]" placeholder="Nomor Bukti"
                                                style="text-align: center; width: 100%" value="{{ $item->no_bukti }}">
                                            Nomor Struk, Nota, Atau <i>Receipt</i>
                                        </td>
                                        <td class="text-end">
                                            <select name="kurs_rb[]" style="text-align: center;">
                                                <option value={{ $item->curr }}>{{ $item->curr }} </option>
                                                @foreach ($kurs as $KursItem)
                                                    <option value="{{ $KursItem->mata_uang }}"
                                                        {{ $KursItem->mata_uang == 'IDR' ? 'selected' : '' }}>
                                                        {{ $KursItem->mata_uang }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name='nom_rb[]' style="text-align:right; width: 100%"
                                                placeholder="Input Nominal" value="{{ $item->nominal }}"
                                                step="0.001">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tr>
                                <td colspan="3" class="text-right">Cash Advance &nbsp; <input type="text" readonly
                                        value="{{ $CAR->tipe_ca }}" name="tipe_ca"></td>
                                <td class="text-center">
                                    <select name="kurs_ca" style="text-align: center;">
                                        <option value={{ $item->curr }}>{{ $item->curr }} </option>
                                        @foreach ($kurs as $KursItem)
                                            <option value="{{ $KursItem->mata_uang }}"
                                                {{ $KursItem->mata_uang == 'IDR' ? 'selected' : '' }}>
                                                {{ $KursItem->mata_uang }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-right"><input type="text" value="{{ $CAR->nominal_ca }}"
                                        name="nominal_ca" style=" text-align: right;width: 100%" readonly></td>
                            </tr>
                        </table>
                        <a href="javascript:;" class="btn btn-info justify-content-between btn-sm"
                            onclick="addRB();">
                            <i class="fa-solid fa-circle-plus fa-bounce"></i>&nbsp;Add More</a>
                        <div style="margin-top: 30px;">
                            <table class="table is-striped table-bordered border-dark text-center"
                                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin-top: -20px;">
                                <tr>
                                    <td style="width:25%">
                                        <div class="text-center" style="font-weight: bold">Pemohon, &nbsp;
                                            <input type="text" value="{{ $CAR->pemohon }}" readonly
                                                name="pemohon">
                                        </div>
                                    </td>
                                    <td style="width:25%" hidden>
                                        <div class="text-center" style="font-weight: bold">Accounting, &nbsp;
                                            <input type="text" value="{{ $CAR->accounting }}" readonly
                                                name="accounting">
                                        </div>
                                    </td>
                                    <td style="width:25%" hidden>
                                        <div class="text-center" style="font-weight: bold">Kasir, &nbsp;
                                            <input type="text" value="{{ $CAR->kasir }}" readonly
                                                name="kasir">
                                        </div>
                                    </td>
                                    <td style="width:25%">
                                        <div class="text-center" style="font-weight: bold">Menyetujui, &nbsp;<select
                                                id="menyetujui" name="nama_menyetujui" style="text-align: center">
                                                <option value=""> --- Pilih --- </option>
                                                @foreach ($menyetujui as $item)
                                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width:25%" hidden>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                                value="{{ $CAR->no_telp }}" readonly>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center" style="margin-top: 20px">

                            <button type="button" class="btn btn-primary" id="submitBtn"><i
                                    class="fa-solid fa-floppy-disk fa-bounce"></i>&nbsp;Submit</button>

                        </div>
                    </form>
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
        let no = @json($count) + 1;

        function addRB() {
            var project = document.getElementById('detail');

            // Buat elemen <tr> baru untuk tabel
            var newRow = document.createElement('tr');

            // Isi konten untuk <tr> baru
            newRow.innerHTML = `
                <td class="text-center">${no++ + '.'}</td>
                <td style="text-transform:capitalize;">
                    <input type="text" name="deskripsi[]" placeholder="Tuliskan deskripsi di kolom ini." style="width: 50%">
                    &nbsp;
                    <input type="hidden" name=flag[] value='i'>
                    <input type="text" name="project[]" placeholder="Isi Keperluan Project" style="width: 25%">
                    &nbsp;
                    <input type="file" name="foto[]" accept=".jpg, .png, .jpeg" style="width: 20%;">
                    <br>
                    <input type="date" name="tgl1[]" style="width:20%">
                    &nbsp; s/d &nbsp;
                    <input type="date" name="tgl2[]" style="width:23%">
                    <span style="margin-left: 170px">Harus JPG atau PNG</span>
                </td>
                <td class="text-center">
                    <input type="text" name="nobu[]" placeholder="Nomor Bukti" style="text-align: center; width: 100%">
                    Nomor Struk, Nota, Atau <i>Receipt</i>
                </td>
                <td class="text-end">
                    <select name="kurs_rb[]" style="text-align: center;">
                        <option value=""> --- Pilih --- </option>
                        @foreach ($kurs as $item)
                            <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>
                                {{ $item->mata_uang }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name='nom_rb[]' style="text-align:right; width: 75%" placeholder="Input Nominal"> &nbsp; <button name="delete${no}" id="delete${no}" onclick="deleteRow(this);" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i></button>
                </td>
            `;

            // Tambahkan <tr> baru ke dalam tabel
            project.appendChild(newRow);
        }

        function deleteRow(button) {
            // Dapatkan elemen induk dari tombol yang diklik (yaitu <tr>)
            let row = button.parentNode.parentNode;

            // Dapatkan elemen tabel yang berisi baris yang ingin dihapus
            let table = row.parentNode;

            // Hapus baris dari tabel
            table.removeChild(row);
        }
    </script>

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
