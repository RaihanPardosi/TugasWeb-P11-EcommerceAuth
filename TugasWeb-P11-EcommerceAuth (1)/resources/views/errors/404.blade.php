@extends('errors.layout')

@section('code', '404')
@section('title', 'Halaman tidak ditemukan')
@section('message', 'Alamat yang Anda buka tidak tersedia atau sudah dipindahkan.')
@section('icon')
    <x-icon name="search" class="h-7 w-7" />
@endsection
