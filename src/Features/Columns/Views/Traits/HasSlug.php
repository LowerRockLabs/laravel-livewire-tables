<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    protected ?string $customSlug = null;

    public ?string $slug = null;

    public function setDefaultSlug(): self
    {
        if(!isset($this->slug))
        {
            $this->slug = $this->getSlug();
        }
        return $this;
    }

    public function getSlug(): string
    {
        return Str::slug(($this->hasCustomSlug() ? $this->getCustomSlug() : ($this->slug ?? $this->getTitle())), '_', 'en', ['@' => 'at', '#' => 'num']);
    }

    public function getCustomSlug(): string
    {
        return $this->customSlug;
    }

    public function hasCustomSlug(): bool
    {
        return $this->customSlug !== null;
    }

    public function setCustomSlug(string $customSlug): self
    {
        $this->customSlug = $customSlug;

        return $this;
    }

    public function isColumnBySlug(string $slug): bool
    {
        return $this->getSlug() === $slug;
    }
}
