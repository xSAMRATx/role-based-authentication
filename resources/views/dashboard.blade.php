@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <p class="text-3xl font-semibold mb-6">Welcome,
        <span class="text-orange-500">{{ Auth::user()->name }}</span>
    </p>

    <p class="text-xl font-semibold mb-6">Your Role :
        <span class="text-blue-500">{{ Auth::user()->role->name }}</span>
    </p>
@endsection
