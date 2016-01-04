<?php
use Migrations\AbstractMigration;

class CreateAssetsTags extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('assets_tags');
        $table->addColumn('asset_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('tag_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addIndex([
            'asset_id',
            'tag_id',
        ], [
            'name' => 'ASSET_TAG',
            'unique' => true,
        ]);
        $table->create();
    }
}
