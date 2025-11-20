{{-- resources/views/member/produk/edit.blade.php --}}
@extends('member.layout')

@section('title', 'Edit Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-edit"></i> Edit Produk</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('member.produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- isi form tetap sama --}}
                    @include('member.produk.form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
