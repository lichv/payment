<?php
/**
 * @author: lichv
 * @createTime: 2016-07-14 18:02
 * @description: 统一的异常处理类
 * @link      https://github.com/lichv/payment
 * 
 */

namespace Payment\Common;

class PayException extends \Exception
{
    /**
     * 获取异常错误信息
     * @return string
     * @author lichv
     */
    public function errorMessage()
    {
        return $this->getMessage();
    }
}
