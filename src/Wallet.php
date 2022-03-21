<?php

namespace Wallet\Models;

use App\Currency;
use App\SkinUser;

class Wallet extends \Illuminate\Database\Eloquent\Model
{
    public $table = 'player_wallets';

    protected $fillable = [
        'skin_user_id',
        'currency_code',
        'cash',
        'bonus',
        'sports_bonus',
        'casino_bonus',
        'total_deposit_amount',
        'total_deposit_count',
        'last_deposit_amount',
        'last_deposit_time',
        'last_deposit_id',
        'total_withdraw_amount',
        'total_withdraw_count',
        'last_withdraw_amount',
        'last_withdraw_time',
        'last_withdraw_id',
        'turnover_total',
        'turnover_completed',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|SkinUser
     */
    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * @return Currency
     */
    public function currency()
    {
        return Currency::getAllCached()->where('shortcode', $this->currency_code)->first();
    }

    /**
     * @param string $column
     * @param $amount
     *
     * @return $this
     */
    public function add(string $column, $amount) {
        $this->update([$column => $this->{$column} + $amount]);
        return $this;
    }

    /**
     * @param string $column
     * @param $amount
     *
     * @return $this
     */
    public function sub(string $column, $amount) {
        $this->update([$column => $this->{$column} - $amount]);
        return $this;
    }

    /**
     * @param string $column
     * @param $amount
     *
     * @return $this
     */
    public function set(string $column, $amount) {
        $this->update([$column => $amount]);
        return $this;
    }

    /**
     * @param array $columns
     *
     * @return float|mixed
     */
    public function getTotal(array $columns = [])
    {
        if (! empty($columns)) {
            $total = 0;
            foreach ($columns as $column) {
                $total += $this->{$column};
            }

            return (float) $total;
        }

        return $this->cash + $this->bonus + $this->casino_bonus + $this->sports_bonus;
    }
}
