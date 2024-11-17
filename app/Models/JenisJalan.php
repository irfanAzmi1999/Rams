<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
use OwenIt\Auditing\Contracts\Auditable;

class JenisJalan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected array $auditInclude = [
        'id',
        'name',
        'created_by',
        'updated_by',
        'disable'
    ];

    /**
     * Boot the model and apply the ActiveScope globally.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }
}
