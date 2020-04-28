<?php declare(strict_types = 1);

namespace App\Modules\Statistic\Visiting\DataLayer\Eloquent;

use App\Modules\Common\Date\DateFormat;
use App\Modules\Common\ValueObject\Ip\Ip;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VisitModel
 */
class VisitModel extends Model
{
    protected $table = 'visits';

    public $timestamps = false;

    protected $fillable = [
        VisitModelFields::IP,
        VisitModelFields::DATE,
    ];

    public function setIp(Ip $ip) : void
    {
        $this->{VisitModelFields::IP} = $ip->getIp();
    }

    public function getIp() : ?string
    {
        return $this->{VisitModelFields::IP};
    }

    public function setDate(\DateTimeInterface $dateTime) : void
    {
        $this->{VisitModelFields::DATE} = $dateTime->format(DateFormat::DEFAULT_DATE_TIME_FORMAT);
    }

    public function getDate() : ?string
    {
        return $this->{VisitModelFields::DATE};
    }
}
