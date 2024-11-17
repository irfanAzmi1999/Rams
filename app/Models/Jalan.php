<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Scopes\ActiveScope;

class Jalan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected array $auditInclude = [
        'id',
        'nama',
        'disable'
    ];

    /**
     * Boot the model and apply the ActiveScope globally.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

    /**
     * Accessor for 'namalaluan' attribute.
     *
     * @return string
     */
    public function getNamalaluanAttribute(): string
    {
        return $this->nolaluan . ' ' . $this->nama;
    }

    /**
     * Relationship to the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Relationship to the Negeri model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function negeri()
    {
        return $this->belongsTo(Negeri::class, 'negeri_id', 'id');
    }

    /**
     * Relationship to the JenisJalan model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenisjalan()
    {
        return $this->belongsTo(JenisJalan::class, 'code');
    }
}
