<?php
/**
 * Created by PhpStorm.
 * User: sbwdlihao
 * Date: 12/29/15
 * Time: 3:40 PM
 */

namespace Numbull\Warning\Plugin;

/**
 * Interface PluginInterface
 * @package Numbull\Warning\Plugin
 */
interface PluginInterface {
    /**
     * task type
     * @return string
     */
    public function getType();

    /**
     * task name
     * @return string
     */
    public function getName();

    /**
     * task description
     * @return string
     */
    public function getDescription();
    /**
     * @return array
     */
    public function showConfig();

    /**
     * @param array $config
     * @return string
     */
    public function createCrontabParams($config);

    /**
     * do task
     * @param array $params
     */
    public function action($params);
}