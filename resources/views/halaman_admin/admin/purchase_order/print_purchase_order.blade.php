@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eclectic (Admin) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">

</head>

<body onload="window.print()">
    <div class="container">
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">purchase order</a></b>
            <br>
            <b><a style="text-transform: capitalize;">pt. eclectic consulting</a></b>
        </figure>

        <table class="table table-borderless table-sm"
            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: -5px;">
            <tr>
                <td>Nomor PO<br>Supplier</td>
                <td>: {{ $PO->no_doku }}<br>:
                    {{ $PO->supplier }}
                </td>
            </tr>
        </table>
        <table class="table is-striped table-bordered border-dark table-sm"
            style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -15px;">
            <thead>
                <tr>
                    <th class="text-center" style="width: 6%">No.</th>
                    <th class="text-center" style="width: 50%">Keterangan</th>
                    <th class="text-center" style="width: 5%;" colspan="2">Qty</th>
                    <th class="text-center" style="width: 5%">Curr</th>
                    <th class="text-center td_PPN" style="width: 12%" hidden>VAT(11%)</th>
                    <th class="text-center td_PPN" style="width: 12%" hidden>PPh23(2%)</th>
                    <th class="text-center" style="width: 12%">Total Harga</th>
                </tr>
            </thead>
            <!-- Details -->
            <?php $no = 1; ?>
            @foreach ($PO_detail as $item)
                <tr>
                    <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}</td>
                    <td style="text-transform: capitalize;">{{ $item->judul }}
                        @if ($item->tgl_1 && $item->tgl_2)
                            {{ date('d/m/Y', strtotime($item->tgl_1)) }} -
                            {{ date('d/m/Y', strtotime($item->tgl_2)) }}
                        @elseif ($item->tgl_1)
                            {{ date('d/m/Y', strtotime($item->tgl_1)) }}
                        @endif
                    </td>
                    <td style="text-transform: capitalize; text-align: center">{{ $item->jumlah }}</td>
                    <td style="text-transform: capitalize; text-align: center">{{ $item->satuan }}</td>
                    <td style="text-transform: capitalize; text-align: center">
                        @if ($item->curr == 'IDR')
                            {{ $item->curr }}
                        @elseif ($item->curr == 'USD')
                            {{ $item->curr }}
                        @elseif ($item->curr == 'SGD')
                            {{ $item->curr }}
                        @elseif ($item->curr == 'EUR')
                            {{ $item->curr }}
                        @endif
                    </td>
                    <td style="text-transform: capitalize; text-align: right" class="item_PPN" hidden>
                        {{ number_format($PPN, 0, ',', '.') }}</td>
                    <td style="text-transform: capitalize; text-align: right" class="item_PPN" hidden>
                        {{ $item->PPH }}</td>
                    <td style="text-transform: capitalize; text-align: right">
                        @if ($item->curr == 'IDR')
                            {{ number_format($item->nominal, 0, ',', '.') }}
                        @elseif ($item->curr == 'USD')
                            {{ number_format($item->nominal, 2, ',', '.') }}
                        @elseif ($item->curr == 'SGD')
                            {{ number_format($item->nominal, 2, ',', '.') }}
                        @elseif ($item->curr == 'EUR')
                            {{ number_format($item->nominal, 2, ',', '.') }}
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr style="font-weight: bold" class="print_jumlah">
                <td colspan="4" class="text-end">Jumlah</td>
                <td class="text-center">
                    @if ($item->curr == 'IDR')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'USD')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'SGD')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'EUR')
                        {{ $item->curr }}
                    @endif
                </td>
                <td class="text-end">
                    @if ($item->curr == 'IDR')
                        {{ number_format($nominal, 0, ',', '.') }}
                    @elseif ($item->curr == 'USD')
                        {{ number_format($nominal, 2, ',', '.') }}
                    @elseif ($item->curr == 'SGD')
                        {{ number_format($nominal, 2, ',', '.') }}
                    @elseif ($item->curr == 'EUR')
                        {{ number_format($nominal, 2, ',', '.') }}
                    @endif
                </td>
            </tr>
            <tr style="font-weight: bold" class="print_jumlah">
                <td colspan="4" class="text-end">VAT (11%)</td>
                <td class="text-center">
                    @if ($item->curr == 'IDR')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'USD')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'SGD')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'EUR')
                        {{ $item->curr }}
                    @endif
                </td>
                <td class="text-end">
                    @if ($item->curr == 'IDR')
                        {{ number_format($PPN, 0, ',', '.') }}
                    @elseif ($item->curr == 'USD')
                        {{ number_format($PPN, 2, ',', '.') }}
                    @elseif ($item->curr == 'SGD')
                        {{ number_format($PPN, 2, ',', '.') }}
                    @elseif ($item->curr == 'EUR')
                        {{ number_format($PPN, 2, ',', '.') }}
                    @endif
                </td>
            </tr>
            <tr style="font-weight: bold" class="print_jumlah">
                <td colspan="4" class="text-end">PPh23 (2%)</td>
                <td class="text-center">
                    @if ($item->curr == 'IDR')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'USD')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'SGD')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'EUR')
                        {{ $item->curr }}
                    @endif
                </td>
                <td class="text-end "@if ($PPH != 0) style="color: red" @endif>
                    @if ($item->curr == 'IDR')
                        {{ number_format($PPH, 0, ',', '.') }}
                    @elseif ($item->curr == 'USD')
                        {{ number_format($PPH, 2, ',', '.') }}
                    @elseif ($item->curr == 'SGD')
                        {{ number_format($PPH, 2, ',', '.') }}
                    @elseif ($item->curr == 'EUR')
                        {{ number_format($PPH, 2, ',', '.') }}
                    @endif
                </td>
            </tr>
            <tr style="font-weight: bold" class="print_jumlah">
                <td colspan="4" class="text-end">PPh 4 (2)</td>
                <td class="text-center">
                    @if ($item->curr == 'IDR')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'USD')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'SGD')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'EUR')
                        {{ $item->curr }}
                    @endif
                </td>
                <td class="text-end "@if ($PPH_4 != 0) style="color: red" @endif>
                    @if ($item->curr == 'IDR')
                        {{ number_format($PPH_4, 0, ',', '.') }}
                    @elseif ($item->curr == 'USD')
                        {{ number_format($PPH_4, 2, ',', '.') }}
                    @elseif ($item->curr == 'SGD')
                        {{ number_format($PPH_4, 2, ',', '.') }}
                    @elseif ($item->curr == 'EUR')
                        {{ number_format($PPH_4, 2, ',', '.') }}
                    @endif
                </td>
            </tr>
            <tr style="font-weight: bold" class="print_jumlah">
                <td colspan="4" class="text-end">Grand Total</td>
                <td class="text-center">
                    @if ($item->curr == 'IDR')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'USD')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'SGD')
                        {{ $item->curr }}
                    @elseif ($item->curr == 'EUR')
                        {{ $item->curr }}
                    @endif
                </td>
                <td class="text-end">
                    @if ($item->curr == 'IDR')
                        {{ number_format($grand_total, 0, ',', '.') }}
                    @elseif ($item->curr == 'USD')
                        {{ number_format($grand_total, 2, ',', '.') }}
                    @elseif ($item->curr == 'SGD')
                        {{ number_format($grand_total, 2, ',', '.') }}
                    @elseif ($item->curr == 'EUR')
                        {{ number_format($grand_total, 2, ',', '.') }}
                    @endif
                </td>
            </tr>
        </table>
        <p style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; text-align: right; margin-top: -10px;">
            Surabaya,
            {{ $tgl_purchasing }}</p>
        <div style="margin-top: 20px">
            <table class="table is-striped table-bordered border-dark text-center"
                style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                <tr style="height:2cm;">
                    <td style="width:25%">
                        <div class="center" style="text-transform: uppercase">purchasing,</div>
                        <div style="margin-top: 40px"></div>
                        <div class="center">{{ $PO->pemohon }}</div>
                    </td>
                    <td style="width:25%">
                        <div class="center" style="text-transform: uppercase">accounting,</div>
                        <div style="margin-top: 40px"></div>
                        <div class="center">{{ $PO->accounting }}</div>
                    </td>
                    <td style="width:25%">
                        <div class="center" style="text-transform: uppercase">kasir,</div>
                        <div style="margin-top: 40px"></div>
                        <div class="center">{{ $PO->kasir }}</div>
                    </td>
                    <td style="width:25%">
                        <div class="center" style="text-transform: uppercase">menyetujui,</div>
                        <div style="margin-top: 40px"></div>
                        <div class="center">{{ $PO->menyetujui }}</div>
                    </td>
                </tr>
            </table>
        </div>
        @if ($PO->status_approved == 'approved' && $PO->status_paid == 'pending')
            <div class="container" style="margin-top: -16px">
                <div class="row">
                    <div class="col">
                    </div>
                    @if ($PO->menyetujui == 'Aris')
                        <div class="col">
                        </div>
                    @else
                        <div class="col">
                            <table class="table table-borderless table-sm"
                                style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 225px; margin-right: -10px;">
                                <tr class="text-center">
                                    <td>Approved on {{ date('d/m/Y', strtotime($PO->tgl_approval)) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @elseif ($PO->status_approved == 'approved' && $PO->status_paid == 'paid')
            <div class="container" style="margin-top: -16px">
                <div class="row">
                    <div class="col">
                    </div>
                    @if ($PO->menyetujui == 'Aris')
                        <div class="col">
                        </div>
                    @else
                        <div class="col">
                            <table class="table table-borderless table-sm"
                                style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 225px; margin-right: -10px;">
                                <tr class="text-center">
                                    <td>Approved on {{ date('d/m/Y', strtotime($PO->tgl_approval)) }}
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
        .print_jumlah td[colspan="4"] {
            grid-column: span 4 !important;
        }

        .td_PPN {
            display: none
        }

        .item_PPN {
            display: none
        }

        .print_jumlah td.colspan-6 {
            display: none;
        }
    }

    @media not print {
        .print_jumlah td[colspan="4"] {
            grid-column: span 6 !important;

        }

        .print_jumlah td.colspan-6 {
            grid-column: span 6 !important;
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
