<?php

namespace Omnipay\Yeepay\Requests;

use Omnipay\Yeepay\Common\Signer;
use Omnipay\Yeepay\Responses\YeepayCompletePurchaseResponse;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

class YeepayCompletePurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validateParams();
        $data = $this->parameters->all();
        $data['hmac_confirm'] = $this->sign($data);
        return $data;
    }

    protected function validateParams()
    {
        $this->validate(
            'r0_Cmd',
            'r1_Code',
            'r2_TrxId',
            'r3_Amt',
            'r4_Cur',
            'r5_Pid',
            'r6_Order',
            'r7_Uid',
            'r8_MP',
            'r9_BType',
            'hmac'
        );
    }

    public function sendData($data)
    {
        return $this->response = new YeepayCompletePurchaseResponse($this, $data);
    }

    public function getP1MerId()
    {
        return $this->getParameter('p1_MerId');
    }

    public function setP1MerId($value)
    {
        $this->setParameter('p1_MerId', $value);
    }

    public function getR0Cmd()
    {
        return $this->getParameter('r0_Cmd');
    }

    public function setR0Cmd($value)
    {
        $this->setParameter('r0_Cmd', $value);
    }

    public function getR1Code()
    {
        return $this->getParameter('r1_Code');
    }

    public function setR1Code($value)
    {
        $this->setParameter('r1_Code', $value);
    }
    
    public function getR2TrxId()
    {
        return $this->getParameter('r2_TrxId');
    }

    public function setR2TrxId($value)
    {
        return $this->setParameter('r2_TrxId', $value);
    }

    public function getR3Amt()
    {
        return $this->getParameter('r3_Amt');
    }

    public function setR3Amt($value)
    {
        return $this->setParameter('r3_Amt', $value);
    }

    public function getR4Cur()
    {
        return $this->getParameter('r4_Cur');
    }

    public function setR4Cur($value)
    {
        return $this->setParameter('r4_Cur', $value);
    }

    public function getR5Pid()
    {
        return $this->getParameter('r5_Pid');
    }

    public function setR5Pid($value)
    {
        return $this->setParameter('r5_Pid', $value);
    }

    public function getR6Order()
    {
        return $this->getParameter('r6_Order');
    }

    public function setR6Order($value)
    {
        return $this->setParameter('r6_Order', $value);
    }

    public function getR7Uid()
    {
        return $this->getParameter('r7_Uid');
    }

    public function setR7Uid($value)
    {
        return $this->setParameter('r7_Uid', $value);
    }

    public function getR8MP()
    {
        return $this->getParameter('r8_MP');
    }

    public function setR8MP($value)
    {
        return $this->setParameter('r8_MP', $value);
    }

    public function getR9BType()
    {
        return $this->getParameter('r9_BType');
    }

    public function setR9BType($value)
    {
        return $this->setParameter('r9_BType', $value);
    }
    
    public function getHmac()
    {
        return $this->getParameter('hmac');
    }
    
    public function setHmac($value)
    {
        return $this->setParameter('hmac', $value);
    }
    
    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }
    
    public function setMerchantKey($value)
    {
        return $this->setParameter('merchantKey', $value);
    }

    protected function sign($params)
    {
        $signer = new Signer($params);
        $sign = $signer->sign4Callback();
        return $sign;
    }
}
