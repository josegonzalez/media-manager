<?php
use Cake\Utility\Hash;
use josegonzalez\Dotenv\Loader;

$config = [];
if (!env('APP_NAME')) {
    $dotenv = new Loader([
        __DIR__ . DS . '.env',
        __DIR__ . DS . '.env.default',
    ]);
    $dotenv->setFilters([
        'josegonzalez\Dotenv\Filter\LowercaseKeyFilter',
        'josegonzalez\Dotenv\Filter\UppercaseFirstKeyFilter',
        'josegonzalez\Dotenv\Filter\UnderscoreArrayFilter',
        function ($data) {
            $keys = [
                'Debug' => 'debug',
                'Emailtransport' => 'EmailTransport',
                'Database' => 'Datasources.default',
                'Test.database' => 'Datasources.test',
                'Test' => null,
                'Cache.duration' => null,
                'Cache.cakemodel' => 'Cache._cake_model_',
                'Cache.cakecore' => 'Cache._cake_core_',
            ];
            foreach ($keys as $key => $newKey) {
                if ($newKey === null) {
                    $data = Hash::remove($data, $key);
                    continue;
                }
                $value = Hash::get($data, $key);
                $data = Hash::remove($data, $key);
                $data = Hash::insert($data, $newKey, $value);
            }
            return $data;
        }
    ]);
    $dotenv->parse();
    $dotenv->filter();
    $config = $dotenv->toArray();
}
return $config;
