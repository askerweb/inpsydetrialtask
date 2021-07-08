<?php
namespace InpsydeAskerweb\Tests;

use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Brain\Monkey;
class MyTestCase extends TestCase {

    use MockeryPHPUnitIntegration;

    protected function setUp():void {
        parent::setUp();
        Monkey\setUp();
    }

    protected function tearDown():void {
        Monkey\tearDown();
        parent::tearDown();
    }
}