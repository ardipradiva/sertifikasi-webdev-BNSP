<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>@yield('title','Admin')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: { 500:'#10b981', 600:'#0ea5a4' }, /* teal/mint */
            ink: '#0f172a'
          },
          boxShadow: {
            soft: '0 12px 30px -12px rgba(2,6,23,.18)'
          }
        }
      }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    .card { @apply bg-white/80 backdrop-blur rounded-2xl shadow-soft border border-slate-100; }
    .btn  { @apply inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 transition; }
    .btn-primary { @apply bg-brand-500 text-white border-0 hover:bg-brand-600; }
    .input { @apply w-full rounded-xl border border-slate-200 px-3 py-2 focus:outline-none focus:ring-4 focus:ring-brand-500/20; }
    .badge { @apply inline-block text-xs px-2 py-1 rounded-full bg-slate-100 text-slate-700; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 text-ink">

{{-- Topbar --}}
<header class="sticky top-0 z-30 bg-white/70 backdrop-blur border-b border-slate-100">
  <div class="max-w-[1280px] mx-auto px-4 py-3 flex items-center gap-3">
    <div class="flex items-center gap-2">
      <div class="h-9 w-9 rounded-lg bg-brand-500 text-white grid place-items-center font-semibold">AD</div>
      <div class="font-semibold">Ardi Cell Admin </div>
    </div>
    <div class="flex-1"></div>
    <a class="btn" href="{{ route('products.export.csv') }}">Generate Report</a>
  </div>
</header>

<div class="max-w-[1280px] mx-auto px-4 py-6 grid grid-cols-12 gap-4">
  {{-- Sidebar mini --}}
  <aside class="col-span-2 md:col-span-2">
    <nav class="space-y-2">
      <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 {{ request()->routeIs('dashboard') ? 'bg-slate-50 border-brand-500' : '' }}">Dashboard</a>
      <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 {{ request()->is('products*') ? 'bg-slate-50 border-brand-500' : '' }}">Products</a>
    </nav>
    <div class="mt-6 text-xs text-slate-500">© 2025 Ardi </div>
  </aside>

  {{-- Content --}}
  <main class="col-span-10">
    @if(session('ok'))
      <div x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,2500)"
           class="mb-4 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-3">
        {{ session('ok') }}
      </div>
    @endif

    @yield('content')
  </main>
</div>

</body>
</html>
