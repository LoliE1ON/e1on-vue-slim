<?php


use Phinx\Migration\AbstractMigration;

class VrchatTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $statistics = $this->table('vrchat');
        $statistics->addColumn('auth', 'string', ['limit' => 100])
            ->addColumn('apiKey', 'string', ['limit' => 100])
            ->addColumn('login', 'string', ['limit' => 100])
            ->addColumn('password', 'string', ['limit' => 100])
            ->create();

        // inserting only one row
        $singleRow = [
            'id'    => 1,
            'auth'  => '',
            'apiKey' => 'JlE5Jldo5Jibnk5O5hTx6XVqsJu4WJ26',
            'login' => 'Loli E1ON',
            'password' => ''
        ];

        $table = $this->table('vrchat');
        $table->insert($singleRow);
        $table->saveData();

    }
}
