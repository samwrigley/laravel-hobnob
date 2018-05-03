@if (count($networks))

    <ul class="sharing-links">

        @foreach($networks as $network)
            <li>
                <a href="{{ $network['shareUrl'] }}"
                    class="btn btn--social btn--{{ strtolower($network['name']) }}"
                    aria-label="@lang('hobnob::links.share_label', ['network' => $network['name']])"
                    title="@lang('hobnob::links.share_label', ['network' => $network['name']])"
                    target="_blank"
                    rel="noopener"
                >
                    {{ $network['shareButtonText'] ?? $network['name'] }}
                </a>
            </li>
        @endforeach

    </ul>

@endif
