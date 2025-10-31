@extends('layouts.app')
@section('title','Dashboard')

@section('content')
  {{-- Stat cards mint/teal --}}
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="card p-5">
      <div class="text-xs font-semibold text-brand-500 uppercase">Earnings (Monthly)</div>
      <div class="mt-1 text-3xl font-bold">Rp {{ number_format($earnMonthly,0,',','.') }}</div>
    </div>
    <div class="card p-5">
      <div class="text-xs font-semibold text-brand-500 uppercase">Earnings (Annual)</div>
      <div class="mt-1 text-3xl font-bold">Rp {{ number_format($earnAnnual,0,',','.') }}</div>
    </div>
    <div class="card p-5">
      <div class="text-xs font-semibold text-brand-500 uppercase">Tasks</div>
      <div class="mt-1 text-3xl font-bold">{{ $tasksPct }}%</div>
      <div class="mt-2 h-2.5 w-full bg-slate-100 rounded-full overflow-hidden">
        <div class="h-full bg-brand-500" style="width: {{ $tasksPct }}%"></div>
      </div>
    </div>
    <div class="card p-5">
      <div class="text-xs font-semibold text-brand-500 uppercase">Pending Requests</div>
      <div class="mt-1 text-3xl font-bold">{{ $pendingReq }}</div>
    </div>
  </div>

  {{-- Kartu metrik dasar --}}
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <div class="card p-5">
      <div class="text-slate-500 text-sm">Total Products</div>
      <div class="mt-1 text-3xl font-semibold">{{ $totalProducts }}</div>
    </div>
    <div class="card p-5">
      <div class="text-slate-500 text-sm">Total Value</div>
      <div class="mt-1 text-3xl font-semibold">Rp {{ number_format($totalValue,0,',','.') }}</div>
    </div>
    <div class="card p-5">
      <div class="text-slate-500 text-sm">Average Price</div>
      <div class="mt-1 text-3xl font-semibold">Rp {{ number_format($avgPrice,0,',','.') }}</div>
    </div>
  </div>

  {{-- Charts --}}
  <div class="grid xl:grid-cols-3 gap-4 mt-6">
    <div class="xl:col-span-2 card p-5 h-[380px] overflow-hidden">
      <div class="font-semibold mb-3">Earnings Overview</div>
      <div class="h-[calc(100%-1.75rem)]">
        <canvas id="lineChart" class="w-full h-full"></canvas>
      </div>
    </div>
    <div class="card p-5 h-[380px] overflow-hidden">
      <div class="font-semibold mb-3">Revenue Sources</div>
      <div class="h-[calc(100%-1.75rem)]">
        <canvas id="pieChart" class="w-full h-full"></canvas>
      </div>
    </div>
  </div>

  <script>
    // LINE
    const lcEl = document.getElementById('lineChart');
    const lc = lcEl.getContext('2d');
    const grad = lc.createLinearGradient(0,0,0,lcEl.clientHeight || 300);
    grad.addColorStop(0, 'rgba(16,185,129,.28)');
    grad.addColorStop(1, 'rgba(16,185,129,0)');

    new Chart(lc, {
      type: 'line',
      data: {
        labels: @json($months),
        datasets: [{
          label: 'Sales',
          data: @json($lineData),
          borderColor: '#10b981',
          tension: .35,
          borderWidth: 3,
          pointRadius: 3,
          pointHoverRadius: 5,
          fill: true,
          backgroundColor: grad
        }]
      },
      options: {
        maintainAspectRatio:false,
        plugins:{ legend:{display:false} },
        scales:{ x:{ grid:{display:false}}, y:{ grid:{color:'rgba(15,23,42,.06)'}, ticks:{precision:0} } }
      }
    });

    // DOUGHNUT
    new Chart(document.getElementById('pieChart'), {
      type:'doughnut',
      data:{ labels:@json($pieLabels), datasets:[{ data:@json($pieData), cutout:'65%' }] },
      options:{ maintainAspectRatio:false, plugins:{ legend:{ position:'bottom', labels:{ usePointStyle:true, boxWidth:8 } } } }
    });
  </script>
@endsection
