@extends('layouts.app')
@section('title', 'Add new user')
@section('content')
    <x-user-form :action="route('users.store')"/>
@endsection
