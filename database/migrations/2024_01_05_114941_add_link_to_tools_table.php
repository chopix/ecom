<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->json('links')->nullable()->after('title');
            $table->string('main_link')->nullable()->after('links');
            $table->string('extension')->nullable()->after('main_link');
            $table->boolean('is_active')->default(true)->after('extension');
        });
    }

    public function down()
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->dropColumn(['links', 'main_link', 'extension', 'is_active']); 
        });
    }
};
