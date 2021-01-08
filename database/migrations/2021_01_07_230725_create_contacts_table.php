<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('email')->default("");
            $table->string('phone')->default("");
            $table->string('firstName')->default("");
            $table->string('lastName')->default("");
            $table->string('orgid')->default("");
            $table->string('orgname')->default("");
            $table->string('bounced_hard')->default("");
            $table->string('bounced_soft')->default("");
            $table->string('bounced_date')->nullable()->default(null);
            $table->string('ip')->default(""); 
            $table->string('ua')->nullable()->default(null);
            $table->string('hash')->default("");
            $table->string('socialdata_lastcheck')->nullable()->default(null); // 
            $table->string('email_local')->default("");
            $table->string('email_domain')->default("");
            $table->string('sentcnt')->default("");
            $table->string('rating_tstamp')->nullable()->default(null); // 
            $table->string('gravatar')->default("");
            $table->string('deleted')->default("");
            $table->string('anonymized')->default("");
            $table->string('organization')->nullable()->default(null);
            
            $table->string('cdate')->nullable()->default(null);
            $table->string('adate')->nullable()->default(null);
            $table->string('udate')->nullable()->default(null);
            $table->string('edate')->nullable()->default(null);
            $table->string('created_utc_timestamp')->nullable()->default(null);
            $table->string('updated_utc_timestamp')->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
