@extends('layout')

@section('title', 'Ваш Профіль')

@section('header')
    Ваш Профіль
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Інформація Профілю</h4>
            <p><strong>Логін:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Роль:</strong> {{ ucfirst($user->role) }}</p>

            <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Редагувати Профіль</a>
        </div>
    </div>
@endsection
