<?php

namespace Awcodes\Sink\Actions;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Set;

class NowAction extends Action
{
    protected function setUp(): void
    {
        $this
            ->label(__('sink::sink.actions.now.label'))
            ->icon('heroicon-o-clock')
            ->action(function (DateTimePicker $component, Set $set) {
                $set($component->getName(), now()->format($component->getFormat()));
            });
    }
}
