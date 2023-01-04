@extends('layouts.app')

@section('title')

@endsection

@section('content')
    <x-listar-post :posts="$posts" />

@endsection