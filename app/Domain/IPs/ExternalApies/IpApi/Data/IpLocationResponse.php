<?php

namespace App\Domain\IPs\ExternalApies\IpApi\Data;

use Illuminate\Support\Fluent;

/**
 * @property string $query
 * @property string $status
 * @property string $country
 * @property string $countryCode
 * @property string $region
 * @property string $regionName
 * @property string $city
 * @property float $lon
 * @property string $timezone
 * @property string $isp
 * @property string $org
 * @property string $as
 */
class IpLocationResponse extends Fluent
{
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }
}
