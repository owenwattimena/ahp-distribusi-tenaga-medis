<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    {{-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>SILASKAR | Rekap Permintaan ATK</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 12px !important;
        }

        .logo {
            width: 80px;
            margin-right: 10px;
            box-sizing: border-box;
        }

        hr {
            border-top: 3px solid black;
        }

        h1 {
            font-weight: bold;
        }

        #table,
        #table th,
        #table td {
            border: 1px solid black !important;
        }

        .border-hide {
            border-left-color: white !important;
            border-bottom-color: white !important;
        }

        #sign,
        #sign th,
        #sign td {
            border: 1px solid white !important;
        }

    </style>
</head>

<body class="py-5">
    <header class="text-center">
        <table class="mx-auto" style="border:none">
            <tr>
                <td>
                    <img class="logo" src="http://bkd.malukuprov.go.id/img/logo%20maluku.png" alt="Logo Kota Ambon">
                </td>
                <td>
                    <h1 class="text-center">PEMERINTAH PROVINSI MALUKU</h1>
                    <h1 class="text-center">BADAN KEPEGAWAIAN DAERAH PROVINSI MALUKU</h1>
                    <h3 class="text-center">Jl. Raya Pattimura No. 1 Ambon, Maluku, 97124</h3>
                    <h3 class="text-center">Telp: (0911)-352183, Fax: (0911)-352183</h3>
                    <h3 class="text-center">email: bkd.promal@yahoo.co.id.</h3>
                </td>
            </tr>
        </table>
    </header>
    <hr>

    <h1 class="text-center">LAPORAN DISTRIBUSI TENAGA MEDIS</h1>
    <h2 class="text-center">{{ $puskesmas->nama }}</h2>

    <table id="table" class="mt-5 table-sm mb-5" width="100%">
        <thead>
            <tr class="text-center">
                <th scope="col">Ranking</th>
                <th scope="col">Alternatif</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody class="border-hide">
            @php
                $no = 0;
            @endphp
            @forelse ($result as $item)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $item['alternatif'] }}</td>
                    <td>{{ $item['rank'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <table id="table" class="mt-5 table-sm mb-5" width="100%">
        <thead>
            <tr>
                <th>Tahun</th>
                @foreach ($alternatif as $item)
                    <th>{{ $item->alternatif }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="border-hide">
            @forelse ($rekap as $item)
                <tr>
                    <td>{{ $item->tahun }}</td>
                    @foreach ($detailRekap->where('id_rekap_distribusi', $item->id) as $item)
                        <td>{{ $item->jumlah }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($alternatif) + 1 }}">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <table id="table" class="mt-5 table-sm mb-5" width="100%">
        <thead>
            <tr>
                <th>NIK</th>
                <th>NAMA</th>
                <th>NIP</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Status</th>
                <th>Jenis Kelamin</th>
                <th>Jenis Tenaga</th>
                <th>Nomor STR</th>
                <th>Masa Berlaku STR</th>
                <th>SIP</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 0;
            @endphp


            @forelse ($tenagaMedis as $item)
                <tr>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->tanggal_lahir }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $item->alternatif->alternatif }}</td>
                    <td>{{ $item->nomor_str }}</td>
                    <td>{{ $item->tanggal_awal_str }} s/d {{ $item->tanggal_akhir_str }}</td>
                    <td>{{ $item->sip }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
