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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('product');
            $table->string('secton');
            $table->string('discount');
            $table->string('rate_vat');
            $table->decimal('value_vat', 8, 2); //To make the total num of nums before point 8 and after point 2
            $table->decimal('total', 8, 2);
            $table->string('status', 50);
            $table->integer('value_status'); //To know the status of invoice مدفوع جزئيه,مدفوع كلى
            $table->text('note')->nullable();
            $table->string('user');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
