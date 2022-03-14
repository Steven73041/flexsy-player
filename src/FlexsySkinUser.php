<?php

namespace Flexsy\Player;

use Flexsy\Player\Traits\HasWallet;
use Illuminate\Foundation\Auth\User as Authenticatable;

class FlexsySkinUser extends Authenticatable
{
    use HasWallet;
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
    ];

    protected $dates = [
        'date_of_birth',
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

    /**
     * @return mixed
     */
    public function totalBalance()
    {
        return $this->currentWallet()->totalBalance();
    }

    /**
     * @param $amount
     * @return FlexsySkinUser
     */
    public function addCash($amount)
    {
        $currentWallet = $this->currentWallet();
        $currentWallet->cash += $amount;
        $currentWallet->update();
        return $this;
    }

    /**
     * @param $amount
     * @return FlexsySkinUser
     */
    public function subCash($amount)
    {
        $currentWallet = $this->currentWallet();
        $currentWallet->cash -= $amount;
        $currentWallet->update();
        return $this;
    }
}
