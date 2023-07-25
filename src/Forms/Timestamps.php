<?php

namespace Awcodes\Sink\Forms;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Illuminate\Database\Eloquent\Model;

class Timestamps
{
    public static function make(): Group
    {
        return Group::make()
            ->schema([
                Placeholder::make('created_at')
                    ->label('Created at')
                    ->content(fn (?Model $record): string => $record?->created_at->diffForHumans() ?? '-'),
                Placeholder::make('updated_at')
                    ->label('Modified at')
                    ->content(fn (?Model $record): string => $record?->updated_at->diffForHumans() ?? '-'),
            ])
            ->columnSpanFull()
            ->columns([
                'default' => 1,
                'sm' => 2,
                'md' => null,
            ]);
    }
}
