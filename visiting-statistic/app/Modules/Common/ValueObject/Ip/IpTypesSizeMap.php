<?php declare(strict_types = 1);

namespace App\Modules\Common\ValueObject\Ip;

class IpTypesSizeMap
{
    private static $map = [
        4 => IpType::IP_V4,
        16 => IpType::IP_V6,
    ];

    public static function getTypeByByteNumber(int $bytesNumber) : ?string
    {
        return self::$map[$bytesNumber] ?? null;
    }
}
