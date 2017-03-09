<?php
/**
 * @author: lichv
 * @createTime: 2016-07-20 16:12
 * @description: 提供给客户端实现的 支付异步回调 接口
 *
 * @link      https://github.com/lichv/payment
 * 
 */

namespace Payment\Notify;

interface PayNotifyInterface
{
    /**
     * 异步回调检验完成后，回调客户端的业务逻辑
     *  业务逻辑处理，必须实现该类。
     *
     * @param array $data 返回的数据
     *
     * @return boolean
     * @author lichv
     */
    public function notifyProcess(array $data);
}
