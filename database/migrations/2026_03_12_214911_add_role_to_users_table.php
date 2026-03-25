<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Creamos la columna role como un entero, por defecto 3 (Aprendiz)
            // Se ubicará después del email para mantener orden
            $table->integer('role')->default(3)->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Esto elimina la columna si alguna vez haces un rollback
            $table->dropColumn('role');
        });
    }
};
