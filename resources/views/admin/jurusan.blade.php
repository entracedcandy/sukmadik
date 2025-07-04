@extends('admin.layout')


@section('adminsection')
    {{-- <h1>Jurusan</h1> --}}
    
@livewire('AddJurusan', ['id_prodi' => $id_prodi, 'id_kampus' => $id_kampus])

@endsection