@props([
    'media' => null,
])

@if($media && $media['embed_url'])
    @php
        $styles = $media['responsive'] ? "aspect-ratio: {$media['width']} / {$media['height']}; width: 100%; height: auto;" : null;
        $params = [
            'autoplay' => $media['autoplay'] ? 1 : 0,
            'loop' => $media['loop'] ? 1 : 0,
            'title' => $media['show_title'] ? 1 : 0,
            'byline' => $media['byline'] ? 1 : 0,
            'portrait' => $media['portrait'] ? 1 : 0,
        ];
    @endphp

    <iframe
        src="{{ $media['embed_url'] }}?{{ http_build_query($params) }}"
        width="{{ $media['responsive'] ? $media['width'] : ($media['width'] ?: '640') }}"
        height="{{ $media['responsive'] ? $media['height'] : ($media['height'] ?: '480') }}"
        allow="autoplay; fullscreen; picture-in-picture"
        allowfullscreen
        style="{{ $styles }}"
    ></iframe>
@endif
