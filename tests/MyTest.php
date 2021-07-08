<?php
/**
 * InspydeAskerweb WordPress Plugin Test
 * php version 7.4
 *
 * @category WP_Plugin_Test
 * @package  InspydeAskerweb
 * @author   AskerWeb <askerweb@yandex.by>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/askerweb/inpsydetrialtask/
 */
namespace InpsydeAskerweb\Tests;
require_once 'MyTestCase.php';
use InpsydeAskerweb;

/**
 * Class MyTest
 *
 * @category WP_Plugin_Test
 * @package  Inspydeaskerweb
 * @author   AskerWeb <askerweb@yandex.by>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/askerweb/inpsydetrialtask/
 */
class MyTest extends MyTestCase
{
    /**
     * Test adding actions and filters
     *
     * @return void
     */
    public function testAddHooksActuallyAddsHooks():void
    {
        include_once '../inpsyde-askerweb.php';
        $new = new InpsydeAskerweb();
        self::assertNotFalse(has_action('init', [ $new, 'createLink']));
        self::assertNotFalse(has_action('parse_request', [ $new, 'request' ]));
        self::assertNotFalse(has_action('wp_enqueue_scripts', [ $new, 'enqueue' ]));
        self::assertNotFalse(has_action('plugins_loaded', [ $new, 'getData' ]));
    }
}