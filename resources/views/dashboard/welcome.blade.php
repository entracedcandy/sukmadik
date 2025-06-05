@extends('dashboard.layout')

@section('dashboardsection')

    @if($kampus)
        <h1>Selamat datang di {{ $kampus->nama_kampus }}</h1>
        {{-- Anda bisa menampilkan detail kampus lainnya di sini --}}
        <p>Alamat: {{ $kampus->alamat }}</p>
        {{-- dll --}}
    @else
        {{-- Kondisi ini seharusnya jarang terjadi jika validasi di controller bekerja --}}
        <h1>Silakan pilih kampus terlebih dahulu atau terjadi kesalahan.</h1>
    @endif

@endsection