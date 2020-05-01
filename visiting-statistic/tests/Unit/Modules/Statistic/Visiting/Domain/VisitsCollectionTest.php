<?php declare(strict_types = 1);

namespace App\Tests\Unit\Modules\Statistic\Visiting\Domain;

use App\Modules\Common\ValueObject\Ip\Ip;
use App\Modules\Statistic\Visiting\Domain\Exception\NotAllowedVisitingCollectionItemException;
use App\Modules\Statistic\Visiting\Domain\Visit;
use App\Modules\Statistic\Visiting\Domain\VisitsCollection;
use DateTime;
use Faker\Factory as FakerFactory;
use PHPUnit\Framework\TestCase;
use stdClass;

class VisitsCollectionTest extends TestCase
{
    /**
     * @dataProvider arrayWithInvalidVisitDataProvider
     */
    public function testCreateCollectionExpectedNotAllowedVisitingCollectionItemException(array $arrayWithInvalidVisit) : void
    {
        $this->expectException(NotAllowedVisitingCollectionItemException::class);
        $collection = new VisitsCollection($arrayWithInvalidVisit);
    }

    public function arrayWithInvalidVisitDataProvider() : array
    {
        $validVisit = $this->getMockBuilder(Visit::class)->disableOriginalConstructor()->getMock();
        $callback = static function () {
            return true;
        };
        return [
            'contain null' => [[$validVisit, $validVisit, null]],
            'contain boolean' => [[$validVisit, true, $validVisit]],
            'contain string' => [['any string', $validVisit, $validVisit]],
            'contain integer' => [[$validVisit, $validVisit, 123]],
            'contain float' => [[$validVisit, $validVisit, 124.432, $validVisit]],
            'contain array' => [[$validVisit, $validVisit, [], $validVisit]],
            'contain invalid object' => [[$validVisit, new stdClass(), $validVisit]],
            'contain callable' => [[$validVisit, $callback, $validVisit]],
        ];
    }

    /**
     * @dataProvider arrayWithValidVisitsDataProvider
     */
    public function testCorrectCreateCollectionFromValidArray(array $arrayWithValidVisits) : void
    {
        $collection = new VisitsCollection($arrayWithValidVisits);
        $this->assertEquals(count($arrayWithValidVisits), $collection->count());
        foreach ($collection as $collectionItem) {
            $this->assertInstanceOf(Visit::class, $collectionItem);
        }
    }

    public function arrayWithValidVisitsDataProvider() : array
    {
        $validVisit = $this->getMockBuilder(Visit::class)->disableOriginalConstructor()->getMock();
        return [
            'empty array' => [[]],
            [[$validVisit, $validVisit]],
            [[$validVisit, $validVisit, $validVisit, $validVisit]],
            [[$validVisit, $validVisit, $validVisit, $validVisit, $validVisit, $validVisit]],
        ];
    }

    /**
     * @dataProvider invalidVisitDataProvider
     */
    public function testAppendInvalidVisitExpectedNotAllowedVisitingCollectionItemException($invalidVisit) : void
    {
        $this->expectException(NotAllowedVisitingCollectionItemException::class);
        $collection = new VisitsCollection();
        $collection->append($invalidVisit);
    }

    public function invalidVisitDataProvider() : array
    {
        $callback = static function () {
            return true;
        };
        return [
            'null' => [null],
            'boolean' => [true],
            'string' => ['any string'],
            'integer' => [123],
            'float' => [124.432],
            'array' => [[]],
            'invalid object' => [new stdClass()],
            'callable' => [$callback],
        ];
    }

    public function testCorrectAppendValidVisit() : void
    {
        $faker = FakerFactory::create();
        $firstVisit = new Visit(new Ip($faker->ipv6), new DateTime());
        $secondVisit = new Visit(new Ip($faker->ipv4), new DateTime());
        $collection = new VisitsCollection();
        $this->assertEmpty($collection);
        $collection->append($firstVisit);
        $this->assertCount(1, $collection);
        /** @var Visit $visitFromCollection */
        $visitFromCollection = $collection->offsetGet(0);
        $this->assertEquals((string) $visitFromCollection->getIp(), (string) $firstVisit->getIp());
        $collection->append($secondVisit);
        $this->assertCount(2, $collection);
        /** @var Visit $secondVisitFromCollection */
        $secondVisitFromCollection = $collection->offsetGet(1);
        $this->assertEquals((string) $secondVisitFromCollection->getIp(), (string) $secondVisit->getIp());
        $collection->append($firstVisit);
        $collection->append($secondVisit);
        $this->assertCount(4, $collection);
    }
}
