<?php
/**
 * @author: lichv
 * @createTime: 2016-07-28 17:25
 * @description:
 */

namespace Payment\Query\Qq;

use Payment\Common\Qq\Data\Query\ChargeQueryData;
use Payment\Common\Qq\QqBaseStrategy;
use Payment\Common\QqConfig;
use Payment\Config;
use Payment\Utils\ArrayUtil;

class QqChargeQuery extends QqBaseStrategy
{

    /**
     * 返回查询订单的数据
     * @author lichv
     */
    protected function getBuildDataClass()
    {
        return ChargeQueryData::class;
    }

    /**
     * 返回QQ钱包查询的url
     * @return string
     * @author lichv
     */
    protected function getReqUrl()
    {
        return QqConfig::CHARGE_QUERY_URL;
    }

    /**
     * 处理通知的返回数据
     * @param array $data
     * @return mixed
     * @author lichv
     */
    protected function retData(array $data)
    {
        if ($this->config->returnRaw) {
            return $data;
        }

        // 请求失败，可能是网络
        if ($data['return_code'] != 'SUCCESS') {
            return $retData = [
                'is_success'    => 'F',
                'error' => $data['return_msg']
            ];
        }

        // 业务失败
        if ($data['trade_state'] != 'SUCCESS') {
            return $retData = [
                'is_success'    => 'F',
                'error' => $data['err_code_des']
            ];
        }

        // 正确
        return $this->createBackData($data);
    }

    /**
     * 返回数据给客户端
     * @param array $data
     * @return array
     * @author lichv
     */
    protected function createBackData(array $data)
    {
        // 将金额处理为元
        $totalFee = bcdiv($data['total_fee'], 100, 2);

        $retData = [
            'is_success'    => 'T',
            'response'  => [
                'amount'   => $totalFee,
                'channel'   => Config::WX_CHARGE,// 支付查询
                'order_no'   => $data['out_trade_no'],
                'trade_state'   => strtolower($data['trade_state']),
                'transaction_id'   => $data['transaction_id'],
                'time_end'   => date('Y-m-d H:i:s', strtotime($data['time_end'])),
                'return_param'    => $data['attach'],
                'terminal_id' => $data['device_info'],
                'trade_type' => $data['trade_type'],
                'bank_type' => $data['bank_type'],
                'trade_state_desc' => $data['trade_state_desc'],
            ],
        ];

        return ArrayUtil::paraFilter($retData);
    }
}
