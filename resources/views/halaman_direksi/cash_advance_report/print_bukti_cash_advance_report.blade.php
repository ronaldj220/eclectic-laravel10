<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Direksi) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">

</head>



<body>
    <!-- Begin Page Content -->
    <div class="container" style="margin-right: 60px; margin-top: -12px">
        <div class="container">
            <table class="table is-striped table-borderless border-dark"
                style="font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
                <?php $no = 1; ?>
                @foreach ($bukti_CAR as $index => $item)
                    @if ($index % 3 == 0)
                        <tr>
                    @endif
                    <td class="text-center">
                        <p>{{ $no++ . '.' }}</p>
                        <div class="image-container">
                            <img src="{{ asset('bukti_CAR_admin/' . $item->bukti_ca) }}" alt=""
                                style="max-width: 110%">
                        </div>
                        <div class="text-container">
                            @if ($item->curr == 'IDR')
                                <p> Rp. {{ number_format($item->nominal, 0, ',', '.') }}
                                </p>
                            @elseif ($item->curr == 'USD')
                                <p>$ {{ number_format($item->nominal, 0, ',', '.') }}</p>
                            @elseif ($item->curr == 'SGD')
                                <p>$ {{ number_format($item->nominal, 0, ',', '.') }}</p>
                            @elseif ($item->curr == 'EUR')
                                <p>&euro;{{ number_format($item->nominal, 0, ',', '.') }}</p>
                            @endif


                        </div>
                    </td>
                    @if (($index + 1) % 3 == 0 || $index == count($bukti_CAR) - 1)
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>


        <br>
    </div>
    <!-- /.container-fluid -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>


</html>
