@extends('base')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/subcategory_edit.css') }}">
@endsection

@section('content')
    <h3>Edit subcategory "{{ $subcategory->title }}"</h3>
    <form action="/subcategory/update/{{ $subcategory->id }}" method="post">
        <label for="subcategory_title">Title:</label>
        <input type="text" name="subcategory_title" id="subcategory_title" value="{{ $subcategory->title }}">
        <img src="{{ asset($subcategory->pic) }}" alt="">
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
        <label for="category_id">Change category:</label>
        <select name="category_id" id="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        @if($subcategory->category_id == $category->id) selected @endif>{{ $category->title }}</option>
            @endforeach
        </select>
        {{ csrf_field() }}
        <input type="hidden" name="pic" value="{{ $subcategory->pic }}">
        <input type="submit">
    </form>
    <script src="{{ asset('js/subcategory_edit.js') }}"></script>
@endsection