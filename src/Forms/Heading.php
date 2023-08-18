<?php

namespace Awcodes\Sink\Forms;

use Closure;
use Filament\Forms\Components\Component;
use Filament\Support\Colors\Color;
use Filament\Support\Concerns\HasColor;

class Heading extends Component
{
    use HasColor;

    protected string | int | null $level = null;

    protected string | Closure | null $content = null;

    protected string $view = 'sink::forms.heading';

    final public function __construct(string | int $level)
    {
        $this->level($level);
    }

    public static function make(string | int $level): static
    {
        return app(static::class, ['level' => $level]);
    }

    protected function setUp(): void
    {
        $this->dehydrated(false);
    }

    public function level(string | int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function content(string | Closure $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getLevel(): string
    {
        return is_int($this->level) ? 'h' . $this->level : $this->level ?? 'h2';
    }

    public function getContent(): string
    {
        return $this->evaluate($this->content);
    }

    public function getColor(): array
    {
        return $this->evaluate($this->color) ?? Color::Amber;
    }
}
