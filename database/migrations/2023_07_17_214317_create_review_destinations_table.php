<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_destinations', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->integer('star');
            $table->text('description');
            $table->foreignUuid('created_by')->constrained('users')->cascadeOnDelete(true);
            $table->foreignUuid('destination_id')->constrained('destinations')->cascadeOnDelete(true);
            $table->timestamps();
            $table->unique(['destination_id', 'created_by']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_destinations');
    }
}
