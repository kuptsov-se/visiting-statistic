<?php declare(strict_types = 1);

namespace App\Modules\Statistic\Visiting\DataLayer\Eloquent;

use App\Modules\Common\Date\DateFormat;
use App\Modules\Common\ValueObject\Ip\Exception\InvalidIpFormatException;
use App\Modules\Common\ValueObject\Ip\Exception\NotSupportedIpTypeException;
use App\Modules\Statistic\Visiting\DataLayer\VisitsRepository;
use App\Modules\Statistic\Visiting\Domain\Exception\InvalidVisitingPeriodException;
use App\Modules\Statistic\Visiting\Domain\Exception\NotAllowedVisitingCollectionItemException;
use App\Modules\Statistic\Visiting\Domain\Visit;
use App\Modules\Statistic\Visiting\Domain\VisitFactory;
use App\Modules\Statistic\Visiting\Domain\VisitsCollection;
use DatePeriod;

class MySQLVisitsRepository implements VisitsRepository
{
    /**
     * @return VisitsCollection
     *
     * @throws InvalidIpFormatException
     * @throws NotSupportedIpTypeException
     * @throws NotAllowedVisitingCollectionItemException
     */
    public function findAll() : VisitsCollection
    {
        $visitsCollection = new VisitsCollection();
        $visitsModels = VisitModel::all();
        foreach ($visitsModels as $visitModel) {
            $visit = VisitFactory::createFromORM($visitModel);
            $visitsCollection->append($visit);
        }
        return $visitsCollection;
    }

    /**
     * @param DatePeriod $period
     *
     * @return VisitsCollection
     *
     * @throws InvalidIpFormatException
     * @throws InvalidVisitingPeriodException
     * @throws NotAllowedVisitingCollectionItemException
     * @throws NotSupportedIpTypeException
     */
    public function findByPeriod(DatePeriod $period) : VisitsCollection
    {
        if ($period->getEndDate() === null) {
            throw new InvalidVisitingPeriodException('Period end date mast be isset.');
        }
        $visitsCollection = new VisitsCollection();
        $visitsModels = VisitModel::whereBetween(
            VisitModelFields::DATE,
            [
                $period->getStartDate()->format(DateFormat::DEFAULT_DATE_TIME_FORMAT),
                $period->getEndDate()->format(DateFormat::DEFAULT_DATE_TIME_FORMAT),
            ]
        )->get();
        foreach ($visitsModels as $visitModel) {
            $visit = VisitFactory::createFromORM($visitModel);
            $visitsCollection->append($visit);
        }
        return $visitsCollection;
    }

    /**
     * @param Visit $visit
     *
     * @return bool
     */
    public function saveVisit(Visit $visit) : bool
    {
        $visitModel = new VisitModel();
        $visitModel->setIp($visit->getIp());
        $visitModel->setDate($visit->getDate());
        return $visitModel->save();
    }
}
