<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_emails_sents', function (Blueprint $table) {
            
            $table->id();

            $table->string('nationalCode');

            $table->string('email')->unique();
            
            $table->string('code');

            $table->timestamp('code_expire');

            $table->longText('urlgenerated');

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
        Schema::dropIfExists('user_emails_sents');
    }
};
