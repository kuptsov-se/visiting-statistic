<?php declare(strict_types = 1);

namespace App\Modules\Statistic\Visiting\Domain;

use App\Modules\Statistic\Visiting\Domain\Exception\NotAllowedVisitingCollectionItemException;
use ArrayObject;

class VisitsCollection extends ArrayObject
{
    /**
     * VisitsCollection constructor.
     *
     * @param array  $input
     * @param int    $flags
     * @param string $iteratorClass
     *
     * @throws NotAllowedVisitingCollectionItemException
     */
    public function __construct($input = [], $flags = 0, $iteratorClass = 'ArrayIterator')
    {
        foreach ($input as $item) {
            $this->validateIncomingItem($item);
        }
        parent::__construct($input, $flags, $iteratorClass);
    }

    /**
     * @param Visit $item
     *
     * @return void
     * @throws NotAllowedVisitingCollectionItemException
     */
    public function append($item) : void
    {
        $this->validateIncomingItem($item);
        parent::append($item);
    }

    /**
     * @param Visit $item
     *
     * @return void
     * @throws NotAllowedVisitingCollectionItemException
     */
    private function validateIncomingItem($item) : void
    {
        if (!$item instanceof Visit) {
            $givenItemType = is_object($item) ? get_class($item) : gettype($item);
            $errorMessage = sprintf('VisitsCollection can add only instance of Visit. Given: %s', $givenItemType);
            throw new NotAllowedVisitingCollectionItemException($errorMessage);
        }
    }
}
