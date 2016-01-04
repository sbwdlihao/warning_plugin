<?php
/**
 * Created by PhpStorm.
 * User: sbwdlihao
 * Date: 1/4/16
 * Time: 2:19 PM
 */

namespace Numbull\Warning\Plugin;


/**
 * Class Slink
 * @package Numbull\Warning\Plugin
 */
class Slink
{
    /**
     * @var
     */
    private $_server;
    /**
     * @var
     */
    private $_port;
    /**
     * @var
     */
    private $_fp;

    /**
     * Slink constructor.
     * @param $server
     * @param $port
     */
    public function __construct($server, $port)
    {
        $this->_server = $server;
        $this->_port = $port;
    }

    public function __destruct()
    {
        if (is_resource($this->_fp)) {
            fclose($this->_fp);
        }
    }

    /**
     * @param string $code
     * @param array $param
     * @param bool $line
     * @param bool $column
     * @return array
     */
    public function query($code="", $param=array(), $line=false, $column=false)
    {
        if(!$this->_fp)
        {
            @$this->_fp=fsockopen($this->_server, $this->_port, $error_no, $error_str, 5);
            if(!$this->_fp)
            {
                return ['success'=>false, 'data'=>'db:无法连接服务器'];
            }
        }
        if (is_string($param)) {
            $param = array($param);
        }
        $query=array('code'=>$code, 'params'=>array_values($param));
        fwrite($this->_fp, json_encode($query).'/*END*/');

        stream_set_blocking($this->_fp, true);
        stream_set_timeout($this->_fp, 30);
        $response=fread($this->_fp,8192);
        while(strpos($response,'/*END*/')===false)
        {
            $response.=fread($this->_fp,8192);
        }
        $response=substr($response,0,-7);
        $data=json_decode($response,true);

        if($data['result']==false)
        {
            return ['success'=>false, 'data'=>'db:'.$data['message']."($code)".serialize($param)];
        }
        if($data['code']!=$code)
        {
            return ['success'=>false, 'data'=>"db:返回编码不一致\trequest code:$code\tresponse code:{$data['code']}"];
        }

        $data=$data['data'];

        $op=(int)substr($code,3,1);
        if($op===1 || $op===5)
        {
            $list=$data;
            if($line!==false)
            {
                if(!isset($list[$line]))
                {
                    $data= array();
                }
                else
                {
                    $arr=$list[$line];
                    if($column!==false)
                    {
                        $arr=array_values($arr);
                        if(isset($arr[$column]))
                        {
                            $data= $arr[$column];
                        }
                        else
                        {
                            $data= null;
                        }
                    }
                    else
                    {
                        $data= $arr;
                    }
                }
            }
            else
            {
                $data= $list;
            }
        }
        elseif($op===2)
        {
            $data = $data[0]['insertId'];
        }
        elseif($op===3 || $op===4)
        {
            $data = $data[0]['affectedRows'];
        }
        else
        {
            $data=$query;
        }

        return ['success'=>true, 'data'=>$data];
    }
}