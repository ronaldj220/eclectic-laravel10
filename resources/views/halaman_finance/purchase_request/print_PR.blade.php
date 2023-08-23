<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eclectic (Finance) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">

</head>

<body onload="window.print()">
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
                    <th class="text-center" style="width: 20%">Nama Barang</th>
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
                            {{ date('d/m/y', strtotime($item->tgl_1)) }} - {{ date('d/m/y', strtotime($item->tgl_2)) }}
                        @elseif ($item->tgl_1)
                            {{ date('d/m/y', strtotime($item->tgl_1)) }}
                        @endif
                    </td>
                    <td class="text-center" style="max-width: 12%; word-break: break-all;">
                        @if (floor($item->jumlah) == $item->jumlah)
                            {{ number_format($item->jumlah, 0, ',', '.') }}
                        @else
                            {{ number_format($item->jumlah, 1, ',', '.') }}
                        @endif
                    </td>
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
        @if ($PR->status_approved == 'approved' && $PR->status_paid == 'pending')
            <div class="container" style="margin-top: -30px">
                <div class="row">
                    <div class="col">
                    </div>
                    @if ($PR->menyetujui == 'Aris')
                        <div class="col">
                        </div>
                    @else
                        <div class="col">
                            <table class="table table-borderless table-sm"
                                style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 225px; margin-right: -10px;">
                                <tr class="text-center">
                                    <td>Approved on {{ date('d/m/Y', strtotime($PR->tgl_approval)) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @elseif ($PR->status_approved == 'approved' && $PR->status_paid == 'paid')
            <div class="container" style="margin-top: -30px">
                <div class="row">
                    <div class="col">
                    </div>
                    @if ($PR->menyetujui == 'Aris')
                        <div class="col">
                        </div>
                    @else
                        <div class="col">
                            <table class="table table-borderless table-sm"
                                style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 225px; margin-right: -10px;">
                                <tr class="text-center">
                                    <td>Approved on {{ date('d/m/Y', strtotime($PR->tgl_approval)) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</body>
<style>
    @media print {
        #printPageButton {
            display: none;
        }

        #hidme {
            display: none;
        }

        #content {
            position: relative;
            display: table;
        }

        .container .row .col table {
            margin-right: 10px;
        }
    }

    @page {
        size: 21cm 16cm auto;
    }

    .printableArea {
        width: 10cm;
    }

    body {
        margin-left: 0.6cm;
        margin-right: 0.1cm;
        margin-top: -4px;
    }
</style>

</html>
