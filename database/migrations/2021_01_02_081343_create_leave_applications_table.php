<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->string('take_charge');
            $table->string('department');
            $table->mediumText('information')->nullable();
            $table->unsignedBigInteger('applier_user_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('status')->default('pending');
            $table->string('approval_level')->default(0);
            $table->unsignedBigInteger('leave_type_id');
            $table->unsignedBigInteger('authorizer_user_id')->nullable();
            $table->mediumText('remarks')->nullable();
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
        Schema::dropIfExists('leave_applications');
    }
}
