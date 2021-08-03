<?php

/**
 * InspydeAskerweb WordPress Plugin
 * php version 7.4
 *
 * @category WP_Plugin
 * @package  InspydeAskerweb
 * @author   AskerWeb <askerweb@yandex.by>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/askerweb/inpsydetrialtask/
 */

/*
 * Plugin Name: Askerweb Test Task
 * Plugin URI: https://github.com/askerweb/inpsydetrialtask/
 * Description: Askerweb Test Task
 * Version: 1.0.0
 * Author: Askerweb
 * Author URI: https://askerweb.by/
 * License: MIT
 */
namespace InpsydeAskerweb;

/**
 * Class InpsydeAskerweb
 *
 * @category WP_Plugin
 * @package  Inspydeaskerweb
 * @author   AskerWeb <askerweb@yandex.by>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/askerweb/inpsydetrialtask/
 */
class InpsydeAskerweb
{
    /**
     * URL for request
     *
     * @var string $_url
     */
    private string $_url = "https://jsonplaceholder.typicode.com/users";

    /**
     * Response data
     *
     * @var array $_data
     */
    private array $_data = array();

    /**
     * Array of errors
     *
     * @var array $_error
     */
    private array $_error = array();


    /**
     * Instance of the class for working with requests
     *
     * @var Requests $requests
     */
    public Requests $requests;

    /**
     * Instance of the class for working with style and scripts
     *
     * @var StylesScripts $stylesScripts
     */
    public StylesScripts $stylesScripts;

    /**
     * InpsydeAskerweb constructor.
     */
    public function __construct()
    {
        require_once 'class-ia-requests.php';
        //$this->requests = new InpsydeAskerweb\Requests();
        $this->requests = new Requests();
        require_once 'class-ia-stylesscripts.php';
        $this->stylesScripts = new StylesScripts();
        $this->addHooks();
    }

    /**
     * Add all needed actions and filters
     *
     * @return void
     */
    public function addHooks(): void
    {
        add_action('plugins_loaded', [$this, 'getData'], 20);
        add_action('wp_enqueue_scripts', [$this->stylesScripts, 'enqueue']);
        add_action('parse_request', [ $this, 'requestsInit'], 19);
        add_action('parse_request', [ $this->requests, 'request'], 20);
        add_action('init', [ $this->requests, 'createLink'], 20);
    }



    /**
     * Get data from $this->url and set response to $this->data
     *
     * @return void
     */
    public function getData(): void
    {
        $response = wp_remote_get(
            $this->_url,
            ['header' => ['Cache-Control' => 'must-revalidate,max-age=3600']]
        );
        if (!($response instanceof WP_Error) && $response['response']['code'] == 200) {
            if (!empty($response['body'])) {
                $data = (array)json_decode($response['body']);
                $this->_data = $data;
            } else {
                $this->_error[] = apply_filters(
                    'inpsydeaskerweb_empty_data',
                    'Данных нет'
                );
            }
        } else {
            $this->_error[] = apply_filters(
                'inpsydeaskerweb_response_error',
                'Ошибка получения данных'
            );
        }
    }

    /**
     * Initialize requests Class
     *
     * @return void
     */
    public function requestsInit(): void
    {
        $this->getData();
        $this->requests->init($this->_data, $this->_error);
    }
}

$IA = new InpsydeAskerweb();
