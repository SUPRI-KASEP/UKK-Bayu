{{-- resources/views/member/produk/index.blade.php --}}
@extends('member.layout')

@section('title', 'Kelola Produk')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-box"></i> Kelola Produk</h1>
    <a href="{{ route('member.produk.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@include('member.produk.table') {{-- opsional jika mau modular --}}
@endsection
