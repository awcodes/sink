<?php

namespace Awcodes\Sink\Forms;

use Awcodes\Sink\Providers\OEmbed\VimeoProvider;
use Awcodes\Sink\Providers\OEmbed\YoutubeProvider;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\ViewField;

class OEmbed extends Fieldset
{
    protected ?array $providers = null;

    protected function setUp(): void
    {
        $this->schema([
            TextInput::make('url')
                ->label(__('sink::oembed.url'))
                ->reactive()
                ->required(),
            CheckboxList::make('native_options')
                ->hiddenLabel()
                ->gridDirection('row')
                ->columns(3)
                ->visible(function (callable $get) {
                    return ! (str_contains($get('url'), 'vimeo') || str_contains($get('url'), 'youtube') || str_contains($get('url'), 'youtu.be'));
                })
                ->options([
                    'autoplay' => __('sink::oembed.autoplay'),
                    'loop' => __('sink::oembed.loop'),
                    'controls' => __('sink::oembed.controls'),
                ]),
            CheckboxList::make('vimeo_options')
                ->hiddenLabel()
                ->gridDirection('row')
                ->columns(3)
                ->visible(function (callable $get) {
                    return str_contains($get('url'), 'vimeo');
                })
                ->options([
                    'autoplay' => __('sink::oembed.autoplay'),
                    'loop' => __('sink::oembed.loop'),
                    'show_title' => __('sink::oembed.title'),
                    'byline' => __('sink::oembed.byline'),
                    'portrait' => __('sink::oembed.portrait'),
                ]),
            Group::make([
                CheckboxList::make('youtube_options')
                    ->hiddenLabel()
                    ->gridDirection('row')
                    ->columns(3)
                    ->options([
                        'controls' => __('sink::oembed.controls'),
                        'nocookie' => __('sink::oembed.nocookie'),
                    ]),
                TimePicker::make('start_at')
                    ->label(__('sink::oembed.start_at'))
                    ->reactive()
                    ->date(false)
                    ->afterStateHydrated(function (TimePicker $component, $state): void {
                        if (! $state) {
                            return;
                        }

                        $state = CarbonInterval::seconds($state)->cascade();
                        $component->state(Carbon::parse($state->h . ':' . $state->i . ':' . $state->s)->format('Y-m-d H:i:s'));
                    })
                    ->dehydrateStateUsing(function ($state): int {
                        if (! $state) {
                            return 0;
                        }

                        return Carbon::parse($state)->diffInSeconds('00:00:00');
                    }),
            ])->visible(function (callable $get) {
                return str_contains($get('url'), 'youtube') || str_contains($get('url'), 'youtu.be');
            }),
            Checkbox::make('responsive')
                ->default(true)
                ->reactive()
                ->label(__('sink::oembed.responsive'))
                ->afterStateUpdated(function (callable $set, $state) {
                    if ($state) {
                        $set('width', '16');
                        $set('height', '9');
                    } else {
                        $set('width', '640');
                        $set('height', '480');
                    }
                })
                ->columnSpan('full'),
            Group::make([
                TextInput::make('width')
                    ->reactive()
                    ->required()
                    ->label(__('sink::oembed.width'))
                    ->default('16'),
                TextInput::make('height')
                    ->reactive()
                    ->required()
                    ->label(__('sink::oembed.height'))
                    ->default('9'),
            ])->columns(['md' => 2]),
            ViewField::make('preview')
                ->view('sink::forms.oembed.preview')
                ->label(fn (): string => __('sink::oembed.preview'))
                ->columnSpan('full')
                ->dehydrated(false),
        ]);
    }

    public function providers(array $providers): static
    {
        $this->providers = $providers;

        return $this;
    }

    public function getProviders(): array
    {
        return [
            ...$this->providers ?? [],
            ...[VimeoProvider::class, YoutubeProvider::class],
        ];
    }
}
