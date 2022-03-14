<?php

namespace Flexsy\Player\Traits;

use App\PlayerWallet;
use function tenancy;

trait HasWallet
{
    /**
     * @return void
     */
    public static function bootHasWallet()
    {
        static::created(function ($skinUser) {
            if (tenancy()->tenant->licensee->type == 'PLATFORM') {
                $skinUser->wallets()->create([
                    'currency_code' => $skinUser->mainCurrency()->shortcode,
                    'cash'          => 0,
                    'bonus'         => 0,
                    'sports_bonus'  => 0,
                    'casino_bonus'  => 0,
                ]);
            }
        });
    }

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
