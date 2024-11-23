<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure, DB, Carbon\Carbon;

class ChartFinance extends Component
{
    public $months, $monthlyProfits;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->months = [];
        for ($i = 1; $i <= 12; $i++) {
            $this->months[] = Carbon::create()->month($i)->format('F'); // 'F' gives the full month name
        }

        $profits = DB::table('finances')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(CASE WHEN type = "in" THEN amount ELSE 0 END) as income'),
                DB::raw('SUM(CASE WHEN type = "out" THEN amount ELSE 0 END) as expenses')
            )
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $monthlyProfit = array_fill(1, 12, 0);  // Default all months to 0 profit
        foreach ($profits as $profit) {
            $monthlyProfit[$profit->month] = $profit->income - $profit->expenses;
        }
        $this->monthlyProfits = array_values($monthlyProfit);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chart-finance');
    }
}
