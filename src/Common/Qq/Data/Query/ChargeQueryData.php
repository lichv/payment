<?php
/**
 * Created by PhpStorm.
 * User: lichv
 * Date: 2017/3/6
 * Time: 下午10:05
 */
namespace Payment\Common\Qq\Data\Query;


use Payment\Common\PayException;
use Payment\Common\Qq\Data\QqBaseData;
use Payment\Utils\ArrayUtil;

/**
 * 查询交易的数据结构
 * Class ChargeQueryData
 *
 * @property string $transaction_id QQ钱包的订单号，优先使用
 * @property string $out_trade_no 商户系统内部的订单号
 *
 * @package Payment\Common\Qq\Data\Query
 */
class ChargeQueryData extends QqBaseData
{

    protected function buildData()
    {
        $this->retData = [
            'appid' => $this->appId,
            'mch_id'    => $this->mchId,
            'nonce_str' => $this->nonceStr,
            'sign_type' => $this->signType,

            'transaction_id'    => $this->transaction_id,
            'out_trade_no'  => $this->out_trade_no,
        ];

        $this->retData = ArrayUtil::paraFilter($this->retData);
    }

    protected function checkDataParam()
    {
        $transaction_id = $this->transaction_id;// 微信交易号，查询效率高
        $order_no = $this->out_trade_no;// 商户订单号，查询效率低，不建议使用

        // 二者不能同时为空
        if (empty($transaction_id) && empty($order_no)) {
            throw new PayException('必须提供QQ钱包交易号或商户网站唯一订单号。建议使用QQ钱包交易号');
        }
    }
}