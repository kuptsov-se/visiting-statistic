<?php declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Modules\Statistic\Visiting\Application\VisitingStatisticManager;
use Illuminate\Contracts\Support\Renderable;
use Laravel\Lumen\Routing\Controller;

class AppController extends Controller
{
    public function index(VisitingStatisticManager $visitingStatisticManager) : Renderable
    {
        $totalVisitingStatistic = $visitingStatisticManager->getTotalVisitsStatistic();
        $todayVisitingStatistic = $visitingStatisticManager->getTodayVisitsStatistic();
        return view('app', [
            'totalVisitingStatistic' => $totalVisitingStatistic,
            'todayVisitingStatistic' => $todayVisitingStatistic,
        ]);
    }
}
