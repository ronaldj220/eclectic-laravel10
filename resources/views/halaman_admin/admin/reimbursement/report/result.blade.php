<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Admin) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="margin-right: 60px">
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">reimbursement</a></b>
            <br>
            <b><a style="text-transform: uppercase;">PT. Eclectic Consulting</a></b>
            <br>
            <b><a style="text-transform: uppercase">{{ date('d.m.Y', strtotime($tgl_awal)) }}</a> - <a
                    style="text-transform: uppercase">{{ date('d.m.Y', strtotime($tgl_akhir)) }}</a></b>
        </figure>
        <table class="table table-borderless table-sm"
            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: -5px;">
            @foreach ($reimbursement as $no_doku_real => $items)
                <tr>
                    <td>No <br>Tanggal</td>
                    <td>
                        : {{ $no_doku_real }}<br>
                        : {{ date('d.m.Y', strtotime($items[0]->tgl_diajukan)) }}
                    </td>
                </tr>
                <!-- Detail row -->
                <table class="table is-striped table-bordered border-dark table-sm"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 6%">No.</th>
                            <th class="text-center" style="width: 50%; margin-right: -20px;">Keterangan</th>
                            <th class="text-center" style="width: 25%;">No. Bukti</th>
                            <th class="text-center" style="width: 5%">Curr</th>
                            <th class="text-center" style="width: 12%">Nominal</th>

                        </tr>
                    </thead>
                </table>
            @endforeach
        </table>









    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
