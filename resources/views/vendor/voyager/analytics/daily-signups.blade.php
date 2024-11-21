@extends('voyager::master')

@section('page_title', 'Latest Signups')

@section('content')
  <div class="container">
    <h2>Signups Graphs</h2>
    
    <form action="{{route('admin.analytics.dailySignups')}}" method="GET" class="form-inline">
        <div class="form-group mb-2">
            <label for="interval" class="sr-only">Interval</label>
            <select name="interval" id="interval" class="form-control">
                <option @selected($interval === 'daily') value="daily">Per day</option>
                <option @selected($interval === 'week') value="week">Per week</option>
                <option @selected($interval === 'month') value="month">Per month</option>
                <option @selected($interval === 'half-year') value="half-year">For half a year</option>
                <option @selected($interval === 'year') value="year">For a year</option> 
                <option @selected($interval === 'all-time') value="all-time">For all the time</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Apply</button>
    </form>

    <canvas id="dailySignupsChart"></canvas>
  </div>

  @push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
            const signups = @json($signups);
            const interval = @json($interval);


            const ctx = document.getElementById('dailySignupsChart').getContext('2d');
            let chart;

            function updateChart(signups, interval) {
                const labels = [];
                const data = [];

                if(interval === 'daily') {
                    const now = new Date();
                    const twentyFourHoursAgo = new Date(now);
                    twentyFourHoursAgo.setHours(now.getHours() - 24);

                    for (let i = 1; i < 25; i++) {
                        const startHour = new Date(twentyFourHoursAgo);
                        startHour.setHours(startHour.getHours() + i);

                        const label = startHour.getHours().toString() + 'h';
                        labels.push(label);

                        const endHour = new Date(startHour);
                        endHour.setHours(endHour.getHours() + 1);

                        const count = signups.reduce((acc, entry) => {
                            const entryTime = entry.time;

                            if (entryTime >= startHour.getHours() && entryTime < endHour.getHours()) {
                                return acc + entry.count;
                            }
                            return acc;
                        }, 0);

                        data.push(count);
                    }
                } 

                if (interval === 'week') {
                    const now = new Date();
                    const sevenDaysAgo = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 5);

                    for (let i = 0; i <= 7; i++) {
                        const day = new Date(sevenDaysAgo.getFullYear(), sevenDaysAgo.getMonth(), sevenDaysAgo.getDate() + i);
                        const label = `${day.getFullYear()}-${day.getMonth() + 1}-${day.getDate()}`;
                        labels.push(label);

                        const count = signups.reduce((acc, entry) => {
                            const entryDate = new Date(entry.time);
                            if (entryDate.getFullYear() === day.getFullYear() &&
                                entryDate.getMonth() === day.getMonth() &&
                                entryDate.getDate() === day.getDate()) {
                                return acc + entry.count;
                            }
                            return acc;
                        }, 0);

                        data.push(count);
                    }
                }

                if (interval === 'month') {
                    const now = new Date();
                    const thirtyDaysAgo = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 29);

                    for (let i = 0; i < 32; i++) {
                        const day = new Date(thirtyDaysAgo.getFullYear(), thirtyDaysAgo.getMonth(), thirtyDaysAgo.getDate() + i);
                        const label = `${day.getFullYear()}-${day.getMonth() + 1}-${day.getDate()}`;
                        labels.push(label);

                        const count = signups.reduce((acc, entry) => {
                            const entryDate = new Date(entry.time);
                            if (entryDate.getFullYear() === day.getFullYear() &&
                                entryDate.getMonth() === day.getMonth() &&
                                entryDate.getDate() === day.getDate()) {
                                return acc + entry.count;
                            }
                            return acc;
                        }, 0);

                        data.push(count);
                    }
                }

                if (interval === 'half-year') {
                    const now = new Date();
                    const sixMonthsAgo = new Date(now.getFullYear(), now.getMonth() - 5, now.getDate());

                    for (let i = 0; i <= 6; i++) {
                        const month = new Date(sixMonthsAgo.getFullYear(), sixMonthsAgo.getMonth() + i, 1);
                        const label = `${month.getFullYear()}-${month.getMonth() + 1}`;
                        labels.push(label);

                        const count = signups.reduce((acc, entry) => {
                            const entryDate = new Date(entry.time);
                            if (entryDate.getFullYear() === month.getFullYear() && entryDate.getMonth() === month.getMonth()) {
                                return acc + entry.count;
                            }
                            return acc;
                        }, 0);

                        data.push(count);
                    }
                }

                if (interval === 'year') {
                    const now = new Date();
                    const sixMonthsAgo = new Date(now.getFullYear(), now.getMonth() - 11, now.getDate());

                    for (let i = 0; i <= 12; i++) {
                        const month = new Date(sixMonthsAgo.getFullYear(), sixMonthsAgo.getMonth() + i, 1);
                        const label = `${month.getFullYear()}-${month.getMonth() + 1}`;
                        labels.push(label);

                        const count = signups.reduce((acc, entry) => {
                            const entryDate = new Date(entry.time);
                            if (entryDate.getFullYear() === month.getFullYear() && entryDate.getMonth() === month.getMonth()) {
                                return acc + entry.count;
                            }
                            return acc;
                        }, 0);

                        data.push(count);
                    }
                }

                if (interval === 'all-time') {
                    const minYear = signups.reduce((min, entry) => {
                    const year = new Date(entry.time).getFullYear();
                        return year < min ? year : min;
                    }, new Date().getFullYear());

                    const currentYear = new Date().getFullYear();
                    for (let year = minYear; year <= currentYear; year++) {
                        const label = year.toString();
                        labels.push(label);

                        const count = signups.reduce((acc, entry) => {
                            const entryYear = new Date(entry.time).getFullYear();
                            if (entryYear === year) {
                                return acc + entry.count;
                            }
                            return acc;
                        }, 0);

                        data.push(count);
                    }
                }

                if (chart) {
                    chart.destroy(); 
                }

                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: `Signups (${interval})`,
                            data: data,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                            }
                        }
                    }
                });
            }

            // Инициализация графика при загрузке страницы
            updateChart(signups, interval);
      });
    </script>
  @endpush
@endsection