@php
    $color = $getColor();
@endphp

<hr
    {{
        $attributes
            ->class([
                'sink-separator border-b',
                match ($color) {
                    'gray' => 'border-gray-950/5 dark:border-white/20',
                    default => 'border-custom-500',
                },
            ])
            ->style([
                \Filament\Support\get_color_css_variables($color, [500]) => $color !== 'gray',
            ])
    }}
/>
