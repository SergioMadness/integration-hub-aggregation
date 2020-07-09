<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Aggregation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('aggregation', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('item_id');
            $table->string('group');
            $table->jsonb('data');
            $table->timestamps();

            $table->unique(['group', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('aggregation');
    }
}
