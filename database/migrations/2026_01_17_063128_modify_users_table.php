<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rename 'name' to 'uname'
            $table->renameColumn('name', 'uname');

            // Add LGU-specific columns
            $table->unsignedBigInteger('employee_id')->after('id');
            $table->dateTime('encoded_date')->nullable()->after('uname');
            $table->unsignedBigInteger('encoded_by')->nullable()->after('encoded_date');

            // Foreign keys
            $table->foreign('employee_id')->references('id')->on('employee_info');
            $table->foreign('encoded_by')->references('id')->on('employee_info');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['encoded_by']);
            $table->dropColumn(['employee_id', 'encoded_date', 'encoded_by']);
            $table->renameColumn('uname', 'name');
        });
    }
};
