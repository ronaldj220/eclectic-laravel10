<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Direksi) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>

<body>
    <!-- Begin Page Content -->
    <div class="container" style="margin-right: 60px; ">
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
            <b><a style="text-transform: uppercase;">cash advance report</a></b>
            <br>
            <a style="text-transform: capitalize;">PT. Eclectic Consulting</a>
        </figure>
        <table class="table table-borderless table-sm"
            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 12px">
            <tr>
                <td>No<br>Tanggal</td>
                <td>: {{ $cash_advance_report->no_doku }}<br>:
                    {{ date('d.m.Y', strtotime($cash_advance_report->tgl_diajukan)) }}
                </td>
            </tr>
        </table>
        <form action="">

        </form>
        <table class="table is-striped table-bordered border-dark table-sm"
            style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
            <thead>
                <tr>
                    <th class="text-center" style="width: 3%">No.</th>
                    <th class="text-center" style="width: 50%">Keterangan</th>
                    <th class="text-center" style="width: 15%;">No. Bukti</th>
                    <th class="text-center" style="width: 5%">Curr</th>
                    <th class="text-center" style="width: 12%">Nominal</th>
                </tr>
                <!-- table title --->
                <tr>
                    <th class="text-center " style="width: 100%; text-transform:capitalize;" colspan="5">
                        {{ $cash_advance_report->judul_doku }}</th>
                </tr>
            </thead>
            <!-- Details -->
            <?php $no = 1; ?>
            @foreach ($data_CAR as $item)
                <tr>
                    <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                    </td>
                    <td style="text-transform:capitalize;">{{ $item->deskripsi }}
                        {{ date('d/m/Y', strtotime($item->tanggal_1)) }}
                    </td>
                    <td class="text-center" style="max-width: 12%; word-break: break-all;">
                        {{ $item->no_bukti }}</td>
                    <td class="text-center" style="max-width: 5%;">{{ $item->curr }}
                    </td>
                    <td class="text-end">
                        {{ number_format($item->nominal, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            <!-- Total Price -->
            <tr style="font-weight: bold">
                <td colspan="3" class="text-end">Jumlah</td>
                <td class="text-center">{{ $item->curr }}</td>
                <td class="text-end">{{ number_format($nominal, 0, ',', '.') }}</td>
            </tr>
            <tr style="font-weight: bold">
                <td colspan="3" class="text-end">Cash Advance {{ $cash_advance_report->tipe_ca }}</td>
                <td class="text-center">{{ $item->curr }}</td>
                <td class="text-end">{{ number_format($cash_advance_report->nominal_ca, 0, ',', '.') }}</td>
            </tr>
            @if ($nominal < $cash_advance_report->nominal_ca)
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Lebih</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">
                        {{ number_format(abs($nominal - $cash_advance_report->nominal_ca), 0, ',', '.') }}</td>
                </tr>
            @elseif ($nominal > $cash_advance_report->nominal_ca)
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end" style="color: red">Kurang</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">
                        {{ number_format(abs($nominal - $cash_advance_report->nominal_ca), 0, ',', '.') }}</td>
                </tr>
            @elseif ($nominal = $cash_advance_report->nominal_ca)
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end" style="color: black">Kurang</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">
                        {{ number_format(abs($nominal - $cash_advance_report->nominal_ca), 0, ',', '.') }}</td>
                </tr>
            @endif
        </table>

        <div class="container  text-center">
            <div class="row gx-5">
                <div class="col">
                    <div class="p-3">

                    </div>
                </div>
                <div class="col" style="margin-right: -28px; margin-top: -30px;">
                    <div class="p-3">
                        <table class="table is-striped table-bordered border-dark text-center"
                            style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                            <tr>

                                <td style="width: 50%; text-align: center; ">
                                    <div style="font-weight: bold;">Pembuat,</div>
                                    <div style="margin-top: 60px"></div>
                                    <div style="text-align: center; margin-top: -3px;">
                                        {{ $cash_advance_report->pemohon }}</div>
                                </td>
                                <td style="width: 50%; text-align: center;">
                                    <div style="font-weight: bold;">Menyetujui,</div>
                                    <div style="margin-top: 60px"></div>
                                    <div style="text-align: center; margin-top: -3px;">
                                        {{ $cash_advance_report->menyetujui }}</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="margin-top: 5px">

            @if ($cash_advance_report->status_approved == 'pending')
                <a href="{{ route('direksi.cash_advance_report.setujui_cash_advance_report', $cash_advance_report->id) }}"
                    class="btn btn-primary"><i class="fa-solid fa-square-check fa-beat"></i>&nbsp;Setujui</a>
                &nbsp; &nbsp;
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                        class="fa-solid fa-xmark fa-beat"></i>&nbsp;
                    Tolak
                </button>
                &nbsp; &nbsp;
                <a href="{{ route('direksi.cash_advance_report') }}" class="btn btn-danger"><i
                        class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
            @elseif ($cash_advance_report->status_approved == 'approved')
                <a href="{{ route('direksi.cash_advance_report') }}" class="btn btn-danger"><i
                        class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
            @endif
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Alasan Penolakan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form
                            action="{{ route('direksi.cash_advance_report.tolak_cash_advance_report', $cash_advance_report->id) }}"
                            method="POST">
                            @csrf
                            <textarea name="alasan" class="form-control"></textarea>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <br>


    <!-- /.container-fluid -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
