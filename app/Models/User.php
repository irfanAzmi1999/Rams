<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MailResetPasswordNotification;
use App\Scopes\ActiveScope;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use Notifiable;
    use \OwenIt\Auditing\Auditable;

    protected array $auditInclude = [
        'id',
        'icno',
        'fullname',
        'email',
        'department_id',
        'role_id',
        'sekatan',
        'lastlogin',
        'lastlogout',
        'created_by',
        'updated_by',
        'disable'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'icno',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Boot method to add the global ActiveScope
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function daerah()
    {
        return $this->belongsToMany(Daerah::class);
    }

    public function negeri()
    {
        return $this->belongsTo(Negeri::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification(#[\SensitiveParameter] $token)
    {
        $this->notify(new MailResetPasswordNotification($token));
    }

    /**
     * Check if the user is a system or KKR admin
     */
    public function admin(): bool
    {
        return $this->role()->whereIn('name', ['PENTADBIR SISTEM','PENTADBIR KKR'])->exists();
    }

    public function adminjkr(): bool
    {
        return $this->role()->where('name', 'PENTADBIR JKR')->exists();
    }

    public function jkrnegeri(): bool
    {
        return $this->role()->where('name', 'JKR NEGERI')->exists();
    }

    public function jkrdaerah(): bool
    {
        return $this->role()->where('name', 'JKR DAERAH')->exists();
    }

    public function pengguna(): bool
    {
        return $this->role()->whereIn('name', ['PENGGUNA SISTEM','TIDAK DIKETAHUI'])->exists();
    }

    /**
     * Get full name and position
     */
    public function getFullnameJawatan(): string
    {
        if ($this->jkrnegeri()) {
            return $this->role->name.' '. $this->negeri->name;
        } elseif ($this->jkrdaerah()) {
            return $this->role->name.' '. $this->daerah()->first()->jkr_daerah.', '. $this->negeri->name;
        }
        return $this->role->name;
    }
}
