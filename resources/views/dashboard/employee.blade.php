@extends('layouts.app')

@section('title', 'Emloyee Dashboard')

@section('content')
    <p class="text-3xl font-semibold mb-6">Welcome,
        <span class="text-orange-500">{{ Auth::user()->name }}</span>
    </p>
@endsection
