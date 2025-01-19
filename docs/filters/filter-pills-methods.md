---
title: Filter Pills Methods
weight: 8
---

You can customise the appearance/behaviour of the Filter Pills.

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


## Customising Appearance

You can customise the appearance of the items in the Filter Pills

### setFilterPillsItemAttributes
Allows for customisation of the appearance of the "Filter Pills Item"

Note that each filter has a setFilterPillBlade method [Here](./available-filter-methods) should you wish to customise a specific filter's pills further

This utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Filter Pills Item, the default colors are:

Bootstrap: None

Tailwind: `bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900`

#### default-styling
Setting to false will disable the default styling for the Filter Pills Item, the default styling is:

Bootstrap 4: `badge badge-pill badge-info d-inline-flex align-items-center`

Bootstrap 5: `badge rounded-pill bg-info d-inline-flex align-items-center`

Tailwind: `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 capitalize`

```php
public function configure(): void
{
  $this->setFilterPillsItemAttributes([
    'class' => 'bg-rose-300 text-rose-800 dark:bg-indigo-200 dark:text-indigo-900', // Add these classes to the filter pills item
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

### setFilterPillsResetFilterButtonAttributes
Allows for customisation of the appearance of the "Filter Pills Reset Filter Button"

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Filter Pills Reset Filter Button, the default colors are:

Bootstrap: None

Tailwind: `text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white`

#### default-styling
Setting to false will disable the default styling for the Filter Pills Reset Filter Button, the default styling is:

Bootstrap: `text-white ml-2`

Tailwind: `flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center focus:outline-none`

```php
public function configure(): void
{
  $this->setFilterPillsResetFilterButtonAttributes([
    'class' => 'text-rose-400 hover:bg-rose-200 hover:text-rose-500 focus:bg-rose-500', // Add these classes to the filter pills reset filter button
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

### setFilterPillsResetAllButtonAttributes
Allows for customisation of the appearance of the "Filter Pills Reset All Button"

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Filter Pills Reset All Button, the default colors are:

Bootstrap: None

Tailwind: `bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900`

#### default-styling
Setting to false will disable the default styling for the Filter Pills Reset All Button, the default styling is:

Bootstrap 4: `badge badge-pill badge-light`

Bootstrap 5: `badge rounded-pill bg-light text-dark text-decoration-none`

Tailwind: `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium`

```php
public function configure(): void
{
  $this->setFilterPillsResetAllButtonAttributes([
    'class' => 'bg-rose-100 text-rose-800 dark:bg-gray-200 dark:text-gray-900', // Add these classes to the filter pills reset all button
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```