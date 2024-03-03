<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Browser;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\DB;
use Livewire\LivewireServiceProvider;
use LivewireDuskTestbench\TestCase as LivewireDuskTestbenchTestCase;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;
use Rappasoft\LaravelLivewireTables\Tests\Browser\LaravelLivewireTablesTestServiceProvider;
use Rappasoft\LaravelLivewireTables\Tests\Unit\Models\{Breed,Pet,Species,Veterinary};

class TestCase extends LivewireDuskTestbenchTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        if (! Breed::where('id', 1)->get()) {
            include_once __DIR__.'/../../database/migrations/create_test_tables.php.stub';
            (new \CreateTestTables())->down();
            (new \CreateTestTables())->up();

            Species::insert([
                ['id' => 1, 'name' => 'Cat'],
                ['id' => 2, 'name' => 'Dog'],
                ['id' => 3, 'name' => 'Horse'],
                ['id' => 4, 'name' => 'Bird'],
            ]);

            Breed::insert([
                ['id' => 1, 'name' => 'American Shorthair', 'species_id' => 1],
                ['id' => 2, 'name' => 'Maine Coon', 'species_id' => 1],
                ['id' => 3, 'name' => 'Persian', 'species_id' => 1],
                ['id' => 4, 'name' => 'Norwegian Forest', 'species_id' => 1],
                ['id' => 100, 'name' => 'Beagle', 'species_id' => 2],
                ['id' => 101, 'name' => 'Corgi', 'species_id' => 2],
                ['id' => 102, 'name' => 'Red Setter', 'species_id' => 2],
                ['id' => 200, 'name' => 'Arabian', 'species_id' => 3],
                ['id' => 201, 'name' => 'Clydesdale', 'species_id' => 3],
                ['id' => 202, 'name' => 'Mustang', 'species_id' => 3],
            ]);

            Pet::insert([
                ['id' => 1, 'name' => 'Cartman', 'age' => 22, 'species_id' => 1, 'breed_id' => 4, 'last_visit' => '2023-01-04', 'favorite_color' => '#000000'],
                ['id' => 2, 'name' => 'Tux', 'age' => 8, 'species_id' => 1, 'breed_id' => 4, 'last_visit' => '2023-02-04', 'favorite_color' => '#FF0000'],
                ['id' => 3, 'name' => 'May', 'age' => 2, 'species_id' => 2, 'breed_id' => 102, 'last_visit' => null, 'favorite_color' => '#00FF00'],
                ['id' => 4, 'name' => 'Ben', 'age' => 5, 'species_id' => 3, 'breed_id' => 200, 'last_visit' => '2023-04-04', 'favorite_color' => '#0000FF'],
                ['id' => 5, 'name' => 'Chico', 'age' => 7, 'species_id' => 3, 'breed_id' => 202, 'last_visit' => '2023-05-04', 'favorite_color' => '#FFFFFF'],
            ]);

            Veterinary::insert([
                ['id' => 1, 'name' => 'Dr John Smith', 'phone' => '123456798'],
                ['id' => 2, 'name' => 'Dr Fabio Ivona', 'phone' => '789456123'],
                ['id' => 3, 'name' => 'Dr Anthony Rappa', 'phone' => '987654321'],
            ]);

            DB::table('pet_veterinary')->insert([
                ['id' => 1, 'pet_id' => 1, 'veterinary_id' => 1],
                ['id' => 2, 'pet_id' => 1, 'veterinary_id' => 2],
                ['id' => 3, 'pet_id' => 2, 'veterinary_id' => 1],
                ['id' => 4, 'pet_id' => 2, 'veterinary_id' => 3],
            ]);
        }

    }

    public array $packageProviders = [
        LaravelLivewireTablesServiceProvider::class,
        LaravelLivewireTablesTestServiceProvider::class,
        BladeIconsServiceProvider::class,
        BladeHeroiconsServiceProvider::class,

    ];

    public function viewsDirectory(): string
    {
        // Resolves to 'tests/Browser/views'
        return __DIR__.'/views';
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('app.key', Encrypter::generateKey(config('app.cipher')));
        config()->set('app.env', 'testing');
        config()->set('cache.default', 'array');
        config()->set('view.cache', false);
        config()->set('view.compiled', realpath(storage_path('framework/views')).'/'.rand(0, 100));

        $app['config']->set('app.env', 'testing');
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('cache.default', 'array');
        $app['config']->set('view.cache', false);
        $app['config']->set('view.compiled', realpath(storage_path('framework/views')).'/'.rand(0, 100));

        if (file_exists(__DIR__.'/../../database/sqlite.database')) {
            $app['config']->set('database.connections.sqlite', [
                'driver' => 'sqlite',
                'database' => __DIR__.'/../../database/sqlite.database',
                'prefix' => '',
            ]);
        } else {
            $app['config']->set('database.connections.sqlite', [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]);
        }
    }
}
