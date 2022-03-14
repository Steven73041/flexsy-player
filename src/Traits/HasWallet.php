<?php

namespace Flexsy\Player\Traits;

use App\PlayerWallet;
use function tenancy;

trait HasWallet
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|PlayerWallet[]
     */
    public function wallets()
    {
        return $this->hasMany(PlayerWallet::class);
    }

    /**
     * @return PlayerWallet[]|null
     */
    public function currentWallet()
    {
        return $this->wallets->where('currency_code', static::mainCurrency()->shortcode)->first();
    }
}
