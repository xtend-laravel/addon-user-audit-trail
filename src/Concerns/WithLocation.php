<?php

namespace XtendLunar\Addons\UserAuditTrail\Concerns;

trait WithLocation
{
    protected function getLocation(): array
    {
        $publicIP = request()->ip();
        $location = json_decode(file_get_contents("http://ip-api.com/json/{$publicIP}"), true);

        if (!$location) {
            return [];
        }

        return [
            'country' => $location['country'],
            'country_code' => $location['countryCode'],
            'region' => $location['region'],
            'region_name' => $location['regionName'],
            'city' => $location['city'],
            'zip' => $location['zip'],
            'lat' => $location['lat'],
            'lon' => $location['lon'],
            'timezone' => $location['timezone'],
            'isp' => $location['isp'],
        ];
    }

    protected function getCountry(): string
    {
        return $this->getLocation()['country'];
    }
}
