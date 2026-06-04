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
    Schema::create('compras', function (Blueprint $table) {
        $table->id();
        $table->string('folio', 20)->unique();
        $table->date('fecha');
        $table->foreignId('producto_id')->constrained()->onDelete('cascade');
        $table->integer('cantidad');
        $table->decimal('precio_compra', 10, 2);
        $table->string('proveedor', 100);
        $table->decimal('total', 10, 2);
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
