<?php declare(strict_types = 1);

namespace App\Modules\Statistic\Visiting\Domain;

use App\Modules\Common\ValueObject\Ip\Exception\InvalidIpFormatException;
use App\Modules\Common\ValueObject\Ip\Exception\NotSupportedIpTypeException;
use App\Modules\Common\ValueObject\Ip\Ip;
use App\Modules\Statistic\Visiting\DataLayer\Eloquent\VisitModel;
use DateTime;

class VisitFactory
{
    /**
     * @param VisitModel $visitModel
     *
     * @return Visit
     * @throws InvalidIpFormatException
     * @throws NotSupportedIpTypeException
     */
    public static function createFromORM(VisitModel $visitModel) : Visit
    {
        $visitIp = new Ip($visitModel->getIp());
        $visitDate = new DateTime($visitModel->getDate());
        return new Visit($visitIp, $visitDate);
    }
}
