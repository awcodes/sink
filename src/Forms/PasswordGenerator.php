<?php

namespace Awcodes\Sink\Forms;

use Closure;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Illuminate\Support\Collection;

class PasswordGenerator extends TextInput
{
    protected Closure $generatePasswordUsing;

    protected function setUp(): void
    {
        $this->suffixAction(
            Action::make('generatePassword')
                ->label(__('sink::sink.forms.password_generator.label'))
                ->button()
                ->color('primary')
                ->action(function (Set $set) {
                    $set($this->getName(), $this->getPasswordGenerator());
                }),
        );
    }

    public function getPasswordGenerator(): string
    {
        return $this->evaluate($this->generatePasswordUsing ?? $this->fallbackPasswordGenerator());
    }

    public function generatePasswordUsing(callable $callback = null): static
    {
        $this->generatePasswordUsing = $callback;

        return $this;
    }

    public function fallbackPasswordGenerator(
        int $length = 32,
        bool $letters = true,
        bool $numbers = true,
        bool $symbols = true,
        bool $spaces = false
    ): string {
        return (new Collection)
            ->when($letters, fn ($c) => $c->merge([
                'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
                'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v',
                'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G',
                'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R',
                'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            ]))
            ->when($numbers, fn ($c) => $c->merge([
                '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
            ]))
            ->when($symbols, fn ($c) => $c->merge([
                '~', '!', '#', '$', '%', '^', '&', '*', '(', ')', '-',
                '_', '.', ',', '<', '>', '?', '/', '\\', '{', '}', '[',
                ']', '|', ':', ';',
            ]))
            ->when($spaces, fn ($c) => $c->merge([' ']))
            ->pipe(fn ($c) => Collection::times($length, fn () => $c[random_int(0, $c->count() - 1)]))
            ->implode('');
    }
}
