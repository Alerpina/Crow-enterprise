<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGsTranslationsAddPrivacyPolicy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('generalsetting_translations', 'privacy_policy')) {
            Schema::table('generalsetting_translations', function(Blueprint $table){
                $table->mediumText('privacy_policy')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('generalsetting_translations', 'privacy_policy')){
            Schema::table('generalsetting_translations', function (Blueprint $table) {
                $table->dropColumn('privacy_policy');
            });
        }
    }
}
