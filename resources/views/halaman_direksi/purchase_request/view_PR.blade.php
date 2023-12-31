<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Direksi) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">permintaan pembelian</a></b>
            <br>
            <a style="text-transform: capitalize; font-weight: bold">no. PR: {{ $PR->no_doku }}</a>
        </figure>
        <figure class="text-end" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <b><a style="text-transform: capitalize;">tanggal</a></b>
            <b><a style="text-transform: capitalize;">: {{ date('d.m.Y', strtotime($PR->tgl_diajukan)) }}</a></b>
        </figure>
        <table class="table is-striped table-bordered border-dark table-sm"
            style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -15px;">
            <thead>
                <tr>
                    <th class="text-center" style="width: 3%">No.</th>
                    <th class="text-center" style="width: 30%">Nama Barang</th>
                    <th class="text-center" style="width: 5%;" colspan="2">Qty</th>
                    <th class="text-center" style="width: 5%">Tgl. Pakai</th>
                    <th class="text-center" style="width: 12%">Keterangan</th>
                </tr>
            </thead>
            <!-- Details -->
            <?php $no = 1; ?>
            @foreach ($PR_detail as $item)
                <tr>
                    <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}</td>
                    <td style="text-transform: capitalize">
                        {{ $item->judul }}
                        @if ($item->tgl_1 && $item->tgl_2)
                            {{ date('d/m/Y', strtotime($item->tgl_1)) }} -
                            {{ date('d/m/Y', strtotime($item->tgl_2)) }}
                        @elseif ($item->tgl_1)
                            {{ date('d/m/Y', strtotime($item->tgl_1)) }}
                        @endif
                    </td>
                    <td class="text-center" style="max-width: 12%; word-break: break-all;">
                        {{ $item->jumlah }}</td>
                    <td class="text-center" style="max-width: 12%; word-break: break-all;">
                        {{ $item->satuan }}</td>
                    <td class="text-center" style="max-width: 12%; word-break: break-all;">
                        {{ date('d/m/Y', strtotime($item->tgl_pakai)) }}</td>
                    <td class="text-justify" style="max-width: 12%; word-break: break-all;">
                        {{ $item->project }}</td>
                </tr>
            @endforeach
        </table>
        <div class="container  text-center" style="margin-top: 20px">
            <div class="row gx-5">
                <div class="col">
                    <div class="p-3">

                    </div>
                </div>
                <div class="col" style="margin-right: -28px; margin-top: -30px;">
                    <div class="p-3">
                        <table class="table is-striped table-bordered border-dark text-center"
                            style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                            <tr>

                                <td style="width: 50%; text-align: center; ">
                                    <div style="font-weight: bold;">Pembuat,</div>
                                    <div style="margin-top: 40px"></div>

                                    <div style="text-align: center; margin-top: -3px;">
                                        {{ $PR->pemohon }}</div>
                                </td>
                                <td style="width: 50%; text-align: center;">
                                    <div style="font-weight: bold;">Menyetujui,</div>
                                    <div style="margin-top: 40px"></div>

                                    <div style="text-align: center; margin-top: -3px;">
                                        {{ $PR->menyetujui }}</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 20px">

        @if ($PR->status_approved == 'pending' && $PR->status_paid == 'pending')
            @if ($PR->pemohon == Auth::guard('direksi')->user()->nama)
                <a href="{{ route('direksi.purchase_request') }}" class="btn btn-danger"><i
                        class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
            @elseif ($PR->menyetujui == Auth::guard('direksi')->user()->nama)
                <a href="{{ route('direksi.purchase_request.setujui_PR', $PR->id) }}" class="btn btn-primary"><i
                        class="fa-solid fa-square-check fa-beat"></i>&nbsp;Setujui</a>
                &nbsp; &nbsp;
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                        class="fa-solid fa-xmark fa-beat"></i>&nbsp;
                    Tolak
                </button>
                &nbsp; &nbsp;
                <a href="{{ route('direksi.purchase_request') }}" class="btn btn-danger"><i
                        class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
            @endif
        @elseif ($PR->status_approved == 'approved' && $PR->status_paid == 'pending')
            <a href="{{ route('direksi.purchase_request') }}" class="btn btn-danger"><i
                    class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
        @elseif ($PR->status_approved == 'rejected' && $PR->status_paid == 'rejected')
            <a href="{{ route('direksi.purchase_request') }}" class="btn btn-danger"><i
                    class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
        @endif
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Alasan Penolakan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('direksi.purchase_request.tolak_PR', $PR->id) }}" method="POST">
                        @csrf
                        <textarea name="alasan" class="form-control"></textarea>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-danger">Tolak</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
