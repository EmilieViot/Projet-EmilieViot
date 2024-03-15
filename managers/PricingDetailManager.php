<?php

class PricingDetailManager extends AbstractManager
{

    public function findByPricing(int $pricingId) : array
    {
        $pm = new PricingManager();
        $dm = new DetailManager();

        $query = $this->db->prepare('SELECT * FROM pricing_detail WHERE pricing_id=:id');
        $parameters = [
        "id" => $pricingId
        ];
        $query->execute($parameters);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $detailedPricings = [];

        foreach($result as $item)
        {
            $pricing = $pm->findOne($item["pricing_id"]);
            $detail = $dm->findOne($item["detail_id"]);
            $detailedPricing = new PricingDetail($pricing, $detail);
            $detailedPricing->setId($item["id"]);
            $detailedPricings[] = $detailedPricing;
        }
        return $perfs;
    }
    public function createOne($pricing, $detail): void
    {
        $query = $this->db->prepare('INSERT INTO pricing_detail (pricing_id, detail_id) VALUES (:pricing_id, :detail_id)');
        $parameters = [
            'pricing_id' => $pricing->getId(),
            'detail_id' => $detail->getId(),
        ];

        $query->execute($parameters);
    }
}