<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():
        void
        {
            Schema::create('education', function (Blueprint $table)
            {

                $table->id();
                $table->unsignedBigInteger('candidate_id');
                $table->string('school');
                $table->string('degree');
                $table->string('major');
                // Foreign keys
                $table->foreign('candidate_id')
                    ->references('id')
                    ->on('candidates')
                    ->onDelete('cascade');;

                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down():
            void
            {
                Schema::dropIfExists('education');
            }
        };
        
