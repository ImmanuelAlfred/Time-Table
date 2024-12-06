<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTimeTablesTable extends Migration
{
    public function up()
    {
        Schema::table('time_tables', function (Blueprint $table) {
            $table->unsignedBigInteger('department_name_id')->nullable();
            $table->foreign('department_name_id', 'department_name_fk_10219221')->references('id')->on('departments');
        });
    }
}
