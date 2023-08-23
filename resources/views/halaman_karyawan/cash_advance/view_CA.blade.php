<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eclectic (Karyawan) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="margin-right: 60px">
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">cash advance</a></b>
            <br>
            <a style="text-transform: capitalize;">PT. Eclectic Consulting</a>
        </figure>
        <table class="table table-borderless table-sm"
            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: -5px;">
            <tr>
                <td>No<br>Tanggal</td>
                <td>: {{ $CA->no_doku }}<br>: {{ date('d.m.Y', strtotime($CA->tgl_diajukan)) }}
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
                    {{ $CA->judul_doku }}
                </td>
                <td></td>
                <td class="text-center">{{ $CA->curr }}</td>
                <td class="text-end">{{ number_format($nominal, 2, ',', '.') }}</td>
            </tr>
            <!-- Total Price -->
            <tr style="font-weight: bold">
                <td colspan="3" class="text-end">Jumlah</td>
                <td class="text-center">{{ $CA->curr }}</td>
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
                        <div class="center">{{ $CA->pemohon }}</div>
                    </td>
                    <td style="width:25%">
                        <div class="center" style="font-weight: bold">Accounting,</div>
                        <div style="margin-top: 70px"></div>
                        <div class="center">{{ $CA->accounting }}</div>
                    </td>
                    <td style="width:25%">
                        <div class="center" style="font-weight: bold">Kasir,</div>
                        <div style="margin-top: 70px"></div>
                        <div class="center">{{ $CA->kasir }}</div>
                    </td>
                    <td style="width:25%">
                        <div class="center" style="font-weight: bold">Menyetujui,</div>
                        <div style="margin-top: 70px"></div>
                        <div class="center">{{ $CA->menyetujui }}</div>
                    </td>
                </tr>
            </table>
        </div>
        @if ($CA->status_approved == 'approved' && $CA->status_paid == 'pending')
            <div class="container" style="margin-top: -15px">
                <div class="row">
                    <div class="col">
                    </div>
                    @if ($CA->menyetujui == 'Aris')
                        <div class="col">
                        </div>
                    @else
                        <div class="col">
                            <table class="table table-borderless table-sm"
                                style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 415px; margin-right: -10px;">
                                <tr class="text-center">
                                    <td>Approved on {{ date('d/m/Y', strtotime($CA->tgl_approval)) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @elseif ($CA->status_approved == 'approved' && $CA->status_paid == 'paid')
            <div class="container" style="margin-top: -15px">
                <div class="row">
                    <div class="col">
                    </div>
                    @if ($CA->menyetujui == 'Aris')
                        <div class="col">
                        </div>
                    @else
                        <div class="col">
                            <table class="table table-borderless table-sm"
                                style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 415px; margin-right: -10px;">
                                <tr class="text-center">
                                    <td>Approved on {{ date('d/m/Y', strtotime($CA->tgl_approval)) }}
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

</html>
