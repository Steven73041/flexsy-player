<?php

namespace Flexsy\Player;

use Illuminate\Database\Eloquent\Model;

class FlexsyWallet extends Model
{
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
    public function skinUser()
    {
        return $this->belongsTo(FlexsySkinUser::class);
    }

    /**
     * Calculate total balance of player.
     *
     * @return float
     */
    public function totalBalance():float
    {
        return $this->cash + $this->bonus + $this->sports_bonus + $this->casino_bonus;
    }
}
