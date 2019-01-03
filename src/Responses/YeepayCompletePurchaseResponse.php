<?php

namespace Omnipay\Yeepay\Responses;

use Omnipay\Yeepay\Requests\YeepayCompletePurchaseRequest;
use Omnipay\Common\Message\AbstractResponse;

class YeepayCompletePurchaseResponse extends AbstractResponse
{

    /**
     * @var YeepayCompletePurchaseRequest
     */
    protected $request;

    public function getResponseText()
    {
        if ($this->isSuccessful()) {
            return 'success';
        } else {
            return 'fail';
        }
    }

    public function isSuccessful()
    {
        if ($this->request->getHmac() == $this->data['hmac_confirm']) {
            return true;
        }
        return false;
    }

    public function isPaid()
    {
        if ($this->data['r1_Code'] == '1') {
            return true;
        } else {
            return false;
        }
    }

    public function data($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->data;
        } else {
            return array_get($this->data, $key, $default);
        }
    }
}
