<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class RoleScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        // Apply the default condition
        $builder->where($model->getTable().'.disable', '=', 'ACTIVE');

        // Check if the user is authenticated before applying additional conditions
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role->name === 'JKR NEGERI') {
                $builder->where($model->getTable().'.negeri_id', '=', $user->negeri_id);
            } elseif ($user->role->name === 'JKR DAERAH') {
                $builder->where($model->getTable().'.daerah_id', '=', $user->daerah_id);
            }
        }
    }
}
