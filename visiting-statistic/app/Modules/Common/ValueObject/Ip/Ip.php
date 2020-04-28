<?php declare(strict_types = 1);

namespace App\Modules\Common\ValueObject\Ip;

use App\Modules\Common\ValueObject\Ip\Exception\InvalidIpFormatException;
use App\Modules\Common\ValueObject\Ip\Exception\NotSupportedIpTypeException;

class Ip
{
    public const UNDEFINED_IP = '0.0.0.0';

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $type;

    /**
     * Ip constructor.
     *
     * @param string $ip
     *
     * @throws InvalidIpFormatException
     * @throws NotSupportedIpTypeException
     */
    public function __construct(string $ip)
    {
        $packedIP = @inet_pton($ip);
        if ($packedIP === false) {
            throw new InvalidIpFormatException('Invalid IP address.');
        }
        $byteCount = mb_strlen($packedIP, '8bit');
        $ipType = IpTypesSizeMap::getTypeByByteNumber($byteCount);
        if ($ipType === null) {
            throw new NotSupportedIpTypeException('Only IPv4 or IPv6 addresses are supported.');
        }
        $this->ip = $ip;
        $this->type = $ipType;
    }

    public function getIp() : string
    {
        return $this->ip;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function __toString() : string
    {
        return $this->ip;
    }
}
