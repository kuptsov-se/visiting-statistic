<?php declare(strict_types = 1);

namespace App\Http\Middleware;

use App\Modules\Common\ValueObject\Ip\Exception\InvalidIpFormatException;
use App\Modules\Common\ValueObject\Ip\Exception\NotSupportedIpTypeException;
use App\Modules\Common\ValueObject\Ip\Ip;
use App\Modules\Statistic\Visiting\Application\VisitService;
use Closure;
use DateTime;
use Illuminate\Support\Facades\Request as RequestFacade;
use Symfony\Component\HttpFoundation\Request;

class Visitor
{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     * @throws InvalidIpFormatException
     * @throws NotSupportedIpTypeException
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var VisitService $visitsService */
        $visitsService = app(VisitService::class);
        $visitUserIP = RequestFacade::ip() ?? Ip::UNDEFINED_IP;
        $visitsService->fixateVisit(new Ip($visitUserIP), new DateTime());
        return $next($request);
    }
}
