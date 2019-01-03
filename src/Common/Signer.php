<?php

namespace Omnipay\Yeepay\Common;

use Exception;

/**
 * Sign Tool for Yeepay
 * Class Signer
 * @package Omnipay\Yeepay\Common
 */
class Signer
{
    /**
     * @var array
     */
    private $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function sign4Req()
    {
		#进行签名处理，一定按照文档中标明的签名顺序进行
		$sbOld = "";
		#加入业务类型
		$sbOld = $sbOld.$this->params['p0_Cmd'];
		#加入商户编号
		$sbOld = $sbOld.$this->params['p1_MerId'];
		#加入商户订单号
		$sbOld = $sbOld.$this->params['p2_Order'];    
		#加入支付金额
		$sbOld = $sbOld.$this->params['p3_Amt'];
		#加入交易币种
		$sbOld = $sbOld.$this->params['p4_Cur'];
		#加入商品名称
		$sbOld = $sbOld.$this->params['p5_Pid'];
		#加入商品分类
		$sbOld = $sbOld.$this->params['p6_Pcat'];
		#加入商品描述
		$sbOld = $sbOld.$this->params['p7_Pdesc'];
		#加入商户接收支付成功数据的地址
		$sbOld = $sbOld.$this->params['p8_Url'];
		#加入送货地址标识
		$sbOld = $sbOld.$this->params['p9_SAF'];
		#加入商户扩展信息
		$sbOld = $sbOld.$this->params['pa_MP'];
		#加入支付通道编码
		$sbOld = $sbOld.$this->params['pd_FrpId'];
		#加入是否需要应答机制
		$sbOld = $sbOld.$this->params['pr_NeedResponse'];
		
		return $this->HmacMd5($sbOld,$this->params['merchantKey']);
    }

    public function sign4Callback()
    {
		#取得加密前的字符串
		$sbOld = "";
		#加入商家ID
		$sbOld = $sbOld.$this->params['p1_MerId'];
		#加入消息类型
		$sbOld = $sbOld.$this->params['r0_Cmd'];
		#加入业务返回码
		$sbOld = $sbOld.$this->params['r1_Code'];
		#加入交易ID
		$sbOld = $sbOld.$this->params['r2_TrxId'];
		#加入交易金额
		$sbOld = $sbOld.$this->params['r3_Amt'];
		#加入货币单位
		$sbOld = $sbOld.$this->params['r4_Cur'];
		#加入产品Id
		$sbOld = $sbOld.$this->params['r5_Pid'];
		#加入订单ID
		$sbOld = $sbOld.$this->params['r6_Order'];
		#加入用户ID
		$sbOld = $sbOld.$this->params['r7_Uid'];
		#加入商家扩展信息
		$sbOld = $sbOld.$this->params['r8_MP'];
		#加入交易结果返回类型
		$sbOld = $sbOld.$this->params['r9_BType'];

		return $this->HmacMd5($sbOld,$this->params['merchantKey']);
    }

	public function HmacMd5($data, $key)
	{
		$key = iconv('gb2312', 'utf-8//IGNORE', $key);
		$data = iconv('gb2312', 'utf-8//IGNORE', $data);

		$b = 64;
		if (strlen($key) > $b) {
		$key = pack("H*",md5($key));
		}
		$key = str_pad($key, $b, chr(0x00));
		$ipad = str_pad('', $b, chr(0x36));
		$opad = str_pad('', $b, chr(0x5c));
		$k_ipad = $key ^ $ipad ;
		$k_opad = $key ^ $opad;

		return md5($k_opad . pack("H*",md5($k_ipad . $data)));
	}
}
