<?php declare(strict_types = 1);

namespace App\Tests\Unit\Modules\Common\ValueObject\Ip;

use App\Modules\Common\ValueObject\Ip\IpTypesSizeMap;
use PHPUnit\Framework\TestCase;

class IpTypesSizeMapTest extends TestCase
{
    /**
     * @dataProvider supportedIpTypesBytesNumbersDataProvider
     */
    public function testCorrectGetSupportedIpType(int $correctBytesNumber) : void
    {
        $ipType = IpTypesSizeMap::getTypeByByteNumber($correctBytesNumber);
        $this->assertIsString($ipType);
        $this->assertNotEmpty($ipType);
    }

    public function supportedIpTypesBytesNumbersDataProvider() : array
    {
        return [
            'IPv4' => [4],
            'IPv6' => [16],
        ];
    }

    /**
     * @dataProvider notSupportedIpTypesBytesNumberDataProvider
     */
    public function testGetNullTypeIfNotSupported(int $incorrectBytesNumber) : void
    {
        $ipType = IpTypesSizeMap::getTypeByByteNumber($incorrectBytesNumber);
        $this->assertNull($ipType);
    }

    public function notSupportedIpTypesBytesNumberDataProvider() : array
    {
        return [
            [2],
            [8],
            [32],
            [64],
        ];
    }
}
