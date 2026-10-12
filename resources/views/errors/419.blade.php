@extends('errors.layout')

@section('code', '419')
@section('title', 'Sesi berakhir')
@section('message', 'Sesi Anda telah kedaluwarsa. Muat ulang halaman lalu coba lagi.')
@section('icon')
    <x-icon name="warning" class="h-7 w-7" />
@endsection
