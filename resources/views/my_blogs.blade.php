@extends('layout')

@section('title', 'Мої записи')

@section('header')
    Мої Записи
@endsection
@section('content')
    <h2>Ваші Записи</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Створити Новий запис</a>
    @if($blogs->isEmpty())
        <p>У вас немає створених записів.</p>
    @else
        <ul>
        @foreach($blogs as $blog)
        <li>
            <strong>{{ $blog->title }}</strong> 
            <p><strong>Дата/час створення/оновлення:</strong> {{ $blog->created_or_updated_at->format('d.m.Y H:i') }}</p>
            <div>
                <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info btn-sm">Деталі</a>
                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Редагувати</a>
                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити блог?')">Видалити</button>
                </form>
            </div>
        </li>
    @endforeach
        </ul>
    @endif
@endsection
