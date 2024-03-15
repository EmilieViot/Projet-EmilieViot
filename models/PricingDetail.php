<?php

class PricingDetail
{
    private ?int $id = null;

    public function __construct(private Pricing $pricing, private Detail $detail)
    {

    }

    public function getPricing(): Pricing
    {
        return $this->pricing;
    }
    public function setPlayer(Pricing $pricing): void
    {
        $this->pricing = $pricing;
    }
    public function getDetail(): Detail
    {
        return $this->detail;
    }
    public function setDetail(Detail $detail): void
    {
        $this->detail = $detail;
    }
}