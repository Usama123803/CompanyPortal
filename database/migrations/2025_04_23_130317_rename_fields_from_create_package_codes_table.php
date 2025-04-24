<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFieldsFromCreatePackageCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('package_codes', function (Blueprint $table) {
            $table->renameColumn('package_code', 'code');
            $table->renameColumn('package_type', 'type');
            $table->renameColumn('package_start_date', 'start_date');
            $table->renameColumn('package_end_date', 'end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('package_codes', function (Blueprint $table) {
            $table->renameColumn('code', 'package_code');
            $table->renameColumn('type', 'package_type');
            $table->renameColumn('start_date', 'package_start_date');
            $table->renameColumn('end_date', 'package_end_date');
        });
    }
}
