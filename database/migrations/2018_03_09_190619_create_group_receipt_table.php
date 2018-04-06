<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'group_receipt', function ( Blueprint $table ) {
            $table->bigInteger( 'group_id' );
            $table->bigInteger( 'receipt_id' );
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('receipt_id')->references('id')->on('receipts');
            $table->unique( [ 'receipt_id', 'group_id' ] );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'group_receipt' );
    }
}
