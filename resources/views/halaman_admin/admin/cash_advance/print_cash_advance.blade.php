<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Admin) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">

</head>

<body onload="window.print()">
    <!-- Begin Page Content -->
    <div class="container" style="margin-right: 60px; ">
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">cash advance</a></b>
            <br>
            <a style="text-transform: capitalize;">PT. Eclectic Consulting</a>
        </figure>
        <table class="table table-borderless table-sm"
            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: -5px;">
            <tr>
                <td>No<br>Tanggal</td>
                <td>: {{ $cash_advance->no_doku }}<br>: {{ date('d.m.Y', strtotime($cash_advance->tgl_diajukan)) }}
                </td>
            </tr>
        </table>

        <table class="table is-striped table-bordered border-dark table-sm"
            style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
            <thead>
                <tr>
                    <th class="text-center" style="width: 3%">No.</th>
                    <th class="text-center" style="width: 50%">Keterangan</th>
                    <th class="text-center" style="width: 15%;">No. Bukti</th>
                    <th class="text-center" style="width: 5%">Curr</th>
                    <th class="text-center" style="width: 12%">Nominal</th>
                </tr>
                <!-- table title --->

            </thead>
            <!-- Details -->
            <?php $no = 1; ?>
            <tr>
                <td class="text-center">{{ $no++ . '.' }}</td>
                <td>{{ $cash_advance->judul_doku }}</td>
                <td></td>
                <td class="text-center">{{ $cash_advance->curr }}</td>
                <td class="text-end">{{ number_format($nominal, 0, ',', '.') }}</td>
            </tr>
            <!-- Total Price -->
            <tr style="font-weight: bold">
                <td colspan="3" class="text-end">Jumlah</td>
                <td class="text-center">{{ $cash_advance->curr }}</td>
                <td class="text-end">{{ number_format($nominal, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div>
            <table class="table is-striped table-bordered border-dark text-center"
                style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                <tr style="height:2cm;">
                    <td style="width:25%">
                        <div class="center" style="font-weight: bold">Pemohon,</div>
                        <div style="margin-top: 40px"></div>
                        <div class="center">{{ $cash_advance->pemohon }}</div>
                    </td>
                    <td style="width:25%">
                        <div class="center" style="font-weight: bold">Accounting,</div>
                        <div style="margin-top: 40px"></div>
                        <div class="center">{{ $cash_advance->accounting }}</div>
                    </td>
                    <td style="width:25%">
                        <div class="center" style="font-weight: bold">Kasir,</div>
                        <div style="margin-top: 40px"></div>
                        <div class="center">{{ $cash_advance->kasir }}</div>
                    </td>
                    <td style="width:25%">
                        <div class="center" style="font-weight: bold">Menyetujui,</div>
                        <div style="margin-top: 40px"></div>
                        <div class="center">{{ $cash_advance->menyetujui }}</div>
                    </td>
                </tr>
            </table>
        </div>
        @if ($cash_advance->status_approved == 'approved' && $cash_advance->status_paid == 'pending')
            <div class="container" style="margin-top: -20px">
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col">
                        <table class="table table-borderless table-sm"
                            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 200px; margin-right: -10px;">
                            <tr class="text-center">
                                <td>Approved on {{ date('d/m/Y', strtotime($cash_advance->tgl_approval)) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
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

            #ttdImage {
                width: 125px;
                margin-right: -30px;
                /* Sesuaikan ukuran gambar sesuai kebutuhan */
                margin-top: 55px
            }

            #ttdImage2 {
                width: 125px;
                margin-right: -30px;
                /* Sesuaikan ukuran gambar sesuai kebutuhan */
                margin-top: 50px
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

        table {
            page-break-inside: auto;
            page-break-after: auto;
            position: relative;
        }
    </style>
    <!-- /.container-fluid -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
