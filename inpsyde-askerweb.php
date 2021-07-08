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
     * Endpoint
     *
     * @var string $_pagename
     */
    private string $_pagename = "users-table";

    /**
     * InpsydeAskerweb constructor.
     */
    public function __construct()
    {
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
        add_action('init', [$this, 'createLink'], 20);
        add_action('parse_request', [$this, 'request']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue']);
    }

    /**
     * Create custom endpoints
     *
     * @return void
     */
    public function createLink(): void
    {
        $this->_pagename = (string)apply_filters(
            'inpsydeaskerweb_page_link',
            $this->_pagename
        );
        add_rewrite_rule(
            $this->_pagename . '/?$',
            'index.php?pagename=' . $this->_pagename
        );
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
        if (!($response instanceof WP_Error)
            && $response['response']['code'] == 200
        ) {
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
     * If its page $this->._pagename load "userstables.php" template
     *
     * @param $wp WP WordPress environment instance
     *
     * @return void
     */
    public function request($wp): void
    {

        if ($wp->query_vars['pagename'] == $this->_pagename) {
            $args = array(
                'users' => $this->_data,
                'errors' => $this->_error
            );
            $overridden_template= locate_template('inpsyde-askerweb/userstable.php');
            if ($overridden_template) {
                load_template($overridden_template, true, $args);
            } else {
                load_template(__DIR__ . '/templates/userstable.php', true, $args);
            }
            exit();
        }
    }

    /**
     * Connects all needed styles and scripts
     *
     * @return void
     */
    public function enqueue(): void
    {
        wp_enqueue_script(
            'main',
            plugins_url('assets/js/main.min.js', __FILE__),
            [],
            '',
            true
        );
        wp_enqueue_style(
            'main',
            plugins_url('assets/css/main.min.css', __FILE__)
        );
    }

}

$IA = new InpsydeAskerweb();
