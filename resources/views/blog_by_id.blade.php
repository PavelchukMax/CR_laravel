@extends('layout')

@section('title', 'Блог')

@section('header')
   Інформація про запис
@endsection

@section('content')
    <div class="blog-container">
        <h2>{{ $blog->title }}</h2>
        
        <p><strong>Опис:</strong> {{ $blog->content }}</p>
        <p><strong>Автор:</strong> {{ $blog->author ? $blog->author->name : 'Unknown' }}</p>
        <p><strong>Дата/час створення/оновлення:</strong> {{ $blog->created_or_updated_at->format('d.m.Y H:i') }}</p>

        @if(Auth::user() && Auth::user()->id == $blog->user_id)
            <div class="blog-actions">
                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary">Редагувати</a>
                
                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Видалити</button>
                </form>
            </div>
        @endif

        <a href="{{ route('blogs.all') }}" class="btn btn-secondary mt-3">Повернутись до усіх блогів</a>
    </div>
@endsection
