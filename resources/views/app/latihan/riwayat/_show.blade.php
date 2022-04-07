@extends('layouts.app.main')

@section('title', ' | Detail Riwayat Latihan')

@section('content')
<h3 class="text-gray-700 text-3xl font-medium">Detail Riwayat Latihan</h3>
<div class="container bg-white p-10 my-10">
    <div class="w-full inline-block">
        <h3 class="text-xl font-bold">Paket Soal : {{ $paketsoal->name }}</h3>
        <h4 class="text-lg font-bold">Waktu Test : {{ $latihan->start_at->format('d M Y H:i:s') }} </h4>
        <p>Lama Pengerjaan : {{ $stats['lamaPengerjaan'] }}</p>
        <p>Jumlah Soal : {{ $stats['jumlahSoal'] }}</p>
        <p>Tidak Menjawab : {{ $stats['tidakJawab'] }}</p>
        <p>Soal Terjawab : {{ $stats['soalTerjawab'] }}</p>
        <p>Benar : {{ $stats['benarJawab'] }}</p>
        <p>Salah : {{ $stats['salahJawab'] }}</p>
        <p>Kecepatan Menjawab : {{ $stats['kecepatan'] }}</p>
        <p>Nilai : {{ $stats['nilai'] }}</p>
    </div>
</div>
@endsection

<!-- Your Custom Javascript -->
@section('_inJs')
{{-- @include('app.latihan.riwayat._inJs') --}}
@endsection
<!-- /Your Custom Javascript -->