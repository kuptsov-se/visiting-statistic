<?php declare(strict_types = 1);

namespace App\Tests\Unit\Modules\Statistic\Visiting\Domain;

use App\Modules\Common\Date\DateFormat;
use App\Modules\Common\ValueObject\Ip\Ip;
use App\Modules\Statistic\Visiting\Domain\Visit;
use DateTime;
use DateTimeInterface;
use Faker\Factory as FakerFactory;
use PHPUnit\Framework\TestCase;

class VisitTest extends TestCase
{
    /**
     * @dataProvider visitParamsDataProvider
     */
    public function testCorrectCreateVisit(string $ip, string $date) : void
    {
        $visitIp = new Ip($ip);
        $visitDate = new DateTime($date);
        $visit = new Visit($visitIp, $visitDate);
        $this->assertInstanceOf(Ip::class, $visit->getIp());
        $this->assertEquals($visitIp->getIp(), $visit->getIp()->getIp());
        $this->assertInstanceOf(DateTimeInterface::class, $visit->getDate());
        $this->assertEquals($date, $visit->getDate()->format(DateFormat::DEFAULT_DATE_TIME_FORMAT));
    }

    public function visitParamsDataProvider() : array
    {
        $faker = FakerFactory::create();
        $testCasesNumber = 5;
        $testCases = [];
        for ($testCaseIndex = 0; $testCaseIndex < $testCasesNumber; $testCaseIndex++) {
            $ip = $faker->boolean(50)
                ? $faker->ipv4
                : $faker->ipv6;
            $testCases[] = [
                $ip,
                $faker->date(DateFormat::DEFAULT_DATE_TIME_FORMAT)
            ];
        }
        return $testCases;
    }
}
