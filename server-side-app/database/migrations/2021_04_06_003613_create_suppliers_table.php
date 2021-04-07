<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable();
            $table->string('supplier_number');
            $table->string('company_email_address');
            $table->string('status')->default('pending');
            $table->json('step1'); //array
            $table->json('step2'); //array
            $table->json('step3'); //array
            $table->json('step4'); //array
            $table->json('step6'); //array
            $table->softDeletes();
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
        Schema::dropIfExists('suppliers');

        Schema::table('supplier_forms', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
