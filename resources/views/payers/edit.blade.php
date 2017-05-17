@extends('base')

@section('links')

@endsection

@section('content')
    <h3>Edit seller "{{ $payer->title }}"</h3>
    <form action="/payer/update/{{ $payer->id }}" method="post">
        <label for="seller_title">Title:</label>
        <input type="text" name="seller_title" id="seller_title" value="{{ $payer->title }}">
        {{ csrf_field() }}
        <input type="submit">
    </form>
@endsection