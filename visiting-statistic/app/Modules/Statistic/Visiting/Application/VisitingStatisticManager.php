<?php declare(strict_types = 1);

namespace App\Modules\Statistic\Visiting\Application;

use App\Modules\Common\Date\Date;
use App\Modules\Common\Date\DateFormat;
use App\Modules\Common\ValueObject\Ip\Ip;
use App\Modules\Statistic\Visiting\DataLayer\VisitsRepository;
use App\Modules\Statistic\Visiting\Domain\Visit;
use App\Modules\Statistic\Visiting\Domain\VisitsCollection;
use DateInterval;
use DatePeriod;
use DateTime;

class VisitingStatisticManager
{
    /**
     * @var VisitsRepository
     */
    private $visitsRepository;

    /**
     * VisitingStatisticManager constructor.
     *
     * @param VisitsRepository $visitsRepository
     */
    public function __construct(VisitsRepository $visitsRepository)
    {
        $this->visitsRepository = $visitsRepository;
    }

    public function getTotalVisitsStatistic() : VisitsStatistic
    {
        $allVisits = $this->visitsRepository->findAll();
        return $this->createVisitsStatistic($allVisits);
    }

    public function getTodayVisitsStatistic() : VisitsStatistic
    {
        $currentDate = new DateTime();
        $currentDateStart = new DateTime($currentDate->format(DateFormat::DEFAULT_DATE_FORMAT) . Date::DAY_START_TIME);
        $currentDateFinish = new DateTime($currentDate->format(DateFormat::DEFAULT_DATE_FORMAT) . Date::DAY_FINISH_TIME);
        $periodForGetVisits = new DatePeriod($currentDateStart, new DateInterval('P1D'), $currentDateFinish);
        $visits = $this->visitsRepository->findByPeriod($periodForGetVisits);
        return $this->createVisitsStatistic($visits);
    }

    private function createVisitsStatistic(VisitsCollection $visits) : VisitsStatistic
    {
        $visitedIps = $undefinedIps = [];
        /** @var Visit $visit */
        foreach ($visits as $visit) {
            $visitedIps[] = $visit->getIp();
            if ($visit->getIp()->getIp() === Ip::UNDEFINED_IP) {
                $undefinedIps[] = $visit->getIp();
            }
        }
        $uniqueVisitsIps = array_unique($visitedIps);
        return new VisitsStatistic($visits->count(), count($uniqueVisitsIps), count($undefinedIps));
    }
}
