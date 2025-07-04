@extends('admin.layout')


@section('adminsection')
<br>

{{-- <h1>Kampus</h1> --}}




@livewire('AddKampus', ['id_prodi' => $id_prodi, 'id_kampus' => $id_kampus])
    
@endsection