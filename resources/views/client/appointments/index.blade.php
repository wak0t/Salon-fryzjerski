@extends('layouts.app')

@section('content')
    <h1>Twoje Wizyty</h1>
    <a href="{{ route('client.appointments.create') }}">Umów nową wizytę</a>
    <ul>
        @foreach ($appointments as $appointment)
            <li>
                Wizyta: {{ $appointment->service->name }} 
                | Data: {{ $appointment->appointment_date }}
                <a href="{{ route('client.appointments.edit', $appointment) }}">Edytuj</a>
                <form action="{{ route('client.appointments.destroy', $appointment) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Usuń</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
