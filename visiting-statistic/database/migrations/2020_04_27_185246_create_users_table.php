<?php

use App\Modules\Common\Domain\User\UserFields;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string(UserFields::NAME, 100)->nullable(false);
            $table->string(UserFields::EMAIL, 255)->nullable(false);
            $table->string(UserFields::PASSWORD, 255)->nullable(false);
            $table->timestamps();
            $table->timestamp(UserFields::DELETED_AT)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('users');
    }
}
