@extends('layout')

@section('title', 'Додати запис')

@section('header')
    Додати Новий запис
@endsection

@section('content')
    <h2>Форма для Додавання запису</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('blogs.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">Опис</label>
            <textarea id="content" name="content" class="form-control" rows="4" required></textarea>
        </div>


        <button type="submit" class="btn btn-primary">Додати запис</button>
        <a href="{{ route('my.blogs') }}" class="btn btn-secondary">Скасувати</a>
    </form>
@endsection
