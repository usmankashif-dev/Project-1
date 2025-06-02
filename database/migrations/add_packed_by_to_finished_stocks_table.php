<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('finished_stocks', function (Blueprint $table) {
            $table->string('packed_by')->nullable();
        });
    }
    public function down()
    {
        Schema::table('finished_stocks', function (Blueprint $table) {
            $table->dropColumn('packed_by');
        });
    }
};
