<?php

namespace SamWrigley\Hobnob;

use Illuminate\Support\Collection;

class SocialNetwork
{
    /**
     * Keys required by each social network.
     *
     * @var string[]
     */
    private $requiredKeys = [
        'name',
        'handle',
        'url',
    ];

    /**
     * Get social networks.
     *
     * @param  array|string[]  $networkNames
     * @return \Illuminate\Support\Collection
     */
    public function getNetworks(array $networkNames = []): Collection
    {
        $networks = config('hobnob.networks');

        return collect($networks)
            ->rejectEmptyAssocValues()
            ->filterByAssocKeys($this->requiredKeys)
            ->filterByKeys($networkNames);
    }

    /**
     * Get specific social networks.
     *
     * @param  string|string[]  $networkNames
     * @return \Illuminate\Support\Collection
     */
    public static function get($networkNames): Collection
    {
        return (new static)->getNetworks(
            is_array($networkNames) ? $networkNames : func_get_args()
        );
    }

    /**
     * Get all social networks.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function all(): Collection
    {
        return (new static)->getNetworks();
    }

    /**
     * Get handles of given social networks.
     *
     * @param  array|string|string[]  $networkNames
     * @return null|string|string[]
     */
    public static function handles($networkNames = [])
    {
        $handles = (new static)
            ->getNetworks(
                is_array($networkNames) ? $networkNames : func_get_args()
            )
            ->pluck('handle');

        if (!$handles->count()) {
            return null;
        }

        if ($handles->count() === 1) {
            return $handles->first();
        }

        return $handles->toArray();
    }
}
