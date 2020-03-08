<?php namespace App\Migrations;

use Kernel\Database\Migration;

class MediaTableMigration extends Migration
{

    /**
     * name of the table to migrate
     **/
    protected $table = "media";


    /**
     * field names and data types for this table
     */
    public function __construct()
    {
        $this->increments('id');
        $this->int('user_id');
        $this->varchar('name');
        $this->varchar('extension', ['length' => 10]);
        $this->varchar('type', ['length' => 50]);
        $this->varchar('size');
        $this->int('created');
        $this->int('updated');
    }


    /**
     * Install the migration
     *
     * @return void
     * @throws \Exception
     */
    public function up()
    {
        return $this->install();
    }


    /**
     * Drop the table
     *
     * @return void
     */
    public function down()
    {
        return $this->uninstall();
    }

}