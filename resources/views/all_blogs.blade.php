@extends('layout')
@section('title', 'Список Блогів')
@section('header')
    Список Блогів
@endsection

@section('content')
    <h2>Список всіх блогів</h2>
    <ul>
        @foreach($blogs as $blog)
            <li>
                <strong>{{ $blog->title }}</strong> 
                <br>
                <span>Автор: {{ $blog->author->name }}</span>
                <br>
                <span>Дата створення/редагування: {{ \Carbon\Carbon::parse($blog->created_or_updated_at)->format('d.m.Y H:i') }}</span>
                <br>
                <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info btn-sm">Деталі</a>

                @if(Auth::user() && Auth::user()->role === 'admin')
                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                    </form>
                @endif
            </li>
            <hr>
        @endforeach
    </ul>
@endsection
