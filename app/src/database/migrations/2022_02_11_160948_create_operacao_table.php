<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Operacao\Tipo;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operacao', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('loja_id')
                ->nullable(false);

            $table->enum('tipo', Tipo::getValues())
                ->nullable(false);

            $table->string('cartao', 255);
            $table->string('cpf', 255);
            $table->decimal('valor');
            $table->dateTime('data');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('loja_id')
                ->references('id')
                ->on('loja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operacao');
    }
};
