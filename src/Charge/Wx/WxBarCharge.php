<?php
/**
 * @author: lichv
 * @createTime: 2017-03-06 18:29
 * @description: 微信 刷卡支付  对应支付宝的条码支付
 * @link      https://github.com/lichv/payment
 * 
 */

namespace Payment\Charge\Wx;

use Payment\Common\Weixin\Data\Charge\BarChargeData;
use Payment\Common\Weixin\WxBaseStrategy;
use Payment\Common\WxConfig;

class WxBarCharge extends WxBaseStrategy
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
        return WxConfig::MICROPAY_URL;
    }
}
