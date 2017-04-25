@extends('base')

@section('content')

    <div class="new_account">
        <p>Add new account</p>
        <div id="add_account_modal">
            <div id="show-modal" @click="showModal = true"><i class="fa fa-plus" aria-hidden="true"></i></div>
            <modal-account v-if="showModal" @close="showModal = false"></modal-account>
        </div>
    </div>

    <div class="active_accounts">
        <h3>Active accounts:</h3>
    </div>


    <script src="{{ asset('js/main.js') }}" charset="utf-8"></script>
@endsection