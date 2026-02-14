<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proprietarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo', 255);
            $table->char('sexo', 1);
            $table->date('data_nascimento');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE gabriel.proprietarios ADD CONSTRAINT check_sexo CHECK (sexo IN ('M', 'F'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proprietarios');
    }
};
