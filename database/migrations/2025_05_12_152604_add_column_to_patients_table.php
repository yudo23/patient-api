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
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(["user_id"]);

            $table->string("name",255)->after("id");
            $table->string("id_type",255)->after("name");
            $table->string("id_no",255)->after("id_type");
            $table->string("gender",255)->after("id_no");
            $table->date("dob")->after("gender");
            $table->text("address")->after("dob");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->unsignedBigInteger("user_id")->after("id");

            $table->dropColumn([
                'name',
                'id_type',
                'id_no',
                'gender',
                'dob',
                'address'
            ]);
        });
    }
};
