<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;
use App\Models\Affiliate;
use App\Models\AffiliateLink;
use App\Models\AffiliateSale;
use App\Models\AffiliateClick;
use Illuminate\Support\Facades\DB;

class AffiliateStats extends Component
{
    public $stats;

    public function mount()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $affiliateLinkIds = AffiliateLink::where('user_id', auth()->id())
                                  ->pluck('id');

        $salesCounts = DB::table('affiliate_sales')
            ->join('affiliates', 'affiliates.id', '=', 'affiliate_sales.affiliate_id')
            ->whereIn('affiliates.affiliate_link_id', $affiliateLinkIds)
            ->where('affiliates.is_active', false)
            ->selectRaw('
                affiliates.affiliate_link_id,
                DATE_FORMAT(affiliate_sales.created_at, "%Y-%m") as month_year,
                COUNT(*) as sales_count
            ')
            ->groupBy('affiliates.affiliate_link_id', 'month_year')
            ->get();

        $totalClicksCounts = DB::table('affiliate_clicks')
            ->whereIn('affiliate_link_id', $affiliateLinkIds)
            ->selectRaw('
                affiliate_link_id,
                DATE_FORMAT(created_at, "%Y-%m") as month_year,
                COUNT(*) as total_clicks_count
            ')
            ->groupBy('affiliate_link_id', 'month_year')
            ->get();

        $uniqueClicksCounts = DB::table('affiliate_clicks')
            ->whereIn('affiliate_link_id', $affiliateLinkIds)
            ->selectRaw('
                affiliate_link_id,
                DATE_FORMAT(created_at, "%Y-%m") as month_year,
                COUNT(DISTINCT ip) as unique_clicks_count
            ')
            ->groupBy('affiliate_link_id', 'month_year')
            ->get();

        $monthlyStats = collect([]);

        $allMonths = $salesCounts->pluck('month_year')
            ->concat($totalClicksCounts->pluck('month_year'))
            ->concat($uniqueClicksCounts->pluck('month_year'))
            ->unique();

        foreach ($allMonths as $month) {
            $monthlyStat = new \stdClass;
            $monthlyStat->month_year = $month;
            $monthlyStat->sales_count = $salesCounts->where('month_year', $month)->sum('sales_count');
            $monthlyStat->total_clicks_count = $totalClicksCounts->where('month_year', $month)->sum('total_clicks_count');
            $monthlyStat->unique_clicks_count = $uniqueClicksCounts->where('month_year', $month)->sum('unique_clicks_count');
            $monthlyStats->push($monthlyStat);
        }

        $this->stats = $monthlyStats->sortByDesc('month_year')->values()->all();
    }

    public function render()
    {
        return view('livewire.main.affiliate-stats')->layout('components.layouts.affiliate', ['title' => 'Affiliate Dashboard', 'navItem' => 'stats']);
    }
}
