{{-- resources/views/member/produk/create.blade.php --}}
@extends('member.layout')

@section('title', 'Tambah Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-plus"></i> Tambah Produk Baru</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('member.produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- isi form --}}
                    @include('member.produk.form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
