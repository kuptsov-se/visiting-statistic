<?php declare(strict_types = 1);

namespace App\Modules\Statistic\Visiting\Domain;

use App\Modules\Common\ValueObject\Ip\Ip;
use DateTimeInterface;

class Visit
{
    /**
     * @var string
     */
    private $ip;

    /**
     * @var DateTimeInterface
     */
    private $date;

    /**
     * Visit constructor.
     *
     * @param Ip                $ip
     * @param DateTimeInterface $date
     */
    public function __construct(Ip $ip, DateTimeInterface $date)
    {
        $this->ip = $ip;
        $this->date = $date;
    }

    public function getIp() : Ip
    {
        return $this->ip;
    }

    public function getDate() : DateTimeInterface
    {
        return $this->date;
    }
}
