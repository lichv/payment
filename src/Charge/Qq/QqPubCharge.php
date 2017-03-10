<?php
/**
 * @author: lichv
 * @createTime: 2016-07-14 18:28
 * @description: 微信 公众号 支付接口
 * @link      https://github.com/lichv/payment
 * 
 */

namespace Payment\Charge\Qq;

use Payment\Common\Qq\Data\BackPubChargeData;
use Payment\Common\Qq\Data\Charge\PubChargeData;
use Payment\Common\Qq\QqBaseStrategy;

/**
 * Class WxPubCharge
 *
 * 微信公众号支付
 *
 * @package Payment\Charge\Qq
 * anthor lichv
 */
class QqPubCharge extends QqBaseStrategy
{
    protected function getBuildDataClass()
    {
        $this->config->tradeType = 'JSAPI';
        return PubChargeData::class;
    }

    /**
     * 处理公众号支付的返回值。直接返回与微信文档对应的字段
     * @param array $ret
     *
     * @return string $data  包含以下键
     *
     * ```php
     * $data = [
     *  'appId' => '',   // 公众号id
     *  'package'   => '',  // 订单详情扩展字符串  统一下单接口返回的prepay_id参数值，提交格式如：prepay_id=***
     *  'nonceStr'  => '',   // 随机字符串
     *  'timeStamp' => '',   // 时间戳
     *  'signType'  => '',   // 签名算法，暂支持MD5
     *  'paySign'  => '',  // 签名
     * ];
     * ```
     * @author lichv
     */
    protected function retData(array $ret)
    {
        $back = new BackPubChargeData($this->config, $ret);

        $back->setSign();
        $backData = $back->getData();

        $backData['paySign'] = $backData['sign'];
        // 移除sign
        unset($backData['sign']);

        return json_encode($backData, JSON_UNESCAPED_UNICODE);// 格式化为json数据
    }
}
