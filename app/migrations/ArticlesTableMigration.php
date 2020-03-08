<?php namespace App\Migrations;

use Kernel\Database\Migration;

class ArticlesTableMigration extends Migration
{

    /**
     * name of the table to migrate
     **/
    protected $table = "articles";


    /**
     * field names and data types for this table
     */
    public function __construct()
    {
        $this->increments('id');
        $this->int('user_id');
        $this->varchar('title');
        $this->varchar('slug', [
            'unique' => true,
        ]);
        $this->longtext('content');
        $this->text('keywords', [
            'nullable' => true
        ]);
        $this->text('description', [
            'nullable' => true
        ]);
        $this->text('tags', [
            'nullable' => true
        ]);
        $this->varchar('published', [
            'length' => 3
        ]);
        $this->varchar('date_published');
        $this->int('created');
        $this->int('updated');
    }


    /**
     * Install the migration
     *
     * @return mixed
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