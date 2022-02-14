<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_roles', function (Blueprint $table) {
            $table->Integer('account_id');
            $table->unsignedInteger('role_id');

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            //SETTING THE PRIMARY KEYS
            $table->primary(['account_id','role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts_roles');
    }
}
