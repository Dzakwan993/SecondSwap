<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationColumnsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('regency_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            // Tambahkan constraint foreign key jika diperlukan
            // $table->foreign('province_id')->references('id')->on('provinces');
            // $table->foreign('regency_id')->references('id')->on('regencies');
            // $table->foreign('district_id')->references('id')->on('districts');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('province_id');
            $table->dropColumn('regency_id');
            $table->dropColumn('district_id');
        });
    }
}
