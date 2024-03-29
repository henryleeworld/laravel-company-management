<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('category_company', function (Blueprint $table) {
            $table->unsignedInteger('company_id');
            $table->foreign('company_id', 'company_id_fk_2220843')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id', 'category_id_fk_2220843')->references('id')->on('categories')->onDelete('cascade');
        });
    }
};
