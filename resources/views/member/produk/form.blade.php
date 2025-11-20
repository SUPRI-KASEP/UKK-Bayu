<div class="mb-3">
    <label for="nama" class="form-label">Nama Produk *</label>
    <input type="text" class="form-control" name="nama" value="{{ old('nama', $produk->nama ?? '') }}">
</div>

{{-- isi lainnya tetap sama --}}
