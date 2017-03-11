<?php
/**
 * @author: lichv
 * @createTime: 2016-07-14 18:29
 * @description: QQ钱包 扫码支付  主要用于网站上
 * @link      https://github.com/lichv/payment
 * 
 */

namespace Payment\Charge\Qq;

use Payment\Common\Qq\Data\Charge\QrChargeData;
use Payment\Common\Qq\QqBaseStrategy;

class QqQrCharge extends QqBaseStrategy
{
    protected function getBuildDataClass()
    {
        $this->config->tradeType = 'NATIVE';//
        return QrChargeData::class;
    }

    /**
     * 处理扫码支付的返回值
     * @param array $ret
     * @return string  可生产二维码的uri
     * @author lichv
     */
    protected function retData(array $ret)
    {
        if ($this->config->returnRaw) {
            return $ret;
        }

        // 扫码支付，返回链接
        return $ret['code_url'];
    }
}
