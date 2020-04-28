<?php declare(strict_types = 1);

namespace App\Modules\Statistic\Visiting\Application;

use App\Modules\Common\ValueObject\Ip\Ip;
use App\Modules\Statistic\Visiting\DataLayer\VisitsRepository;
use App\Modules\Statistic\Visiting\Domain\Visit;
use DateTimeInterface;

class VisitService
{
    /**
     * @var VisitsRepository
     */
    private $visitsRepository;

    /**
     * VisitingService constructor.
     *
     * @param VisitsRepository $visitsRepository
     */
    public function __construct(VisitsRepository $visitsRepository)
    {
        $this->visitsRepository = $visitsRepository;
    }

    public function fixateVisit(Ip $ip, DateTimeInterface $dateTime) : void
    {
        $visit = new Visit($ip, $dateTime);
        $this->visitsRepository->saveVisit($visit);
    }
}
