<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eclectic (Admin) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="icon" href="{{ asset('logo.png') }}">
</head>

<body>
    <form action="{{ route('admin.cash_advance.setujui_cash_advance', $cash_advance->id) }}" method="POST">
        @csrf
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
                    <td>
                        {{ $cash_advance->judul_doku }}
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

            <div style="margin-top: 10px">
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                    <tr style="height:2cm;">
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
            @if ($cash_advance->status_approved == 'approved' && $cash_advance->status_paid == 'pending')
                <div class="container" style="margin-top: -15px">
                    <div class="row">
                        <div class="col">
                        </div>
                        @if ($cash_advance->menyetujui == 'Aris')
                            <div class="col">
                            </div>
                        @else
                            <div class="col">
                                <table class="table table-borderless table-sm"
                                    style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 415px; margin-right: -10px;">
                                    <tr class="text-center">
                                        <td>Approved on {{ date('d/m/Y', strtotime($cash_advance->tgl_approval)) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @elseif ($cash_advance->status_approved == 'approved' && $cash_advance->status_paid == 'paid')
                <div class="container" style="margin-top: -15px">
                    <div class="row">
                        <div class="col">
                        </div>
                        @if ($cash_advance->menyetujui == 'Aris')
                            <div class="col">
                            </div>
                        @else
                            <div class="col">
                                <table class="table table-borderless table-sm"
                                    style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 320px; margin-right: -70px;">
                                    <tr class="text-center">
                                        <td>Paid on {{ date('d/m/Y', strtotime($cash_advance->tgl_bayar)) }} <br>
                                            ({{ $cash_advance->no_referensi }})
                                        </td>
                                    </tr>
                                </table>
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
                        @endif
                    </div>
                </div>
            @elseif ($cash_advance->status_approved == 'rejected' && $cash_advance->status_paid == 'rejected')
                @if ($cash_advance->menyetujui == 'Aris')
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.cash_advance.setujui_CA', $cash_advance->id) }}"
                            class="btn btn-primary"><i class="fa-solid fa-square-check fa-beat"></i>&nbsp;Verify
                        </a>
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
                                        <form action="{{ route('admin.cash_advance.tolak_CA', $cash_advance->id) }}"
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
                    </div>
                @else
                    <div class="d-flex justify-content-center">
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
                                        <form action="{{ route('admin.cash_advance.tolak_CA', $cash_advance->id) }}"
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
                    </div>
                @endif

            @endif
        </div>
    </form>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

</html>
