<?php

namespace Omnipay\Yeepay\Requests;

use Omnipay\Yeepay\Common\Signer;
use Omnipay\Yeepay\Responses\YeepayPurchaseResponse;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Common\Exception\InvalidRequestException;

class YeepayPurchaseRequest extends AbstractRequest
{
    protected $reqURL_onLine = "https://www.yeepay.com/app-merchant-proxy/node";

    public function getData()
    {
        $this->validateParams();
        $data = $this->parameters->all();
        $data['pa_MP'] = '';
        $data['pd_FrpId'] = '';
        $data['pr_NeedResponse'] = 1;
        $data['hmac'] = $this->sign($data);
        return $data;
    }

    protected function validateParams()
    {
        $this->validate(
            'p0_Cmd',
            'p2_Order',
            'p3_Amt',
            'p4_Cur',
            'p5_Pid',
            'p6_Pcat',
            'p7_Pdesc',
            'p8_Url',
            'p9_SAF'
        );
    }

    public function sendData($data)
    {
        return $this->response = new YeepayPurchaseResponse($this, $data);
    }

    public function getP0Cmd()
    {
        return $this->getParameter('p0_Cmd');
    }

    public function setP0Cmd($value)
    {
        $this->setParameter('p0_Cmd', $value);
    }

    public function getP1MerId()
    {
        return $this->getParameter('p1_MerId');
    }

    public function setP1MerId($value)
    {
        $this->setParameter('p1_MerId', $value);
    }
    
    public function getP2Order()
    {
        return $this->getParameter('p2_Order');
    }

    public function setP2Order($value)
    {
        return $this->setParameter('p2_Order', $value);
    }

    public function getP3Amt()
    {
        return $this->getParameter('p3_Amt');
    }

    public function setP3Amt($value)
    {
        return $this->setParameter('p3_Amt', $value);
    }

    public function getP4Cur()
    {
        return $this->getParameter('p4_Cur');
    }

    public function setP4Cur($value)
    {
        return $this->setParameter('p4_Cur', $value);
    }

    public function getP5Pid()
    {
        return $this->getParameter('p5_Pid');
    }

    public function setP5Pid($value)
    {
        return $this->setParameter('p5_Pid', $value);
    }

    public function getP6Pcat()
    {
        return $this->getParameter('p6_Pcat');
    }

    public function setP6Pcat($value)
    {
        return $this->setParameter('p6_Pcat', $value);
    }

    public function getP7Pdesc()
    {
        return $this->getParameter('p7_Pdesc');
    }

    public function setP7Pdesc($value)
    {
        return $this->setParameter('p7_Pdesc', $value);
    }

    public function getP8Url()
    {
        return $this->getParameter('p8_Url');
    }

    public function setP8Url($value)
    {
        return $this->setParameter('p8_Url', $value);
    }

    public function getP9SAF()
    {
        return $this->getParameter('p9_SAF');
    }

    public function setP9SAF($value)
    {
        return $this->setParameter('p9_SAF', $value);
    }
    
    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }
    
    public function setMerchantKey($value)
    {
        return $this->setParameter('merchantKey', $value);
    }
    
    public function getReqURLOnLine()
    {
        return $this->reqURL_onLine;
    }
    
    public function setReqURLOnLine($value)
    {
        $this->reqURL_onLine = $value;
        return $this;
    }

    protected function sign($params)
    {
        $signer = new Signer($params);
        $sign = $signer->sign4Req();
        return $sign;
    }
}
