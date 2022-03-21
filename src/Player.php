<?php

namespace Wallet\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Player extends Authenticatable
{
    protected $guard_name = 'skinUsers';

    public $timestamps = false;

    public $table = 'skin_users';

    protected $fillable = [
        'id',
        'external_id',
        'type',
        'status',
        'username',
        'email',
        'country_id',
        'language_id',
        'timezone_id',
        'affiliate_id',
        'currency_id',
        'password',
        'first_name',
        'last_name',
        'gender',
        'ip_address',
        'mobile_number',
        'address',
        'city',
        'zip',
        'email_is_verified',
        'mobile_is_verified',
        'communication_email',
        'communication_mobile',
        'communication_mobile_verified',
        'communication_email_verified',
        'terms_accepted',
        'created_log_id',
        'last_login_log_id',
        'last_update_log_id',
        'date_of_birth',
        'notes',
        // To be removed in next deploy, kept for migration rollback
        'balance'
    ];

    /**
     * Return if this skin user is active.
     *
     * @return bool
     */
    public function active()
    {
        return $this->status == 'active';
    }
}
