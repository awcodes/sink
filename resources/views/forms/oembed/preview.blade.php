@php
    $state = $getState();

    $params = [
        'autoplay' => $state['autoplay'] ? 1 : 0,
        'loop' => $state['loop'] ? 1 : 0,
        'title' => $state['show_title'] ? 1 : 0,
        'byline' => $state['byline'] ? 1 : 0,
        'portrait' => $state['portrait'] ? 1 : 0,
    ];
@endphp

<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div class="border border-gray-300 dark:border-gray-700 rounded-xl overflow-hidden aspect-video w-full h-auto bg-gray-300/30 dark:bg-gray-800/20">
        @if($state && $state['embed_url'])
            <iframe
                src="{{ $state['embed_url'] }}?{{ http_build_query($params) }}"
                width="640"
                height="360"
                allow="autoplay; fullscreen; picture-in-picture"
                allowfullscreen
                class="w-full h-full"
            ></iframe>
        @endif
    </div>
</x-forms::field-wrapper>
