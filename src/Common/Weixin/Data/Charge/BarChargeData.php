<?php
/**
 * Created by PhpStorm.
 * User: lichv
 * Date: 17/3/6
 * Time: 上午8:49
 */

namespace Payment\Common\Weixin\Data\Charge;

use Payment\Common\PayException;
use Payment\Utils\ArrayUtil;

/**
 * Class WebChargeData
 *
 * @inheritdoc
 * @property string $auth_code  扫码支付授权码，设备读取用户微信中的条码或者二维码信息
 *
 * @package Payment\Common\Weixin\Data\Charge
 */
class BarChargeData extends ChargeBaseData
{

    protected function checkDataParam()
    {
        parent::checkDataParam(); // TODO: Change the autogenerated stub

        // 刷卡支付,必须设置auth_code
        $authCode = $this->auth_code;
        if (empty($authCode)) {
            throw new PayException('扫码支付授权码,必须设置该参数.');
        }
    }

    /**
     * 生成下单的数据
     * @return array
     */
    protected function buildData()
    {
        $signData = [
            // 基本数据
            'appid' => trim($this->appId),
            'mch_id'    => trim($this->mchId),
            'nonce_str' => $this->nonceStr,
            'sign_type' => $this->signType,
            'fee_type'  => $this->feeType,

            // 业务数据
            'device_info'   => $this->terminal_id,
            'body'  => trim($this->subject),
            //'detail' => json_encode($this->body, JSON_UNESCAPED_UNICODE);
            'attach'    => trim($this->return_param),
            'out_trade_no'  => trim($this->order_no),
            'total_fee' => $this->amount,
            'spbill_create_ip'  => trim($this->client_ip),
            'auth_code'    => $this->auth_code,
        ];

        // 移除数组中的空值
        $this->retData = ArrayUtil::paraFilter($signData);
    }
}
