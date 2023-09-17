@extends('main_layout')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
        <a role="button" class="my-4 btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add New User</a>
        <a role="button" class="my-4 btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addNewMessageModal">Add New Message</a>
        </div>
    </div>
    @include('Chat.add_message')
    @include('Chat.add_user')
@endsection

@section('inertiaContent')
    @inertia
@endsection

@section('script')
    @vite('resources/assets/js/chat.js')
@endsection
