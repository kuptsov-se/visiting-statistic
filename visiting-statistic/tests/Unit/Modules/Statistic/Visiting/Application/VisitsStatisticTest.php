<?php declare(strict_types = 1);

namespace App\Tests\Unit\Modules\Statistic\Visiting\Application;

use App\Modules\Statistic\Visiting\Application\VisitsStatistic;
use Faker\Factory as FakerFactory;
use PHPUnit\Framework\TestCase;

class VisitsStatisticTest extends TestCase
{
    /**
     * @dataProvider visitsStatisticParamsDataProvider
     */
    public function testCreatedCorrectStatistic(int $totalVisitsNumber, int $uniqueVisits, int $undefinedIpsNumber) : void
    {
        $statistic = new VisitsStatistic($totalVisitsNumber, $uniqueVisits, $undefinedIpsNumber);
        $this->assertEquals($totalVisitsNumber, $statistic->getTotalVisitsNumber());
        $this->assertEquals($uniqueVisits, $statistic->getTotalUniqueVisitsNumber());
        $this->assertEquals($undefinedIpsNumber, $statistic->getUndefinedIpsNumber());
    }

    public function visitsStatisticParamsDataProvider() : array
    {
        $faker = FakerFactory::create();
        $testCasesNumber = 5;
        $testCases = [];
        for ($testCaseIndex = 0; $testCaseIndex < $testCasesNumber; $testCaseIndex++) {
            $testCases[] = [
                $faker->randomNumber(),
                $faker->randomNumber(),
                $faker->randomNumber(),
            ];
        }
        return $testCases;
    }
}
