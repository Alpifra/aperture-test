<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        foreach (self::getSeeders() as $class) {
            $seeder = self::initialize($class);
            if (method_exists($seeder, 'run')) {
                $seeder->run();
            }
        }

    }
    
    /**
     * Get the list of all seeders
     *
     * @return array
     */
    private static function getSeeders()
    {
        return [
            LogSeeder::class,
        ];
    }
    
    /**
     * Initialize the class
     *
     * @param  mixed $class
     * @return object
     */
    private static function initialize($class)
    {
        $init = new $class();
        return $init;
    }
}
