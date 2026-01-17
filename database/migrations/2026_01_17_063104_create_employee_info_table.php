<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employee_info', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('birthday');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('contact_number');
            $table->string('employee_address');
            $table->date('hire_date');
            $table->date('end_of_contract_date')->nullable();
            $table->string('employee_group');
            $table->string('designation');
            $table->text('employee_remarks')->nullable();
            $table->integer('biometrics_no')->nullable();
            $table->double('rate_per_day', 10, 2);
            $table->unsignedBigInteger('department_id');
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_info');
    }
};
