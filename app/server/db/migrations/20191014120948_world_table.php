<?php


use Phinx\Migration\AbstractMigration;

class WorldTable extends AbstractMigration
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
        $statistics = $this->table('world');
        $statistics->addColumn('worldId', 'string', ['limit' => 100])
            ->addColumn('jsonData', 'text')
            ->addColumn('updateTimeJsonData', 'integer', ['limit' => 100])
            ->create();

        // inserting multiple rows
        $rows = [
            [
                'id'    => 1,
                'worldId'  => 'wrld_c5796060-01b4-49af-a555-1ee3a4af8503',
                'jsonData' => '',
                'updateTimeJsonData' => 0
            ],
            [
                'id'    => 2,
                'worldId'  => 'wrld_fac11e5f-1c73-4436-8936-a70b80961c5a',
                'jsonData' => '',
                'updateTimeJsonData' => 0
            ],
        ];

        $this->table('world')->insert($rows)->save();
    }
}
