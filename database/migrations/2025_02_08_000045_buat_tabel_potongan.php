<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('potongan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('slip_gaji_id');
        $table->decimal('pajak', 10, 2)->nullable();
        $table->decimal('bpjs', 10, 2)->nullable();
        $table->decimal('potongan_lainnya', 10, 2)->nullable();
        $table->timestamps();

        $table->foreign('slip_gaji_id')->references('id')->on('slip_gaji')->onDelete('cascade');
    });
}

    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
