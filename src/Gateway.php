<?php

namespace Omnipay\Yeepay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Yeepay\Requests\YeepayPurchaseRequest;
use Omnipay\Yeepay\Requests\YeepayCompletePurchaseRequest;

class Gateway extends AbstractGateway
{

    public function getName()
    {
        return 'Yeepay Gateway';
    }

    public function getDefaultParameters()
    {
        return [];
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest(YeepayPurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest(YeepayCompletePurchaseRequest::class, $parameters);
    }

    public function refund(array $parameters = [])
    {
    }

    public function completeRefund(array $parameters = [])
    {
    }

    public function query(array $parameters = [])
    {
    }

    public function getP1MerId()
    {
        return $this->getParameter('p1_MerId');
    }

    public function setP1MerId($value)
    {
        $this->setParameter('p1_MerId', $value);
    }
    
    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }
    
    public function setMerchantKey($value)
    {
        return $this->setParameter('merchantKey', $value);
    }
}
