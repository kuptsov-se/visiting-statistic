<?php declare(strict_types = 1);

namespace App\Modules\Statistic\Visiting\Application;

class VisitsStatistic
{
    /**
     * @var integer
     */
    private $totalVisitsNumber;

    /**
     * @var integer
     */
    private $totalUniqueVisitsNumber;

    /**
     * @var int
     */
    private $undefinedIpsNumber;

    /**
     * VisitsStatistic constructor.
     *
     * @param int $totalVisitsNumber
     * @param int $totalUniqueVisitsNumber
     * @param int $undefinedIpsNumber
     */
    public function __construct(int $totalVisitsNumber, int $totalUniqueVisitsNumber, int $undefinedIpsNumber)
    {
        $this->totalVisitsNumber = $totalVisitsNumber;
        $this->totalUniqueVisitsNumber = $totalUniqueVisitsNumber;
        $this->undefinedIpsNumber = $undefinedIpsNumber;
    }

    public function getTotalVisitsNumber() : int
    {
        return $this->totalVisitsNumber;
    }

    public function getTotalUniqueVisitsNumber() : int
    {
        return $this->totalUniqueVisitsNumber;
    }

    public function getUndefinedIpsNumber() : int
    {
        return $this->undefinedIpsNumber;
    }
}
