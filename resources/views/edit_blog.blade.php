@extends('layout')

@section('title', 'Редагування запису')

@section('header')
    Редагування запису
@endsection

@section('content')
    <h2>Редагування запису</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" class="form-control" required>
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Опис</label>
            <textarea id="content" name="content" class="form-control" required>{{ old('content', $blog->content) }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Редагувати</button>
    </form>

    <a href="{{ route('my.blogs') }}" class="btn btn-secondary mt-3">Повернутись до моїх записів</a>
@endsection
