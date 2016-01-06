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
     * @var int
     */
    protected $_id;

    /**
     * PluginImp constructor.
     * @param int $id
     */
    public function __construct($id = 0)
    {
        $this->_id = $id;
    }

    /**
     * task type
     * @return string
     */
    public function getType()
    {
        return '';
    }

    /**
     * task name
     * @return string
     */
    public function getName()
    {
        return '';
    }

    /**
     * task description
     * @return string
     */
    public function getDescription()
    {
        return '';
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
        exit(json_encode(['name'=>$this->getName(), 'id'=>$this->_id, 'code'=>$code, 'message'=>$message]));
    }
}