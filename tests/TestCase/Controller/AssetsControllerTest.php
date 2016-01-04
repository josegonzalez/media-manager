<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AssetsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\AssetsController Test Case
 */
class AssetsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assets',
        'app.categories',
        'app.users',
        'app.githubs',
        'app.files',
        'app.tags',
        'app.assets_tags'
    ];

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
