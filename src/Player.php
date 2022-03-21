<?php

namespace Wallet\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Player extends Authenticatable
{
    public $table = 'skin_users';

    public $timestamps = false;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'skin_user_id');
    }

    /**
     * Get wallet of player by currency code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function wallet(string $currencyCode)
    {
        return $this->wallets->where('currency_code', $currencyCode)->first();
    }

    /**
     * @param $amount
     * @param string $currencyCode
     *
     * @return Wallet
     */
    public function addCash($amount, string $currencyCode) {
        return $this->wallet($currencyCode)->add('cash', $amount);
    }

    /**
     * @param $amount
     * @param string $currencyCode
     *
     * @return Wallet
     */
    public function subCash($amount, string $currencyCode) {
        return $this->wallet($currencyCode)->sub('cash', $amount);;
    }

    /**
     * @param $amount
     * @param string $currencyCode
     *
     * @return Wallet
     */
    public function setCash($amount, string $currencyCode) {
        return $this->wallet($currencyCode)->set('cash', $amount);
    }

    /**
     * @param $amount
     * @param string $currencyCode
     *
     * @return Wallet
     */
    public function addBonus($amount, string $currencyCode) {
        return $this->wallet($currencyCode)->add('bonus', $amount);
    }

    /**
     * @param $amount
     * @param string $currencyCode
     *
     * @return Wallet
     */
    public function subBonus($amount, string $currencyCode) {
        return $this->wallet($currencyCode)->sub('bonus', $amount);
    }

    /**
     * @param $amount
     * @param string $currencyCode
     *
     * @return Wallet
     */
    public function setBonus($amount, string $currencyCode) {
        return $this->wallet($currencyCode)->set('bonus', $amount);
    }

    /**
     * @param $amount
     * @param string $currencyCode
     *
     * @return Wallet
     */
    public function addCasinoBonus($amount, string $currencyCode) {
        return $this->wallet($currencyCode)->add('casino_bonus', $amount);
    }

    /**
     * @param $amount
     * @param string $currencyCode
     *
     * @return Wallet
     */
    public function subCasinoBonus($amount, string $currencyCode) {
        return $this->wallet($currencyCode)->sub('casino_bonus', $amount);
    }

    /**
     * @param $amount
     * @param string $currencyCode
     *
     * @return Wallet
     */
    public function setCasinoBonus($amount, string $currencyCode) {
        return $this->wallet($currencyCode)->set('casino_bonus', $amount);
    }

    /**
     * @param $amount
     * @param string $currencyCode
     *
     * @return Wallet
     */
    public function addSportsBonus($amount, string $currencyCode) {
        return $this->wallet($currencyCode)->add('sports_bonus', $amount);
    }

    /**
     * @param $amount
     * @param string $currencyCode
     *
     * @return Wallet
     */
    public function subSportsBonus($amount, string $currencyCode) {
        return $this->wallet($currencyCode)->sub('sports_bonus', $amount);
    }

    /**
     * @param $amount
     * @param string $currencyCode
     *
     * @return Wallet
     */
    public function setSportsBonus($amount, string $currencyCode) {
        return $this->wallet($currencyCode)->set('sports_bonus', $amount);
    }
}
