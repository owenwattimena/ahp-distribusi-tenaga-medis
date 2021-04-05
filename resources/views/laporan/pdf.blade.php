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

    <title>SPK SIGADIS | LAPORAN DISTRIBUSI TENAGA MEDIS</title>
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
                    <img class="logo"
                        src="data:image/jpeg;base64,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"
                        alt="Logo Kota Ambon">
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

    <p class="font-weight-bold">HASIL PERENGKINGAN AHP</p>
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
    <p class="font-weight-bold">JUMLAH KEBUTUHAN TENAGA MEDIS</p>
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
    <p class="font-weight-bold">DAFTAR TENAGA MEDIS</p>
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
