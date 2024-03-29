<?php

namespace App;

#use                                          App\EventHolding;
#use                                   App\Traits\Favoritable;
use                                   App\Traits\GeneralTrait;
use                     Spatie\Permission\Traits\HasRoles;
use                     Illuminate\Notifications\Notifiable;
use                   Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use GeneralTrait;

#	protected $connection = 'psc';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'published',
        'email',
        'title',
        'first_name',
        'last_name',
        'activation_token',
        'password',
#        'country_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
/*
    public function favoritedEvents()
    {
        return $this->morphedByMany('App\Event', 'favorited', 'favorites');
    }
*/
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function getRoles($i_user_id = NULL)
    {
    	if (is_null($i_user_id)) $i_user_id = $this->id;
        return Role::select('id', 'name', 'guard_name')->whereIn('id', function($query) use ($i_user_id) {
            $query->select('role_id')
#                ->from('psc.model_has_roles')
                ->from('model_has_roles')
                ->where([
                    'model_type' => 'App\User',
                    'model_id'        => $i_user_id,
                ])->pluck('role_id')->toArray();
        })->get();
    }

    public function checkAdmin($i_user_id = NULL)
    {
    	if (is_null($i_user_id)) $i_user_id = $this->id;
    	$i_admin_role_id = 1;
    	return in_array($i_admin_role_id, $this->getRoles($i_user_id)->pluck('id')->toArray());
    }
/*
    public function holdings()
    {
        return EventHolding::whereIn('event_id', function($query) {
            $query->select('favorited_id')
                ->from('favorites')
                ->where([
                    'favorited_type' => 'App\Event',
                    'user_id'        => $this->id,
                ]);
        });
    }
*/
}
