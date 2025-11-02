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
        Schema::create('spareparts', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sparepart', 30)->unique();
            $table->string('nama_sparepart');
            $table->foreignId('kategori_sparepart_id')->constrained('kategori_spareparts')->onDelete('cascade');
            $table->string('number_part')->unique()->nullable();
            $table->string('alternatif_number')->unique()->nullable();
            $table->string('satuan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spareparts');
    }
};
