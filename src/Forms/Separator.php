<?php

namespace Awcodes\Sink\Forms;

use Filament\Forms\Components\Component;
use Filament\Support\Concerns\HasColor;

class Separator extends Component
{
    use HasColor;

    protected string $view = 'sink::forms.separator';

    public static function make(): static
    {
        return app(static::class);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->dehydrated(false);
    }
}
