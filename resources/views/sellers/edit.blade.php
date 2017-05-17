@extends('base')

@section('links')

@endsection

@section('content')
    <h3>Edit seller "{{ $seller->title }}"</h3>
    <form action="/seller/update/{{ $seller->id }}" method="post">
        <label for="seller_title">Title:</label>
        <input type="text" name="seller_title" id="seller_title" value="{{ $seller->title }}">
        {{ csrf_field() }}
        <input type="submit">
    </form>
@endsection