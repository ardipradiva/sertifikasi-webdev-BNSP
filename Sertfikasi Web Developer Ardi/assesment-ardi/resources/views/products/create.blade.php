@extends('layouts.app')
@section('title','Tambah Produk')

@section('content')
  <h1 class="text-2xl font-semibold mb-4">Tambah Produk</h1>

  {{-- Card form: rapi, 2 kolom di ≥ md, semua input w-full --}}
  <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" class="card p-6">
    @csrf

    {{-- Upload --}}
    <div class="mb-5">
      <label class="block text-sm text-slate-600 mb-1">Thumbnail (opsional)</label>
      <input type="file" name="thumbnail" class="input !py-1 w-full">
      @error('thumbnail')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- Grid dua kolom --}}
    <div class="grid md:grid-cols-2 gap-6">
      <div>
        <label class="block text-sm text-slate-600 mb-1">Kategori</label>
        <input name="category" value="{{ old('category') }}" class="input w-full" placeholder="Contoh: Samsung" required>
        @error('category')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="block text-sm text-slate-600 mb-1">Produk</label>
        {{-- z-10 agar dropdown/tooltip tidak ketutup elemen lain --}}
        <input name="product" value="{{ old('product') }}" class="input w-full relative z-10" placeholder="Contoh: Galaxy Z Flip" required autocomplete="off">
        @error('product')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      <div class="md:col-span-2">
        <label class="block text-sm text-slate-600 mb-1">Harga</label>
        <input name="harga" type="number" value="{{ old('harga') }}" class="input w-full" placeholder="Contoh: 5000000" min="0" required>
        @error('price')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="mt-6 flex gap-2">
      <button class="btn-primary">Simpan</button>
      <a href="{{ route('products.index') }}" class="btn">Batal</a>
    </div>
  </form>
@endsection
