@extends('errors.layout')

@section('code', '403')
@section('title', 'Akses ditolak')
@php
    $detail = in_array($exception->getMessage(), ['', 'This action is unauthorized.'], true)
        ? 'Anda tidak memiliki izin untuk membuka halaman ini.'
        : $exception->getMessage();
@endphp
@section('message', $detail)
@section('icon')
    <x-icon name="lock" class="h-7 w-7" />
@endsection
