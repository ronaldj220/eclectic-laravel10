<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Finance) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>



<body>
    <!-- Begin Page Content -->
    <div class="container" style="margin-right: 60px; margin-top: -12px">

        @if ($reimbursement->halaman == 'RB')
            <div class="container">
                <table class="table is-striped table-borderless border-dark"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                    <?php $no = 1; ?>
                    @foreach ($rb_detail as $index => $item)
                        @if ($index % 3 == 0)
                            <tr>
                        @endif
                        <td class="text-center">
                            <p>{{ $no++ . '.' }}</p>
                            @if (Auth::user()->jabatan == 'Admin')
                                <div class="image-container">
                                    <img src="{{ asset('bukti_reim/' . $item->bukti_reim) }}" alt=""
                                        style="max-width: 110%">
                                </div>
                            @elseif (Auth::guard('karyawan')->user()->jabatan == 'Konsultan')
                                <div class="image-container">
                                    <img src="{{ asset('bukti_reim/' . $item->bukti_reim) }}" alt=""
                                        style="max-width: 110%">
                                </div>
                            @endif

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
                        @if (($index + 1) % 3 == 0 || $index == count($rb_detail) - 1)
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>

        @endif
        <div class="d-flex justify-content-center" style="margin-top: -25px">
            <a href="{{ route('kasir.reimbursement') }}" class="btn btn-danger"><i
                    class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>

        </div>
        <br>
    </div>
    <!-- /.container-fluid -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>


</html>
