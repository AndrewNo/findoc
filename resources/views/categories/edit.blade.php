@extends('base')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/category_edit.css') }}">
@endsection

@section('content')
    <h3>Edit category "{{ $category->title }}":</h3>
    <form action="/category/update/{{ $category->id }}" method="post">
        <label for="category_title">Title</label>
        <input type="text" name="category_title" id="category_title" value="{{ $category->title }}">
        <img src="{{ asset($category->pic) }}" alt="">
        <div class="add_img">
            Change image
        </div>
        <div class="images">
            <ul>
                @foreach(glob('images/accounts_icons/*.png') as $img)
                    <li><img src="/{{ $img }}" alt=""></li>
                @endforeach
            </ul>
        </div>
        <label for="type">Type:</label>
        <select name="type" id="type">
            <option value="income" @if($category->type == 'income') selected @endif>Income</option>
            <option value="outcome" @if($category->type == 'outcome') selected @endif>Outcome</option>
        </select>
        <input type="hidden" name="pic" value="{{ $category->pic }}">


        {{ csrf_field() }}
        <input type="submit">
    </form>

    <script src="{{ asset('js/category_edit.js') }}"></script>
@endsection