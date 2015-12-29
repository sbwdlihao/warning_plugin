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
/**
 * Class PluginImp
 * @package Numbull\Warning\Plugin
 */
class PluginImp implements PluginInterface
{
    /**
     * @var string
     */
    protected $_name;

    /**
     * @var int
     */
    protected $_id;

    /**
     * PluginImp constructor.
     * @param string $name
     * @param int $id
     */
    public function __construct($name = '', $id = 0)
    {
        $this->_name = $name;
        $this->_id = $id;
    }

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
     * @param int $code
     * @param string $message
     */
    protected function _showResult($code = 200, $message = 'success') {
        exit(json_encode(['name'=>$this->_name, 'id'=>$this->_id, 'code'=>$code, 'message'=>$message]));
    }
}