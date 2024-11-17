<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Laporan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected array $auditInclude = [
        'id',
        'rujukan',
        'namaLaluan',
        'url',
        'created_by',
        'updated_by',
        'disable',
        'created_at',
        'updated_at',
        'latitude',
        'logitude',
        'tahun',
        'is_dirawat',
        'tahun_dirawat'
    ];

    /**
     * Boot the model and apply the ActiveScope globally.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }
}
