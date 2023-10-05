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
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Purchase Order
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.purchase_order.simpan_PO') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No Dokumen</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="no_doku" value="{{ $no_dokumen }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tanggal Purchasing</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="tgl_diajukan" value="{{ date('d/m/Y') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor PR</label>
                                            <select class="form-control" name="tipe_pr" id="tipe_pr"
                                                onchange="updateFields()"
                                                data-url="{{ route('admin.getDetailByTipePR') }}">
                                                <option value=""> --- Pilih --- </option>
                                                @foreach ($tipe_pr as $item)
                                                    <option value="{{ $item->no_doku }}">{{ $item->no_doku }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Supplier</label>
                                            <select class="form-control" name="supplier" id="supplier"
                                                onchange="updateFields2()"
                                                data-url="{{ route('admin.getDataBySupplier') }}">
                                                <option value=""> --- Pilih --- </option>
                                                @foreach ($supplier as $item)
                                                    <option value="{{ $item->nama_supplier }}">
                                                        {{ $item->nama_supplier }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Pemohon</label>
                                            <input type="text" class="form-control" name="pemohon" id="pemohon"
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
                                            <input type="text" class="form-control" name="menyetujui" id="menyetujui"
                                                readonly>
                                        </div>
                                        <div class="form-text text-muted"
                                            style="font-size: 16px; font-family: Arial; color: red">
                                            * Aris (Keperluan Direksi) <br>
                                            * Sujiono (Keperluan Project) <br>
                                            * Yacob (Keperluan Office) <br>
                                            * Richard (Keperluan Marketing)
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex justify-content-center">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="VAT"
                                                        value="VAT" onchange="toggleTextbox('VATTextbox')">
                                                    <label class="form-check-label" for="VAT">PPN</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="PPh"
                                                        value="PPh" onchange="toggleTextbox('PPhTextbox')">
                                                    <label class="form-check-label" for="PPh">PPh</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="PPh4"
                                                        value="PPh_4" onchange="toggleTextbox('PPh4Textbox')">
                                                    <label class="form-check-label" for="PPh_4">PPh 4 Ayat
                                                        21</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="PPh21"
                                                        value="PPh21" onchange="toggleTextbox('PPh21Textbox')">
                                                    <label class="form-check-label" for="PPh_4">PPh 21</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="Diskon"
                                                        value="Diskon" onchange="toggleTextbox('DiskonTextbox')">
                                                    <label class="form-check-label" for="PPh_4">Diskon</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="Ctm"
                                                        value="Ctm" onchange="toggleTextbox('CtmTextbox')">
                                                    <label class="form-check-label" for="PPh_4">Lain-lain</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <div id="VATTextbox" style="display: none;">
                                                            <input type="text" id="VATInput" name="vat"
                                                                class="form-control" placeholder="Enter PPN value">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div id="PPhTextbox" style="display: none;">
                                                            <input type="text" id="PPhInput" name="pph"
                                                                class="form-control" placeholder="Enter PPh value">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div id="PPh4Textbox" style="display: none;">
                                                            <input type="text" id="PPh4Input" name="pph_4"
                                                                class="form-control"
                                                                placeholder="Enter PPh 4 Ayat 2 value">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div id="PPh21Textbox" style="display: none;">
                                                            <input type="text" id="PPh21Input" name="pph_21"
                                                                class="form-control" placeholder="Enter PPh 21 value">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div id="DiskonTextbox" style="display: none;">
                                                            <input type="text" id="PPh4Input" name="diskon"
                                                                class="form-control" placeholder="Enter diskon value">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div id="CtmTextbox" style="display: none;">
                                                            <input type="text" id="CtmInput" name="lain-lain"
                                                                class="form-control" placeholder="Lain-lain"> &nbsp;
                                                            <input type="number" id="CtmInput" name="lain-lain_nom"
                                                                class="form-control" placeholder="Enter Other Values">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <div id="detail"></div>
                                        </div>
                                        <div class="d-flex justify-content-center" style="margin-top: 20px">
                                            <a href="javascript:;" class="btn btn-info" id="add_pr"><i
                                                    class="fa-solid fa-circle-plus fa-bounce"></i>&nbsp;Tambah PO</a>
                                            &nbsp;&nbsp;
                                            <button type="submit" class="btn btn-primary"><i
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
        document.getElementById('add_pr').onclick = function() {
            let template =
                `<center>
                    <div class = 'container'>
                        <div class = 'row'>
                            <div class="col-md-12">
                              <div class="form-group">
                                  <label for="ket">Keterangan</label>
                                  <input type="text" class="form-control" name="ket[]" id="ket${i}" >
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                  <div class="form-row">
                                      <div class="col">
                                          <input type="number" class="form-control" placeholder="Jumlah" name="jum[]" id="jum${i}" step="0.001">
                                      </div>
                                      <div class="col">
                                          <input type="text" class="form-control" placeholder="Qty" name="qty[]" id="qty${i}" >
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                  <div class="form-row">
                                      <div class="col">
                                          <input type="date" class="form-control" name="tgl_1[]">
                                      </div>
                                      <div class="col">
                                          <input type="date" class="form-control" name="tgl_2[]">
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                  <div class="form-row">
                                      <div class="col">
                                        <select class="form-control" id="exampleFormControlSelect1" name="kurs[]">
                                            <option value=""> --- Pilih --- </option>
                                            @foreach ($kurs as $item)
                                                <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                      <div class="col">
                                        <input type="number" class="form-control" placeholder="Nominal" name="nom[]" step="0.001">
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
            var row = id.name.substring(id.name.length - 1, id.name.length);
            // Perform further actions with the retrieved `keterangan` value

            $('#delete' + row).closest('center').remove();
        }
    </script>
    <script>
        function updateFields() {
            var selectedTipePR = document.getElementById('tipe_pr').value;
            var url = document.getElementById('tipe_pr').getAttribute('data-url');

            // Buat permintaan AJAX ke endpoint getDataByPR
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url + '?tipe_pr=' + selectedTipePR, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var keteranganInputs = document.getElementsByName('ket[]');
                    var jumlahInputs = document.getElementsByName('jum[]');
                    var qtyInputs = document.getElementsByName('qty[]');
                    var tgl_1Inputs = document.getElementsByName('tgl_1[]');
                    var tgl_2Inputs = document.getElementsByName('tgl_2[]');
                    for (var i = 0; i < keteranganInputs.length; i++) {
                        var keterangan = response.keterangan[i];
                        var jumlah = response.jumlah[i];
                        var qty = response.qty[i];
                        var tgl_1 = response.tgl_1[i];
                        var tgl_2 = response.tgl_2[i];
                        keteranganInputs[i].value = keterangan;
                        jumlahInputs[i].value = jumlah;
                        qtyInputs[i].value = qty;
                        tgl_1Inputs[i].value = tgl_1;
                        tgl_2Inputs[i].value = tgl_2;
                    }
                } else if (xhr.readyState === 4) {
                    console.error('Request failed with status: ' + xhr.status);
                }
            };
            xhr.send();

        }

        function updateFields2() {
            var selectedSupplier = document.getElementById("supplier").value;
            var url = document.getElementById("supplier").getAttribute("data-url");

            // Lakukan permintaan AJAX ke endpoint getDataBySupplier
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        document.getElementById("pemohon").value = response.pemohon;
                        document.getElementById("menyetujui").value = response.menyetujui;
                    } else {
                        document.getElementById("pemohon").value = "";
                        document.getElementById("menyetujui").value = "";
                    }
                }
            };
            xhr.open("GET", url + "?supplier=" + selectedSupplier);
            xhr.send();
        }

        function toggleTextbox(elementId) {
            var checkbox = document.getElementById(elementId.replace("Textbox", ""));
            var textbox = document.getElementById(elementId);

            if (checkbox.checked) {
                textbox.style.display = "flex";
            } else {
                textbox.style.display = "none";
            }
        }
    </script>

</body>


</html>
