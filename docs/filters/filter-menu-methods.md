---
title: Filter Menu Methods
weight: 7
---

You can customise the apperance/behaviour of the Filter Menu.

## Filter Layout

You can choose either a popover appearance (default) or a slide-down

### setFilterLayout

Set the filter layout for the component.

```php
public function configure(): void
{
    $this->setFilterLayout('slide-down');
}
```

### setFilterLayoutPopover

Set the filter layout to popover.

![Popover Menu](https://imgur.com/u4P9z4g.png)

```php
public function configure(): void
{
    $this->setFilterLayoutPopover();
}
```

### setFilterLayoutSlideDown

Set the filter layout to slide down.

![Slide Down](https://imgur.com/OuUjsDC.png)

```php
public function configure(): void
{
    $this->setFilterLayoutSlideDown();
}
```

### setFilterSlideDownDefaultStatusEnabled

Set the filter slide down to visible by default

```php
public function configure(): void
{
    // Shorthand for $this->setFilterSlideDownDefaultStatus(true)
    $this->setFilterSlideDownDefaultStatusEnabled();
}
```

### setFilterSlideDownDefaultStatusDisabled

Set the filter slide down to collapsed by default

```php
public function configure(): void
{
    // Shorthand for $this->setFilterSlideDownDefaultStatus(false)
    $this->setFilterSlideDownDefaultStatusDisabled();
}
```

---

## Additional Attributes

### setFilterPopoverAttributes

Allows for the customisation of the appearance of the Filter Popover Menu.

Note the addition of a "default-width" boolean, allowing you to customise the width more smoothly without impacting other applied classes.

You may also replace default colors by setting "default-colors" to false, or default styling by setting "default-styling" to false, and specifying replacement classes in the "class" property.

You can also replace the default transition behaviours (Tailwind) by specifying replacement attributes in the array.

```php
public function configure(): void
{
    $this->setFilterPopoverAttributes(
        [
        'class' => 'w-96',
        'default-width' => false,
        'default-colors' => true,
        'default-styling' => true, 
        'x-transition:enter' => 'transition ease-out duration-100',
        ]
    );
}
```

### setFilterSlidedownWrapperAttributes

Allows for the customisation of the appearance of the Filter Slidedown Wrapper.

You may also replace default colors by setting "default-colors" to false, or default styling by setting "default-styling" to false, and specifying replacement classes in the "class" property.

You can also replace the default transition behaviours (Tailwind) by specifying replacement attributes in the array, for example to extend the duration of the transition effect from the default duration-100 to duration-1000:

```php
public function configure(): void
{
    $this->setFilterSlidedownWrapperAttributes([
        'x-transition:enter' => 'transition ease-out duration-1000',
        'class' => 'text-black',
        'default-colors' => true,
        'default-styling' => true, 
    ]);
}
```

### setFilterSlidedownRowAttributes

Allows for the customisation of the appearance of the Filter Slidedown Row.  Note that this uses a callback, which receives the "rowIndex" of the Slidedown Row

You may replace default colors by setting "default-colors" to false, or default styling by setting "default-styling" to false, and specifying replacement classes in the "class" property.

```php
public function configure(): void
{
    $this->setFilterSlidedownRowAttributes(fn($rowIndex) => $rowIndex % 2 === 0 ? 
        [
            'class' => 'bg-red-500',
            'default-colors' => true,
            'default-styling' => true, 
        ] :  [
            'class' => 'bg-blue-500',
            'default-colors' => true,
            'default-styling' => true, 
        ] 
    );
}
```
