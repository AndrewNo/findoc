@extends('base')

@section('links')
@endsection

@section('content')
    <form action="" method="post">
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

        <input type="hidden" name="pic" value="{{ $category->pic }}">
        <input type="hidden" name="type" value="income">
        {{ csrf_field() }}
        <input type="submit">
    </form>
@endsection