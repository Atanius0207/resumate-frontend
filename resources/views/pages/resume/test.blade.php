<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Resume</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #111;
        }

        .page {
            width: 794px; /* A4 width */
            margin: auto;
            padding: 40px;
        }

        h1 {
            letter-spacing: 2px;
            color: #777;
        }

        .section {
            margin-top: 30px;
        }

        .section-title {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .photo {
            width: 160px;
            height: 200px;
            border-radius: 10px;
            overflow: hidden;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .two-col {
            display: grid;
            grid-template-columns: 200px auto;
            row-gap: 8px;
        }
    </style>
</head>

<body>
<div class="page">

    {{-- HEADER --}}
    <div class="row">
        <div>
            <h1>RIWAYAT HIDUP</h1>

            <div class="section">
                <div class="section-title">DATA PRIBADI</div>
                <div class="two-col">
                    <div>Nama</div><div>: {{ $data['nama'] }}</div>
                    <div>TTL</div><div>: {{ $data['ttl'] }}</div>
                    <div>Jenis Kelamin</div><div>: {{ $data['jk'] }}</div>
                    <div>Agama</div><div>: {{ $data['agama'] }}</div>
                    <div>Alamat</div><div>: {{ $data['alamat'] }}</div>
                    <div>Telepon</div><div>: {{ $data['telepon'] }}</div>
                    <div>Email</div><div>: {{ $data['email'] }}</div>
                </div>
            </div>
        </div>

        {{-- FOTO --}}
        <div class="photo">
            <img src="{{ $data['foto'] ?? asset('default.jpg') }}">
        </div>
    </div>

    {{-- RIWAYAT PENDIDIKAN --}}
    <div class="section">
        <div class="section-title">RIWAYAT PENDIDIKAN</div>
        @foreach($data['pendidikan'] as $edu)
            <div class="row">
                <div>{{ $edu['nama'] }}</div>
                <div>{{ $edu['tahun'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- ORGANISASI --}}
    <div class="section">
        <div class="section-title">PENGALAMAN ORGANISASI</div>
        @foreach($data['organisasi'] as $org)
            <div class="row">
                <div>{{ $org['jabatan'] }}</div>
                <div>{{ $org['tempat'] }}</div>
                <div>{{ $org['tahun'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- KERJA --}}
    <div class="section">
        <div class="section-title">PENGALAMAN KERJA</div>
        @foreach($data['kerja'] as $job)
            <div class="row">
                <div>{{ $job['posisi'] }}</div>
                <div>{{ $job['perusahaan'] }}</div>
                <div>{{ $job['tahun'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- KEMAMPUAN --}}
    <div class="section">
        <div class="section-title">KEMAMPUAN</div>
        <ul>
            @foreach($data['skill'] as $skill)
                <li>{{ $skill }}</li>
            @endforeach
        </ul>
    </div>

</div>
</body>
</html>
