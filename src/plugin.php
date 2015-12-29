<?php
/**
 * Created by PhpStorm.
 * User: sbwdlihao
 * Date: 12/29/15
 * Time: 3:40 PM
 */

namespace Numbull\Warning\Plugin;

interface PluginInterface {
    public function showConfig();
    public function createCrontabParams();
    public function action();
}