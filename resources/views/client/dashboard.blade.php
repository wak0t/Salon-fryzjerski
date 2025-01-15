@extends('layouts.app')

@section('content')
    <h1>Panel Klienta</h1>
    <p>Witaj, {{ Auth::user()->name }}!</p>
    <a href="{{ route('client.appointments') }}">Zarządzaj wizytami</a>
@endsection
