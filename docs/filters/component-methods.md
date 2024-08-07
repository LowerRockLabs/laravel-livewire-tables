---
title: Component Methods
weight: 5
---

These are the available filters configuration methods on the component.

---

Filters are **enabled by default** but will only show up if you have at least one defined.

## setFiltersStatus

Enable/disable filters for the whole component.

```php
public function configure(): void
{
    $this->setFiltersStatus(true);
    $this->setFiltersStatus(false);
}
```

## setFiltersEnabled

Enable filters for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFiltersStatus(true)
    $this->setFiltersEnabled();
}
```

## setFiltersDisabled

Disable filters for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFiltersStatus(false)
    $this->setFiltersDisabled();
}
```

---

## setFiltersVisibilityStatus

**Enabled by default**, show/hide the filters dropdown.

```php
public function configure(): void
{
    $this->setFiltersVisibilityStatus(true);
    $this->setFiltersVisibilityStatus(false);
}
```

## setFiltersVisibilityEnabled

Show the filters dropdown for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFiltersVisibilityStatus(true)
    $this->setFiltersVisibilityEnabled();
}
```

## setFiltersVisibilityDisabled

Hide the filters dropdown for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFiltersVisibilityStatus(false)
    $this->setFiltersVisibilityDisabled();
}
```

---

## setFilterPillsStatus

**Enabled by default**, show/hide the filter pills.

```php
public function configure(): void
{
    $this->setFilterPillsStatus(true);
    $this->setFilterPillsStatus(false);
}
```

## setFilterPillsEnabled

Show the filter pills for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFilterPillsStatus(true)
    $this->setFilterPillsEnabled();
}
```

## setFilterPillsDisabled

Hide the filter pills for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setFilterPillsStatus(false)
    $this->setFilterPillsDisabled();
}
```

---

## setFilterLayout

Set the filter layout for the component.

```php
public function configure(): void
{
    $this->setFilterLayout('slide-down');
}
```

## setFilterLayoutPopover

Set the filter layout to popover.

```php
public function configure(): void
{
    $this->setFilterLayoutPopover();
}
```

Set the filter layout to slide down.

## setFilterLayoutSlideDown

```php
public function configure(): void
{
    $this->setFilterLayoutSlideDown();
}
```

## setFilterSlideDownDefaultStatusEnabled

Set the filter slide down to visible by default

```php
public function configure(): void
{
    // Shorthand for $this->setFilterSlideDownDefaultStatus(true)
    $this->setFilterSlideDownDefaultStatusEnabled();
}
```

## setFilterSlideDownDefaultStatusDisabled

Set the filter slide down to collapsed by default

```php
public function configure(): void
{
    // Shorthand for $this->setFilterSlideDownDefaultStatus(false)
    $this->setFilterSlideDownDefaultStatusDisabled();
}
```

