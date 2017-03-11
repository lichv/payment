<?php
/**
 * @author: lichv
 * @createTime: 2016-07-14 17:56
 * @description: QQ钱包 app 支付接口
 * @link      https://github.com/lichv/payment
 * 
 */

namespace Payment\Charge\Qq;

use Payment\Common\Qq\Data\BackAppChargeData;
use Payment\Common\Qq\Data\Charge\AppChargeData;
use Payment\Common\Qq\QqBaseStrategy;

class QqAppCharge extends QqBaseStrategy
{
    protected function getBuildDataClass()
    {
        $this->config->tradeType = 'APP';
        return AppChargeData::class;
    }

    /**
     * 处理APP支付的返回值。直接返回与QQ钱包文档对应的字段
     * @param array $ret
     *
     * @return array $data
     *
     * ```php
     * $data = [
     *  'appid' => '',   // 应用ID
     *  'partnerid' => '',   // 商户号
     *  'prepayid'  => '',   // 预支付交易会话ID
     *  'package'   => '',  // 扩展字段  固定值：Sign=WXPay
     *  'noncestr'  => '',   // 随机字符串
     *  'timestamp' => '',   // 时间戳
     *  'sign'  => '',  // 签名
     * ];
     * ```
     * @author lichv
     */
    protected function retData(array $ret)
    {
        $back = new BackAppChargeData($this->config, $ret);

        $back->setSign();
        $backData = $back->getData();

        return $backData;
    }
}
