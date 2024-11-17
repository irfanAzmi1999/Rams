<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
use OwenIt\Auditing\Contracts\Auditable;

class Department extends Model implements Auditable
{
    const JENIS_BAHAGIAN = 0;
    const JENIS_DAERAH = 1;
    const JENIS_NEGERI = 2;

    use \OwenIt\Auditing\Auditable;

    protected array $auditInclude = [
        'id',
        'name',
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
     * Get the description of department type.
     *
     * @param int $jenis
     * @return string
     */
    public static function JenisBahagian(?int $jenis): string
    {
        return match ($jenis) {
            self::JENIS_BAHAGIAN => 'Bahagian',
            self::JENIS_DAERAH => 'Daerah',
            self::JENIS_NEGERI => 'Negeri',
            default => 'Jenis salah',
        };
    }
}
