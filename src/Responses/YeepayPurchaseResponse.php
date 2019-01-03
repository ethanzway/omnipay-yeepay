<?php

namespace Omnipay\Yeepay\Responses;

use Omnipay\Yeepay\Requests\YeepayPurchaseRequest;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class YeepayPurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{

    /**
     * @var YeepayPurchaseRequest
     */
    protected $request;


    /**
     * Is the response successful
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return true;
    }


    public function isRedirect()
    {
        return true;
    }


    public function getRedirectUrl()
    {
        return $this->request->getReqURLOnLine()."?p0_Cmd=".$this->data['p0_Cmd'].
                                                 "&p1_MerId=".$this->data['p1_MerId'].
                                                 "&p2_Order=".$this->data['p2_Order'].
                                                 "&p3_Amt=".$this->data['p3_Amt'].
                                                 "&p4_Cur=".$this->data['p4_Cur'].
                                                 "&p5_Pid=".urlencode($this->data['p5_Pid']).
                                                 "&p6_Pcat=".$this->data['p6_Pcat'].
                                                 "&p7_Pdesc=".$this->data['p7_Pdesc'].
                                                 "&p8_Url=".$this->data['p8_Url'].
                                                 "&p9_SAF=".$this->data['p9_SAF'].
                                                 "&pa_MP=".$this->data['pa_MP'].
                                                 "&pd_FrpId=".$this->data['pd_FrpId'].
                                                 "&pr_NeedResponse=".$this->data['pr_NeedResponse'].
                                                 "&hmac=".$this->data['hmac'];
    }


    /**
     * Gets the redirect form data array, if the redirect method is POST.
     */
    public function getRedirectData()
    {
        return $this->data;
    }


    /**
     * Get the required redirect method (either GET or POST).
     */
    public function getRedirectMethod()
    {
        return 'GET';
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
