<?php
/**
 * @author: lichv
 * @createTime: 2016-07-14 18:19
 * @description: 支付宝 手机网站支付 接口
 * @link      https://github.com/lichv/payment
 * 
 */

namespace Payment\Charge\Ali;

use Payment\Common\Ali\AliBaseStrategy;
use Payment\Common\Ali\Data\Charge\WapChargeData;
use Payment\Common\AliConfig;

class AliWapCharge extends AliBaseStrategy
{

    /**
     * 获取支付对应的数据完成类
     * @return string
     * @author lichv
     */
    protected function getBuildDataClass()
    {
        $this->config->method = AliConfig::WAP_PAY_METHOD;
        // 以下两种方式任选一种
        return WapChargeData::class;

        //return 'Payment\Common\Ali\Data\Charge\WapChargeData';
    }
}
