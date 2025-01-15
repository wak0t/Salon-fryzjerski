@extends('layouts.app')

@section('title', 'Usługi')

@section('content')
<h1 class="mb-4">Lista Usług</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nazwa</th>
            <th>Cena</th>
            <th>Czas trwania</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($services as $service)
        <tr>
            <td>{{ $service->name }}</td>
            <td>{{ $service->price }} zł</td>
            <td>{{ $service->duration }} minut</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
