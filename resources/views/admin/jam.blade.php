@extends('admin.layout')


@section('adminsection')

    
@livewire('AddSesi', ['id_prodi' => $id_prodi, 'id_kampus' => $id_kampus])    
@endsection