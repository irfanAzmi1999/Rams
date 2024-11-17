<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Kenderaan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $auditInclude = [
        'id',
        'eksport_id',
        'created_by',
        'updated_by'
    ];

    protected $fillable = [
        'accident_id',
        'eksport_id',
        'created_by',
        'updated_by'
    ];

    /**
     * Boot the model.
     */
    protected static function booted(): void
    {
        parent::booted();
    }

    /**
     * Relationship to the JenisKenderaan model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenis()
    {
        return $this->belongsTo(JenisKenderaan::class, 'jenis_kenderaan', 'kod');
    }
}
