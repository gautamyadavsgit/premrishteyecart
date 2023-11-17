<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {Schema::table('users', function (Blueprint $table) {
        // Modify the 'created_at' column to use the current timestamp
        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->change();

        // Modify the 'updated_at' column to update on each record update
        $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->change();
    });  }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        // Schema::table('', function (Blueprint $table) {
        //     $table->timestamp('created_at')->default(null)->change();
        //     $table->timestamp('updated_at')->default(null)->change();
        // });
    }
};