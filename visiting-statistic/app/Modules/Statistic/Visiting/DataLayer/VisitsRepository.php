<?php declare(strict_types = 1);

namespace App\Modules\Statistic\Visiting\DataLayer;

use App\Modules\Statistic\Visiting\Domain\Visit;
use App\Modules\Statistic\Visiting\Domain\VisitsCollection;
use DatePeriod;

interface VisitsRepository
{
    public function findAll() : VisitsCollection;

    public function findByPeriod(DatePeriod $period) : VisitsCollection;

    public function saveVisit(Visit $visit) : bool;
}
