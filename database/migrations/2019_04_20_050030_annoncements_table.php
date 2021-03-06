<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnnoncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        // delete the old table
        Schema::dropIfExists("information");

        Schema::create("announcement",function (Blueprint $table){

            // id
            $table->increments("id")->comment("id");

            // summary
            $table->string("summary")
                ->default("日常公告=w=")
                ->nullable(false)
            ->comment("概要");

            // 内容
            $table->text("content")
                ->default(null)
                ->nullable(true)
                ->comment("公告");

            // 最后编辑
            $table->timestamp("last_edit_time")
                ->nullable(true)
                ->useCurrent()
                ->comment("最后编辑时间");

            // 发布时间
            $table->timestamp("add_time")
                ->nullable(true)
                ->useCurrent()
                ->comment("发布时间");

        });

        DB::statement("ALTER TABLE announcement AUTO_INCREMENT = 10000;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists("announcement");

        Schema::create("information",function (Blueprint $table){
            $table->text("Announcement")
                ->nullable(true)
                ->default(null)
                ->comment("公告");
        });
    }
}
