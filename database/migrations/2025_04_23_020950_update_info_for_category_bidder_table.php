<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('category_bidder', function (Blueprint $table) {
            $table->string('address')->after('name')->nullable();
            $table->string('phone')->after('address')->nullable();
            $table->string('fax')->after('phone')->nullable();
            $table->string('tk')->after('fax')->nullable();
            $table->string('tax_code')->after('tk')->nullable();
            $table->string('represent')->after('tax_code')->nullable();
            $table->string('gender')->after('represent')->nullable();
            $table->string('position')->after('gender')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_bidder', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'phone',
                'fax',
                'tk',
                'tax_code',
                'represent',
                'gender',
                'position',
            ]);
        });
    }
};
