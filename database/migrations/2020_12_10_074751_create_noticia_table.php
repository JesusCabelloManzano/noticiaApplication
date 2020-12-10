<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiaTable extends Migration
{
    public function up() //create table
    {
        Schema::create('noticia', function (Blueprint $table) {
            $table->id();

            $table->string('titulo', 150);
            $table->text('texto');
            $table->bigInteger('idautor')->unsigned();
            $table->date('fecha');

            $table->timestamps();
            
            $table->foreign('idautor')->references ('id')->on('autor');
            $table->unique(['idautor', 'titulo']);
        });
        
        DB::statement("ALTER TABLE noticia ADD imagen LONGBLOB NULL");
    }
    
    public function down() //drop table
    {
        Schema::dropIfExists('ticket');
    }
}
