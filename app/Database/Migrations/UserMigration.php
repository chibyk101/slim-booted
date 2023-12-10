<?php

use App\Database\DB;
use Doctrine\DBAL\Schema\Table;

return new class
{
    private DB $dB;

    public function __construct()
    {
        $this->dB = new DB;
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $schema = $this->dB->schema();
        $table = new Table('users');
        $table->addColumn("id", "bigint", ["unsigned" => true, 'autoIncrement' => true]);
        $table->addColumn("name", "string", ["length" => 50]);
        $table->addColumn("email", "string", ["length" => 32]);
        $table->addColumn("password", "string", []);
        $table->addColumn("created_at", "datetime", ['default' => 'CURRENT_TIMESTAMP']);
        $table->addColumn('deleted_at', 'datetime', ['notNull' => false]);
        $table->setPrimaryKey(["id"]);
        $table->addUniqueIndex(["email"]);

        $schema->createTable($table);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if ($this->dB->schema()->tablesExist('users')) {
            $this->dB->schema()->dropTable('users');
        }
    }
};
