<?php
/**
 * Created by PhpStorm.
 * User: sbwdlihao
 * Date: 12/29/15
 * Time: 4:06 PM
 */

namespace Numbull\Warning\Plugin;


/**
 * Class PluginImp
 * @package Numbull\Warning\Plugin
 */
class PluginImp implements PluginInterface
{

    /**
     * @return array
     */
    public function showConfig()
    {
        return [];
    }

    /**
     * @param array $config
     * @return string
     */
    public function createCrontabParams($config)
    {
        return implode(' ', $config);
    }

    /**
     * do task
     * @param array $params
     */
    public function action($params)
    {
        $this->_showResult();
    }

    /**
     * @param string $name
     * @param int $code
     * @param string $message
     */
    protected function _showResult($name = '', $code = 200, $message = 'success') {
        exit(json_encode(['name'=>$name, 'code'=>$code, $message=>$message]));
    }
}