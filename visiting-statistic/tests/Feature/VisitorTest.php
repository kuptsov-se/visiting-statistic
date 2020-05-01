<?php declare(strict_types = 1);

namespace App\Tests\Feature;

use App\Modules\Statistic\Visiting\DataLayer\Eloquent\VisitModel;
use Laravel\Lumen\Testing\DatabaseMigrations;
use TestCase;

class VisitorTest extends TestCase
{
    use DatabaseMigrations;

    public function testVisitFixed() : void
    {
        $visits = VisitModel::all();
        $this->assertEmpty($visits);
        $this->call('GET', '/');
        $this->assertResponseOk();
        $visits = VisitModel::all();
        $this->assertEquals(1, $visits->count());
    }
}
