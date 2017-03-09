<?php
/**
 * Created by PhpStorm.
 * User: lichv
 * Date: 16/7/31
 * Time: 上午9:20
 */

namespace Payment\Common\Qq\Data\Charge;

use Payment\Common\PayException;
use Payment\Utils\ArrayUtil;

/**
 * Class PubChargeData
 * 微信公众号支付
 *
 * @property string $openid  trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识
 *
 * @package Payment\Common\Weixin\Data\Charge
 * anthor lichv
 */
class PubChargeData extends ChargeBaseData
{
    protected function checkDataParam()
    {
        parent::checkDataParam(); // TODO: Change the autogenerated stub

        // 公众号支付,必须设置openid
        $openid = $this->openid;
        if (empty($openid)) {
            throw new PayException('用户在商户appid下的唯一标识,公众号支付,必须设置该参数.');
        }
    }

    protected function buildData()
    {
        $signData = [
            // 基本数据
            'appid' => trim($this->appId),
            'mch_id'    => trim($this->mchId),
            'nonce_str' => $this->nonceStr,
            'sign_type' => $this->signType,
            'fee_type'  => $this->feeType,
            'notify_url'    => $this->notifyUrl,
            'trade_type'    => $this->tradeType, //设置APP支付
            'limit_pay' => $this->limitPay,  // 指定不使用信用卡

            // 业务数据
            'device_info'   => $this->terminal_id,
            'body'  => trim($this->subject),
            //'detail' => json_encode($this->body, JSON_UNESCAPED_UNICODE);
            'attach'    => trim($this->return_param),
            'out_trade_no'  => trim($this->order_no),
            'total_fee' => $this->amount,
            'spbill_create_ip'  => trim($this->client_ip),
            'time_start'    => $this->timeStart,
            'time_expire'   => $this->timeout_express,
            'openid' => $this->openid,
        ];

        // 移除数组中的空值
        $this->retData = ArrayUtil::paraFilter($signData);
    }
}