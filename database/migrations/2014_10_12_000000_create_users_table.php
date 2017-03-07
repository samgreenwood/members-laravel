<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('surname');

            $table->string('username')->unique();
            $table->string('password');

            $table->string('email')->unique();

            $table->date('birthday')->nullable()->default(null);
            $table->string('occupation')->nullable()->default(null);

            $table->boolean('forward_email')->default(false);

            $table->boolean('wia_member')->default(false);
            $table->string('callsign')->nullable();
            $table->string('affiliated_club')->nullable();

            $table->string('postal_address_1')->nullable()->default(null);
            $table->string('postal_address_2')->nullable()->default(null);
            $table->string('postal_address_suburb')->nullable()->default(null);
            $table->string('postal_address_state')->nullable()->default(null);
            $table->string('postal_address_postcode')->nullable()->default(null);
            $table->string('postal_address_country')->nullable()->default(null);

            $table->string('billing_address_1')->nullable()->default(null);
            $table->string('billing_address_2')->nullable()->default(null);
            $table->string('billing_address_suburb')->nullable()->default(null);
            $table->string('billing_address_state')->nullable()->default(null);
            $table->string('billing_address_postcode')->nullable()->default(null);
            $table->string('billing_address_country')->nullable()->default(null);


            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
