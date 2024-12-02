<?php

namespace Tests\Unit;

use App\utils\AuthFileUtils;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    /*
    public function test_file_utils(): void
    {

        $date = date_create();
        $credentials = ['id'=>1,
            'name'=>'Teszt Elek',
            'email' => 'test@example.com',
            'password'=>'password',
            'birthday' => DateTimeImmutable::createFromFormat("Y-m-d",'1987-12-01'),
            'created_at' => $date, '
            updated_at' => $date];
        AuthFileUtils::createFile($credentials);
        $fileName = '/home/pzoli/temp/'.$credentials['email'].".json";
        $this->assertTrue(file_exists($fileName));
    }
    */
}
