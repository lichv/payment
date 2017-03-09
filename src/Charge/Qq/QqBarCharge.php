<?php
/**
 * @author: helei
 * @createTime: 2017-03-06 18:29
 * @description: 微信 刷卡支付  对应支付宝的条码支付
 * @link      https://github.com/helei112g/payment/tree/paymentv2
 * 
 */

namespace Payment\Charge\Qq;

use Payment\Common\Qq\Data\Charge\BarChargeData;
use Payment\Common\Qq\WxBaseStrategy;
use Payment\Common\QqConfig;

class QqBarCharge extends QqBaseStrategy
{
    protected function getBuildDataClass()
    {
        return BarChargeData::class;
    }

    /**
     * 刷卡支付 的请求地址是另外一个
     * @return string
     */
    protected function getReqUrl()
    {
        return QqConfig::MICROPAY_URL;
    }
}
