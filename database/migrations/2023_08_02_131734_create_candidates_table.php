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
            Schema::create('candidates', function (Blueprint $table)
            {
                $table->id();
                $table->unsignedBigInteger('owner_id');
                $table->string('first_name');
                $table->string('last_name');
                $table->integer('age');
                $table->string('department');
                $table->string('min_salary_expectation');
                $table->string('max_salary_expectation');
                $table->unsignedBigInteger('currency_id');
                $table->unsignedBigInteger('address_id');
                // Foreign keys
                $table->foreign('owner_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
                $table->foreign('currency_id')
                    ->references('id')
                    ->on('currencies')
                    ->onDelete('cascade');
                $table->foreign('address_id')
                    ->references('id')
                    ->on('addresses')
                    ->onDelete('cascade');

                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down():
            void
            {
                Schema::dropIfExists('candidates');
            }
        };
        
