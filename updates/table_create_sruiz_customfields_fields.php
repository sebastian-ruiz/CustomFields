<?php namespace Bs\Bestanden\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class TableCreateSRuizCustomFieldsFields extends Migration
{
    public function up()
    {
        Schema::create('sruiz_customfields_fields', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('field_id');
            $table->string('type');
            $table->string('value');
            $table->string('subfields');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sruiz_customfields_fields');
    }
}
