@php
    $level = $getLevel();
    $color = $getColor();
@endphp

<{{ $level }}
    {{
        $attributes
            ->class([
                'sink-heading font-bold tracking-tight',
                match($level) {
                    'h2' => 'text-xl md:!text-2xl',
                    'h3' => 'text-lg md:!text-xl',
                    'h4' => 'text-default md:!text-lg',
                    'h5', 'h6' => 'text-default',
                },
                match ($color) {
                    'gray' => 'text-gray-600 dark:text-gray-400',
                    default => 'text-custom-500',
                },
            ])
            ->style([
                \Filament\Support\get_color_css_variables($color, [500]) => $color !== 'gray',
            ])
    }}
>
    {{ $getContent() }}
</{{ $level }}>
