<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('common_name');
            $table->string('official_name');
            $table->string('flag_emoji');
            $table->string('flag_png');
            $table->string('coat_of_arms');
            $table->string('tld');
            $table->string('female_demonym');
            $table->string('male_demonym');
            $table->boolean('independent');
            $table->boolean('unMember');
            $table->float('lat');
            $table->float('lng');
            $table->string('openstreetmap');
            $table->integer('population');
            $table->foreignId('region_id')->nullable()->constrained();
            $table->foreignId('continent_id')->nullable()->constrained();
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
        Schema::dropIfExists('country');
    }
}
