<?php declare(strict_types = 1);

namespace App\Tests\Unit\Modules\Common\ValueObject\Ip;

use App\Modules\Common\ValueObject\Ip\Exception\InvalidIpFormatException;
use App\Modules\Common\ValueObject\Ip\Ip;
use Faker\Factory as FakerFactory;
use PHPUnit\Framework\TestCase;

class IpTest extends TestCase
{
    /**
     * @dataProvider invalidFormatIPDataProvider
     */
    public function testExpectedInvalidIpFormatException(string $invalidFormatIP) : void
    {
        $this->expectException(InvalidIpFormatException::class);
        $ip = new Ip($invalidFormatIP);
    }

    public function invalidFormatIPDataProvider() : array
    {
        return [
            'empty string' => [''],
            'not IP string' => ['random string'],
            ['127001'],
            ['127.0.01'],
            ['127.0.0.1.1'],
            ['8e65qwe:933asdad:22eeqwe:a232asd:f1qwec1:27asd41:1qwef10:1ads17c'],
        ];
    }

    /**
     * @dataProvider validIpDataProvider
     */
    public function testCorrectCreateIpObject(string $validIp) : void
    {
        $ip = new Ip($validIp);
        $this->assertEquals($validIp, $ip->getIp());
        $this->assertIsString($ip->getIp());
        $this->assertNotEmpty($ip->getIp());
    }

    public function validIpDataProvider() : array
    {
        $faker = FakerFactory::create();
        $testCasesNumber = 5;
        $testCases = [];
        for ($testCaseIndex = 0; $testCaseIndex < $testCasesNumber; $testCaseIndex++) {
            $testCases[] = $faker->boolean(50)
                ? [$faker->ipv4]
                : [$faker->ipv6];
        }
        $testCases['undefined ip const'] = [Ip::UNDEFINED_IP];
        return $testCases;
    }
}
