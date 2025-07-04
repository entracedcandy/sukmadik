@extends('admin.layout')


@section('adminsection')
    
    
@livewire('AddMatkul', ['id_prodi' => $id_prodi, 'id_kampus' => $id_kampus])    
@endsection