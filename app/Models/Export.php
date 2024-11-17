<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class Export extends Model
{
    /**
     * Boot the model and add the ActiveScope globally.
     */
    protected static function booted(): void
    {
        // static::addGlobalScope(new ActiveScope);
    }

    /**
     * Define the relationship to the Upload model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
