<?php

namespace Awcodes\Sink\Forms;

use Closure;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Component;

class FixedWidthSidebar extends Component
{
    protected string|int|null $breakpoint = null;

    protected array $columnSpan = [
        'default' => 2,
        'sm' => null,
    ];

    protected array|Closure|null $mainSchema = null;

    protected array|Closure|null $sidebarSchema = null;

    protected string|null $sidebarWidth = null;

    protected string $view = 'sink::forms.fixed-width-sidebar';

    public static function make(): static
    {
        return new static();
    }

    public function breakpoint(string|int $breakpoint): static
    {
        $this->breakpoint = $breakpoint;

        return $this;
    }

    public function mainSchema(array|Closure $schema): static
    {
        $this->mainSchema = $schema;

        return $this;
    }

    public function sidebarSchema(array|Closure $schema): static
    {
        $this->sidebarSchema = $schema;

        return $this;
    }

    public function sidebarWidth(string|int $width): static
    {
        $this->sidebarWidth = $width;

        return $this;
    }

    public function getBreakpoint(): string|int|null
    {
        $breakpoint = $this->breakpoint ?? 'lg';

        if (is_string($breakpoint)) {
            $breakpoint = match ($breakpoint) {
                'sm' => '640px',
                'md' => '768px',
                'lg' => '1024px',
                'xl' => '1280px',
                '2xl' => '1536px',
            };
        } elseif (is_int($breakpoint)) {
            $breakpoint = $breakpoint.'px';
        }

        return $breakpoint;
    }

    public function getMainSchema(): array
    {
        return $this->evaluate($this->mainSchema) ?? [];
    }

    public function getSidebarSchema(): array
    {
        return $this->evaluate($this->sidebarSchema) ?? [];
    }

    public function getSidebarWidth(): string|int|null
    {
        return $this->sidebarWidth ?? '20rem';
    }

    public function getChildComponentContainers(bool $withHidden = false): array
    {
        return [
            'main' => ComponentContainer::make($this->getLivewire())
                ->parentComponent($this)
                ->components($this->getMainSchema()),
            'sidebar' => ComponentContainer::make($this->getLivewire())
                ->parentComponent($this)
                ->components($this->getSidebarSchema()),
        ];
    }

    public function hasChildComponentContainer(bool $withHidden = false): bool
    {
        if ((! $withHidden) && $this->isHidden()) {
            return false;
        }

        if ($this->getMainSchema() === []) {
            return false;
        }

        if ($this->getSidebarSchema() === []) {
            return false;
        }

        return true;
    }
}
