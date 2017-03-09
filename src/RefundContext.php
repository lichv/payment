<?php
/**
 * @author: lichv
 * @createTime: 2016-07-27 17:42
 * @description: 退款统一接口
 * @link      https://github.com/lichv/payment
 * 
 */

namespace Payment;

use Payment\Common\BaseStrategy;
use Payment\Common\PayException;
use Payment\Refund\AliRefund;
use Payment\Refund\WxRefund;
use Payment\Refund\QqRefund;

class RefundContext
{
    /**
     * 退款的渠道
     * @var BaseStrategy
     */
    protected $refund;


    /**
     * 设置对应的退款渠道
     * @param string $channel 退款渠道
     *  - @see Config
     *
     * @param array $config 配置文件
     * @throws PayException
     * @author lichv
     */
    public function initRefund($channel, array $config)
    {
        try {
            switch ($channel) {
                case Config::ALI_REFUND:
                    $this->refund = new AliRefund($config);
                    break;
                case Config::WX_REFUND:
                    $this->refund = new WxRefund($config);
                    break;
                case Config::QQ_REFUND:
                    $this->refund = new QqRefund($config);
                    break;
                default:
                    throw new PayException('当前仅支持：ALI WEIXIN两个常量');
            }
        } catch (PayException $e) {
            throw $e;
        }
    }

    /**
     * 通过环境类调用支付退款操作
     *
     * @param array $data
     *
     * @return array
     * @throws PayException
     * @author lichv
     */
    public function refund(array $data)
    {
        if (! $this->refund instanceof BaseStrategy) {
            throw new PayException('请检查初始化是否正确');
        }

        try {
            return $this->refund->handle($data);
        } catch (PayException $e) {
            throw $e;
        }
    }
}
