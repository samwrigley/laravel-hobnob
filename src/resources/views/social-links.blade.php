@if (count($networks))

    <ul class="social-links">

        @foreach($networks as $network)
            <li>
                <a href="{{ $network['profileUrl'] }}"
                    class="btn btn--social btn--{{ strtolower($network['name']) }}"
                    aria-label="@lang('hobnob::links.social_label', ['network' => $network['name']])"
                    title="@lang('hobnob::links.social_label', ['network' => $network['name']])"
                    target="_blank"
                    rel="noopener"
                >
                    {{ $network['socialButtonText'] ?? $network['name'] }}
                </a>
            </li>
        @endforeach

    </ul>

@endif
