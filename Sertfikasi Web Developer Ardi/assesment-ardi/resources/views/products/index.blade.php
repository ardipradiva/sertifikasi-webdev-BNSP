@extends('layouts.app')
@section('title','Products')

@section('content')
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
    <h1 class="text-2xl font-semibold">Products</h1>
    <div class="flex gap-2">
      <input id="quickSearch" class="input" placeholder="Cari produk…">
      <a href="{{ route('products.create') }}" class="btn-primary">Tambah Produk</a>
    </div>
  </div>

  <div class="card overflow-x-auto">
    <table id="tbl" class="min-w-full text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-4 py-3 text-left">Thumbnail</th>
          <th class="px-4 py-3 text-left">Produk</th>
          <th class="px-4 py-3 text-left">Kategori</th>
          <th class="px-4 py-3 text-left">Harga</th>
          <th class="px-4 py-3 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody>
      @forelse($products as $p)
        <tr class="border-t hover:bg-slate-50">
          <td class="px-4 py-3">
            @php
              $src = $p->thumbnail ? (Str::startsWith($p->thumbnail,'images/') ? asset($p->thumbnail) : asset('storage/'.$p->thumbnail)) : null;
            @endphp
            @if($src)
              <img src="{{ $src }}" class="h-12 w-12 object-cover rounded-xl border"/>
            @else
              <span class="badge">No Image</span>
            @endif
          </td>
          <td class="px-4 py-3 font-medium">{{ $p->product }}</td>
          <td class="px-4 py-3">{{ $p->category }}</td>
          <td class="px-4 py-3">Rp {{ number_format($p->harga,0,',','.') }}</td>
          <td class="px-4 py-3">
            <div class="flex gap-2">
              <a class="btn" href="{{ route('products.edit',$p) }}">Edit</a>
              <form action="{{ route('products.destroy',$p) }}" method="post" onsubmit="return confirm('Hapus produk ini?')">
                @csrf @method('DELETE')
                <button class="btn">Delete</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td class="px-4 py-6" colspan="5">Belum ada data.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $products->links() }}</div>

  <script>
    // quick filter
    const q = document.getElementById('quickSearch');
    const rows = () => Array.from(document.querySelectorAll('#tbl tbody tr'));
    q?.addEventListener('input', e => {
      const s = e.target.value.toLowerCase();
      rows().forEach(tr => tr.style.display = tr.innerText.toLowerCase().includes(s) ? '' : 'none');
    });
  </script>
@endsection
