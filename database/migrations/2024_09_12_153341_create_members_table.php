<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            // 이거 순서 중요함 아래 순서대로 필드가 생기는거임.
            $table->id(); //기본키

            $table->string('uid',20);
            $table->string('pwd',20);
            $table->string('name',20);

            $table->string('tel',11)->nullable();
            $table->tinyinteger('rank')->nullable()->default(0);

            $table->timestamps();
            // 필드2개를 더 추가함 필드엣 크리에이트엣 시간과 날짜를 기록 
            // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
