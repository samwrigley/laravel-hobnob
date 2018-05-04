<?php

namespace SamWrigley\Hobnob;

use Illuminate\Support\Collection;
use SamWrigley\Hobnob\SocialNetwork;

class LinkGenerator
{
    /**
     * Keys required by each social network in sharing links.
     *
     * @var string[]
     */
    private $requiredSharingKeys = [
        'baseShareUrl',
    ];

    /**
     * Render social links.
     *
     * @param  array|string|string[]  $networkNames
     * @return string
     */
    public function socialLinks($networkNames = []): string
    {
        $filteredNetworks = SocialNetwork::get($networkNames);

        $networks = $this->addProfileUrl($filteredNetworks);

        return view('hobnob::social-links')
            ->with(['networks' => $networks])
            ->render();
    }

    /**
     * Render sharing links.
     *
     * @param  array|string|string[]  $networkNames
     * @return string
     */
    public function sharingLinks($networkNames = []): string
    {
        $filteredNetworks = SocialNetwork::get($networkNames)
            ->filterByAssocKeys($this->requiredSharingKeys);

        $networks = $this->addShareUrl($filteredNetworks);

        return view('hobnob::sharing-links')
            ->with(['networks' => $networks])
            ->render();
    }

    /**
     * Add profile URL to given networks.
     *
     * @param  \Illuminate\Support\Collection  $networks
     * @return array
     */
    private function addProfileUrl(Collection $networks): array
    {
        return $networks
            ->map(function ($network) {
                $profileUrl = $network['url'].$network['handle'];

                return array_add($network, 'profileUrl', $profileUrl);
            })
            ->toArray();
    }

    /**
     * Add share URL to given networks.
     *
     * @param  \Illuminate\Support\Collection  $networks
     * @return array
     */
    private function addShareUrl(Collection $networks): array
    {
        return $networks
            ->map(function ($network) {
                $shareUrl = $network['baseShareUrl'].url()->current();

                return array_add($network, 'shareUrl', $shareUrl);
            })
            ->toArray();
    }
}
