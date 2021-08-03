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
        include_once '../class-ia-requests.php';
        $new = new InpsydeAskerweb\InpsydeAskerweb();
        $new_requests = $new->requests;
        $new_stylesScripts = $new->stylesScripts;
        self::assertNotFalse(has_action('init', [ $new_requests, 'createLink']));
        self::assertNotFalse(has_action('parse_request', [ $new, 'requestsInit' ]));
        self::assertNotFalse(has_action('parse_request', [ $new_requests, 'request' ]));
        self::assertNotFalse(has_action('wp_enqueue_scripts', [ $new_stylesScripts, 'enqueue' ]));
        self::assertNotFalse(has_action('plugins_loaded', [ $new, 'getData' ]));
    }
}