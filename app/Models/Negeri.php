<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
use OwenIt\Auditing\Contracts\Auditable;

class Negeri extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected array $auditInclude = [
        'id',
        'name',
        'latitude',
        'logitude',
        'created_by',
        'updated_by',
        'disable'
    ];

    /**
     * Boot the model and add the ActiveScope globally.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

    /**
     * Accessor for the 'id' attribute.
     *
     * @param mixed $value
     * @return mixed
     */
    public function getIdAttribute($value)
    {
        return $value;
    }
}
