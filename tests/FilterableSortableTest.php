<?php

namespace RafflesArgentina\FilterableSortable;

use Orchestra\Testbench\TestCase;

class FilterableSortableTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->loadLaravelMigrations(['--database' => 'testbench']);

        $this->artisan('migrate', ['--database' => 'testbench']);

        $this->withFactories(__DIR__.'/factories');

        \Route::group([
            'middleware' => [],
            'namespace'  => 'RafflesArgentina\FilterableSortable',
        ], function ($router) {
            $router->get('/', 'TestController');
        });
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    function testResultsCanBeFiltered()
    {
        factory(\RafflesArgentina\FilterableSortable\Models\User::class, 100)->create();
        $results = $this->get('/?name=robert');
        $data = $results->getData();
        $this->assertTrue(count($data) < 100);
    }

    function testResultsCanBeSorted()
    {
        factory(\RafflesArgentina\FilterableSortable\Models\User::class, 100)->create();
        $results = $this->get('/');
        $data = $results->getData();
        $this->assertTrue(count($data) === 100);
    }
}
