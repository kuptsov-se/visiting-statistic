<?php declare(strict_types = 1);

namespace App\Tests\Unit\Modules\Statistic\Visiting\Domain;

use App\Modules\Common\Date\DateFormat;
use App\Modules\Statistic\Visiting\DataLayer\Eloquent\VisitModel;
use App\Modules\Statistic\Visiting\Domain\Visit;
use App\Modules\Statistic\Visiting\Domain\VisitFactory;
use Faker\Factory as FakerFactory;
use PHPUnit\Framework\TestCase;

class VisitFactoryTest extends TestCase
{
    /**
     * @dataProvider visitParamsDataProvider
     */
    public function testCorrectCreateVisitFromORMModel(string $ip, string $date) : void
    {
        $visitORM = $this->getMockBuilder(VisitModel::class)->disableOriginalConstructor()->getMock();
        $visitORM->method('getIp')->willReturn($ip);
        $visitORM->method('getDate')->willReturn($date);
        $visit = VisitFactory::createFromORM($visitORM);
        $this->assertInstanceOf(Visit::class, $visit);
        $this->assertEquals($ip, $visit->getIp()->getIp());
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
