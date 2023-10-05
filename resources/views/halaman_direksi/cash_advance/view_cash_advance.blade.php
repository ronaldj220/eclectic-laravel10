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
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">cash advance</a></b>
            <br>
            <a style="text-transform: capitalize;">PT. Eclectic Consulting</a>
        </figure>
        <table class="table table-borderless table-sm"
            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px">
            <tr>
                <td>No<br>Tanggal</td>
                <td>: {{ $cash_advance->no_doku }}<br>: {{ date('d.m.Y', strtotime($cash_advance->tgl_diajukan)) }}
                </td>
            </tr>
        </table>
        <form action="">
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
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
                    <td>{{ $cash_advance->judul_doku }}
                        @if ($cash_advance->tgl_diajukan && $cash_advance->tgl_diajukan2)
                            @php
                                $tanggal1 = \Carbon\Carbon::parse($cash_advance->tgl_diajukan);
                                $tanggal2 = \Carbon\Carbon::parse($cash_advance->tgl_diajukan2);
                                $selisihHari = $tanggal2->diffInDays($tanggal1);
                            @endphp
                            {{ date('d/m/Y', strtotime($cash_advance->tgl_diajukan)) }} -
                            {{ date('d/m/Y', strtotime($cash_advance->tgl_diajukan2)) }}\
                            ({{ $selisihHari }} hari)
                        @elseif ($cash_advance->tgl_diajukan)
                            {{ date('d/m/Y', strtotime($cash_advance->tgl_diajukan)) }}
                        @endif
                    </td>
                    <td></td>
                    <td class="text-center">{{ $cash_advance->curr }}</td>
                    <td class="text-end">{{ number_format($nominal, 2, ',', '.') }}</td>
                </tr>
                <!-- Total Price -->
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Jumlah</td>
                    <td class="text-center">{{ $cash_advance->curr }}</td>
                    <td class="text-end">{{ number_format($nominal, 2, ',', '.') }}</td>
                </tr>
            </table>

            <div>
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                    <tr style="height:3cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $cash_advance->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $cash_advance->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $cash_advance->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $cash_advance->menyetujui }}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="d-flex justify-content-center" style="margin-top: 20px">

                @if ($cash_advance->status_approved == 'pending')
                    <a href="{{ route('direksi.cash_advance.setujui_cash_advance', $cash_advance->id) }}"
                        class="btn btn-primary"><i class="fa-solid fa-square-check fa-beat"></i>&nbsp;Setujui</a>
                    &nbsp; &nbsp;
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"><i class="fa-solid fa-xmark fa-beat"></i>&nbsp;
                        Tolak
                    </button>
                    &nbsp; &nbsp;
                    <a href="{{ route('direksi.cash_advance') }}" class="btn btn-danger"><i
                            class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
                @elseif ($cash_advance->status_approved == 'approved' && $cash_advance->status_paid == 'pending')
                    <a href="{{ route('direksi.cash_advance') }}" class="btn btn-danger"><i
                            class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
                @elseif ($cash_advance->status_approved == 'rejected' && $cash_advance->status_paid == 'rejected')
                    <a href="{{ route('direksi.cash_advance') }}" class="btn btn-danger"><i
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
                            <form action="{{ route('direksi.cash_advance.tolak_cash_advance', $cash_advance->id) }}"
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
        </form>

    </div>

    <br>


    <!-- /.container-fluid -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
