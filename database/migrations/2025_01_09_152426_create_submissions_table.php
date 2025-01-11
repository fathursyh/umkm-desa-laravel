<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('umkm_name');
            $table->date('establishment_date');
            $table->string('business_type');
            $table->text('description');
            $table->string('application_letter');
            $table->string('rab_document');
            $table->enum('status', ['pending', 'approved', 'rejected', 'revision'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};