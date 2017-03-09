<?php
/**
 * @author: lichv
 * @createTime: 2016-07-28 16:45
 * @description: 所有的策略类接口
 */

namespace Payment\Common;

interface BaseStrategy
{
    /**
     * 处理具体的业务
     * @param array $data
     * @return mixed
     * @author lichv
     */
    public function handle(array $data);
}
