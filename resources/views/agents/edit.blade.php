@extends('base')

@section('links')

@endsection

@section('content')
    <h3>Edit seller "{{ $agent->title }}"</h3>
    <form action="/agent/update/{{ $agent->id }}" method="post">
        <label for="seller_title">Title:</label>
        <input type="text" name="seller_title" id="seller_title" value="{{ $agent->title }}">
        {{ csrf_field() }}
        <input type="submit">
    </form>
@endsection