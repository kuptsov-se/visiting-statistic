<?php

use App\Modules\Statistic\Visiting\DataLayer\Eloquent\VisitModelFields;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : Void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string(VisitModelFields::IP, 100)->nullable(false);
            $table->timestamp(VisitModelFields::DATE)->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('visits');
    }
}
