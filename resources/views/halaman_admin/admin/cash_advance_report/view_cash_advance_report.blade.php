<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eclectic (Admin) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>

<body>
    <form action="{{ route('admin.cash_advance_report.setujui_cash_advance_report', $cash_advance_report->id) }}"
        method="POST">
        @csrf
        <div class="container">
            <figure class="text-center"
                style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 10px;">
                <b><a style="text-transform: uppercase;">cash advance report</a></b>
                <br>
                <a style="text-transform: capitalize;">PT. Eclectic Consulting</a>
            </figure>
            <table class="table table-borderless table-sm"
                style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: -5px;">
                <tr>
                    <td>No<br>Tanggal</td>
                    <td>: {{ $cash_advance_report->no_doku }}<br>:
                        {{ date('d.m.Y', strtotime($cash_advance_report->tgl_diajukan)) }}
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
                    <tr>
                        <th class="text-center " style="width: 100%; text-transform:capitalize;" colspan="5">
                            {{ $cash_advance_report->judul_doku }}</th>
                    </tr>
                </thead>
                <!-- Details -->
                <?php $no = 1; ?>
                @foreach ($car_detail as $item)
                    <tr>
                        <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                        </td>
                        <td style="text-transform:capitalize;">{{ $item->deskripsi }}
                            @if ($item->tanggal_1 && $item->tanggal_2)
                                @php
                                    $tanggal1 = \Carbon\Carbon::parse($item->tanggal_1);
                                    $tanggal2 = \Carbon\Carbon::parse($item->tanggal_2);
                                    $selisihHari = $tanggal2->diffInDays($tanggal1);
                                @endphp
                                {{ date('d/m/y', strtotime($item->tanggal_1)) }} -
                                {{ date('d/m/y', strtotime($item->tanggal_2)) }}
                                @if ($item->keperluan)
                                    ({{ $item->keperluan }})
                                @endif
                            @elseif ($item->tanggal_1)
                                {{ date('d/m/y', strtotime($item->tanggal_1)) }}
                                @if ($item->keperluan)
                                    ({{ $item->keperluan }})
                                @endif
                            @endif
                        <td class="text-center" style="max-width: 12%; word-break: break-all;">
                            {{ $item->no_bukti }}</td>
                        <td class="text-center" style="max-width: 5%;">{{ $item->curr }}
                        </td>
                        <td class="text-end">
                            {{ number_format($item->nominal, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Jumlah</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">{{ number_format($nominal, 2, ',', '.') }}</td>
                </tr>
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Cash Advance {{ $cash_advance_report->tipe_ca }}</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">{{ number_format($cash_advance_report->nominal_ca, 2, ',', '.') }}</td>
                </tr>
                @if ($nominal < $cash_advance_report->nominal_ca)
                    <tr style="font-weight: bold">
                        <td colspan="3" class="text-end">Lebih</td>
                        <td class="text-center">{{ $item->curr }}</td>
                        <td class="text-end">
                            {{ number_format(abs($nominal - $cash_advance_report->nominal_ca), 2, ',', '.') }}</td>
                    </tr>
                @elseif ($nominal > $cash_advance_report->nominal_ca)
                    <tr style="font-weight: bold">
                        <td colspan="3" class="text-end" style="color: red">Kurang</td>
                        <td class="text-center" style="color: red">{{ $item->curr }}</td>
                        <td class="text-end" style="color: red">
                            {{ number_format(abs($nominal - $cash_advance_report->nominal_ca), 2, ',', '.') }}</td>
                    </tr>
                @elseif ($nominal = $cash_advance_report->nominal_ca)
                    <tr style="font-weight: bold">
                        <td colspan="3" class="text-end">Kurang</td>
                        <td class="text-center">{{ $item->curr }}</td>
                        <td class="text-end">
                            {{ number_format(abs($nominal - $cash_advance_report->nominal_ca), 2, ',', '.') }}</td>
                    </tr>
                @endif
            </table>
            <div class="container text-center">
                <div class="row gx-5">
                    <div class="col">

                    </div>
                    <div class="col" style="margin-right: -28px; margin-top: -30px;">
                        <div class="p-3">
                            <table class="table is-striped table-bordered border-dark text-center"
                                style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                                <tr>

                                    <td style="width: 50%; text-align: center; ">
                                        <div class="center" style="font-weight: bold">Pemohon,</div>
                                        <div style="margin-top: 40px"></div>
                                        <div class="center">{{ $cash_advance_report->pemohon }}</div>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <div class="center" style="font-weight: bold">Menyetujui,</div>
                                        <div style="margin-top: 40px"></div>
                                        <div class="center">{{ $cash_advance_report->menyetujui }}</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if ($cash_advance_report->status_approved == 'approved' && $cash_advance_report->status_paid == 'pending')
                <div class="container" style="margin-top: -30px">
                    <div class="row">
                        <div class="col">
                        </div>
                        @if ($cash_advance_report->menyetujui == 'Aris')
                            <div class="col">
                            </div>
                        @else
                            <div class="col">
                                <table class="table table-borderless table-sm"
                                    style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 430px; margin-right: -10px;">
                                    <tr class="text-center">
                                        <td>Approved on
                                            {{ date('d/m/Y', strtotime($cash_advance_report->tgl_persetujuan)) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    @if ($cash_advance_report->pemohon == 'Zhomi')
                        @if ($nominal < $cash_advance_report->nominal_ca)
                            <!-- Button trigger modal -->

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fa-solid fa-cash-register fa-beat"></i> &nbsp;
                                Bayar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Pembayaran
                                                CAR</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="{{ route('admin.cash_advance_report.paid_CAR', $cash_advance_report->id) }}"
                                                method="post">
                                                <input type="text" name="no_ref" class="form-control"
                                                    placeholder="Masukkan Nomor Referensi">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Bayar</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif

                    @endif

                </div>
            @elseif ($cash_advance_report->status_approved == 'approved' && $cash_advance_report->status_paid == 'paid')
                <div class="container" style="margin-top: -30px">
                    <div class="row">
                        <div class="col">
                        </div>
                        @if ($cash_advance_report->menyetujui == 'Aris')
                            <div class="col">
                            </div>
                        @else
                            <div class="col">
                                <table class="table table-borderless table-sm"
                                    style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-right: -150px; margin-left: 360px;">
                                    <tr class="text-center">
                                        <td>Paid on
                                            {{ date('d/m/Y', strtotime($cash_advance_report->tgl_bayar)) }} <br>
                                            ({{ $cash_advance_report->no_referensi }})
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table table-borderless table-sm"
                                    style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-right: -150px; margin-left: 220px;">
                                    <tr class="text-center">
                                        <td>Approved on
                                            {{ date('d/m/Y', strtotime($cash_advance_report->tgl_persetujuan)) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @elseif ($cash_advance_report->status_approved == 'rejected' && $cash_advance_report->status_paid == 'rejected')
                <div class="d-flex justify-content-center">
                    @if ($cash_advance_report->menyetujui == 'Aris')
                        <a href="{{ route('admin.cash_advance_report.setujui_CAR', $cash_advance_report->id) }}"
                            class="btn btn-primary"><i class="fa-solid fa-square-check fa-beat"></i>&nbsp;Verify</a>
                        &nbsp;
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="fa-solid fa-xmark fa-beat"></i>&nbsp;Tolak
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Alasan Penolakan</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            action="{{ route('admin.cash_advance_report.tolak_cash_advance_report', $cash_advance_report->id) }}"
                                            method="POST">
                                            @csrf
                                            <textarea name="alasan" class="form-control"></textarea>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Tolak</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <button class="btn btn-primary"><i
                                class="fa-solid fa-square-check fa-beat"></i>&nbsp;Verify</button>
                        &nbsp;
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="fa-solid fa-xmark fa-beat"></i>&nbsp;Tolak
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Alasan Penolakan</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            action="{{ route('admin.cash_advance_report.tolak_cash_advance_report', $cash_advance_report->id) }}"
                                            method="POST">
                                            @csrf
                                            <textarea name="alasan" class="form-control"></textarea>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Tolak</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </form>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</html>
