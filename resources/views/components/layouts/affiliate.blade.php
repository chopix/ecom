<x-layouts.dash :title="$title">
  <div class="container mt-5">
    <ul class="nav nav-pills mb-5 d-flex justify-content-center">
        <li class="nav-item">
            <a class="nav-link btn {{$navItem === 'dashboard' ? 'active' : ''}}" href="{{route('affiliate.dashboard')}}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{$navItem === 'sales' ? 'active' : ''}}" href="{{route('affiliate.sales')}}">Sales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{$navItem === 'stats' ? 'active' : ''}}" href="{{route('affiliate.stats')}}">Stats</a>
        </li>
    </ul>

    {{$slot}}
  </div>
</x-layouts.dash>