@extends('layouts.app')
@section('title','Edit Produk')

@section('content')
  <h1 class="text-2xl font-semibold mb-4">Edit Produk</h1>

  <form action="{{ route('products.update',$product) }}" method="post" enctype="multipart/form-data" class="card p-6">
    @csrf @method('PUT')

    {{-- Upload --}}
    <div class="mb-5">
      <label class="block text-sm text-slate-600 mb-1">Thumbnail (unggah untuk mengganti)</label>
      <input type="file" name="thumbnail" class="input !py-1 w-full">
      @php
        $src = $product->thumbnail ? (Str::startsWith($product->thumbnail,'images/') ? asset($product->thumbnail) : asset('storage/'.$product->thumbnail)) : null;
      @endphp
      @if($src)<img src="{{ $src }}" class="h-20 w-20 object-cover rounded-xl border mt-3" />@endif
      @error('thumbnail')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
    </div>

    {{-- Grid dua kolom --}}
    <div class="grid md:grid-cols-2 gap-6">
      <div>
        <label class="block text-sm text-slate-600 mb-1">Kategori</label>
        <input name="category" value="{{ old('category',$product->category) }}" class="input w-full" required>
        @error('category')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="block text-sm text-slate-600 mb-1">Produk</label>
        <input name="product" value="{{ old('product',$product->product) }}" class="input w-full relative z-10" required autocomplete="off">
        @error('product')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      <div class="md:col-span-2">
        <label class="block text-sm text-slate-600 mb-1">Harga</label>
        <input name="harga" type="number" value="{{ old('harga',$product->harga) }}" class="input w-full" min="0" required>
        @error('harga')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="mt-6 flex gap-2">
      <button class="btn-primary">Update</button>
      <a href="{{ route('products.index') }}" class="btn">Batal</a>
    </div>
  </form>
@endsection
