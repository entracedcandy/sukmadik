@extends('admin.layout')


@section('adminsection')
    

@livewire('AddProdi', ['id_prodi' => $id_prodi, 'id_kampus' => $id_kampus])
@endsection