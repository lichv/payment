<?php
/**
 * Created by PhpStorm.
 * User: lichv
 * Date: 2017/3/7
 * Time: 下午1:32
 */

namespace Payment\Common\Qq\Data\Query;


use Payment\Common\PayException;
use Payment\Common\Qq\Data\QqBaseData;
use Payment\Utils\ArrayUtil;

/**
 * QQ钱包退款接口查询
 *
 * @property string $transaction_id QQ钱包的订单号，优先使用
 * @property string $out_trade_no 商户系统内部的订单号
 * @property string $refund_no  商户侧传给QQ钱包的退款单号
 * @property string $refund_id  QQ钱包生成的退款单号，在申请退款接口有返回
 *
 * Class RefundQueryData
 * @package Payment\Common\Qq\Data\Query
 */
class RefundQueryData extends QqBaseData
{

    protected function buildData()
    {
        $this->retData = [
            'appid' => $this->appId,
            'mch_id'    => $this->mchId,
            'device_info' => $this->terminal_id,
            'nonce_str' => $this->nonceStr,
            'sign_type' => $this->signType,

            'transaction_id'    => $this->transaction_id,
            'out_trade_no'  => $this->out_trade_no,
            'out_refund_no' => $this->refund_no,
            'refund_id' => $this->refund_id,
        ];

        $this->retData = ArrayUtil::paraFilter($this->retData);
    }

    protected function checkDataParam()
    {
        $transactionId = $this->transaction_id;// 微信交易号，查询效率高
        $orderNo = $this->out_trade_no;// 商户订单号，查询效率低，不建议使用
        $refundNo = $this->refund_no;// 商户的退款单号
        $refundId = $this->refund_id;// 微信的退款交易号

        // 四者不能同时为空
        if (empty($transactionId) && empty($orderNo) && empty($refundNo) && empty($refundId)) {
            throw new PayException('查询退款  必须提供QQ钱包交易号、商户订单号、商户退款单号、QQ钱包退款交易号中的一种');
        }
    }
}