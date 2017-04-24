@extends('base')

@section('content')
    <div id="app">
        <profile></profile>
    </div>
    <div class="new_account">
        <p>Add new account</p>
        <div id="add_account">
            <div id="show-modal"><i class="fa fa-plus" aria-hidden="true"></i></div>

        </div>
    </div>

    <div class="active_accounts">
        <h3>Active accounts:</h3>
    </div>


    <script src="{{ asset('js/main.js') }}"></script>
@endsection