@extends('layouts.app')

@section('title', 'Pracownicy')

@section('content')
<h1 class="mb-4">Lista Pracowników</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Imię</th>
            <th>Email</th>
            <th>Telefon</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
        <tr>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->phone }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
