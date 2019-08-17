<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPaymentTypeInPaymentRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_recipients', function (Blueprint $table) {
            $table->bigInteger('payment_type_id')->unsigned()->nullable();
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {  
        if (Schema::hasColumn('payment_recipients', 'payment_type_id'))

        {
            Schema::table('payment_recipients', function (Blueprint $table)

            {
                $table->dropForeign('payment_type_id');
                $table->dropColumn('payment_type_id');

            });

        }
    }
}
