<?php

namespace App\Domain\IPs\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $ip
 * @property int $port
 * @property string $type
 * @property int $download_speed
 * @property int $timeout
 * @property bool $is_checked
 * @property string $hash
 */
class Proxy extends Model
{
    protected $casts = [
        'is_checked' => 'boolean'
    ];

    public const FILLABLE = [
        'ip',
        'port',
        'type',
        'download_speed',
        'timeout',
        'is_checked',
        'hash',
    ];

    protected $fillable = self::FILLABLE;

    protected $timestamp = false;
}
