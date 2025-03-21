@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
    <x-user-form :action="route('users.update', $user->id)" :is-edit="true" :user="$user"/>
@endsection
