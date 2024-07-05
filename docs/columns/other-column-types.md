---
title: Other Column Types
weight: 4
---

## Boolean Columns

Boolean columns are good if you have a column type that is a true/false, or 0/1 value.

For example:

```php
BooleanColumn::make('Active')
```

Would yield:

![Boolean Column](https://imgur.com/LAk6gHY.png)

### Using your own view

If you don't want to use the default view and icons you can set your own:

```php
BooleanColumn::make('Active')
    ->setView('my.active.view')
```

You will have access to `$component`, `$status`, and `$successValue`.

To help you better understand, this is the Tailwind implementation of BooleanColumn:

```html
@if ($status)
    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5 @if ($successValue === true) text-green-500 @else text-red-500 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
@else
    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5 @if ($successValue === false) text-green-500 @else text-red-500 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
@endif
```

### Setting the truthy value

If you want the false value to be the green option, you can set:

```php
BooleanColumn::make('Active')
    ->setSuccessValue(false); // Makes false the 'successful' option
```

That would swap the colors of the icons in the image above.

### Setting the status value

By default, the `$status` is set to:

```php
(bool)$value === true
```

You can override this functionality:

```php
BooleanColumn::make('Active')
    // Note: Parameter `$row` available as of v2.4
    ->setCallback(function(string $value, $row) {
        // Figure out what makes $value true
    }),
```

### Different types of boolean display

By default, the BooleanColumn displays icons.

If you would like the BooleanColumn to display a plain Yes/No, you can set:

```php
BooleanColumn::make('Active')
    ->yesNo()
```
## Color Columns

Color columns provide an easy way to a Color in a Column

You may pass either pass a CSS-compliant colour as a field
```php
ColorColumn::make('Favourite Colour', 'favourite_color'),
```

Or you may use a Callback
```php
ColorColumn::make('Favourite Colour')
    ->color(
            function ($row) {
                if ($row->success_rate < 40)
                {
                    return '#ff0000';
                }
                else if ($row->success_rate > 90)
                {
                    return '#008000';
                }
                else return '#ffa500';
                    
            }
        ),
```

You may also specify attributes to use on the div displaying the color, to adjust the size or appearance, this receives the full row.  By default, this will replace the standard classes, to retain them, set "default" to true.  To then over-ride, you should prefix your classes with "!" to signify importance.
```php
    ColorColumn::make('Favourite Colour')
            ->attributes(function ($row) {
                return [
                    'class' => '!rounded-lg self-center',
                    'default' => true,
                ];
            }),
```

## Date Columns

Date columns provide an easy way to display dates in a given format, without having to use repetitive format() methods or partial views.

You may pass either a DateTime object, in which you can define an "outputFormat"
```php
DateColumn::make('Updated At', 'updated_at')
    ->outputFormat('Y-m-d H:i:s),
```

Or you may pass a string, in which case you can define an "inputFormat" in addition to the outputFormat:
```php
DateColumn::make('Last Charged', 'last_charged_at')
    ->inputFormat('Y-m-d H:i:s')
    ->outputFormat('Y-m-d'),
```

You may also set an "emptyValue" to use when there is no value from the database:
```php
DateColumn::make('Last Charged', 'last_charged_at')
    ->inputFormat('Y-m-d H:i:s')
    ->outputFormat('Y-m-d')
    ->emptyValue('Not Found'),
```

## Image Columns

Image columns provide a way to display images in your table without having to use `format()` or partial views:

```php
ImageColumn::make('Avatar')
    ->location(
        fn($row) => storage_path('app/public/avatars/' . $row->id . '.jpg')
    ),
```

You may also pass an array of attributes to apply to the image tag:

```php
ImageColumn::make('Avatar')
    ->location(
        fn($row) => storage_path('app/public/avatars/' . $row->id . '.jpg')
    )
    ->attributes(fn($row) => [
        'class' => 'rounded-full',
        'alt' => $row->name . ' Avatar',
    ]),
```

## Link Columns

Link columns provide a way to display HTML links in your table without having to use `format()` or partial views:

```php
LinkColumn::make('Action')
    ->title(fn($row) => 'Edit')
    ->location(fn($row) => route('admin.users.edit', $row)),
```

You may also pass an array of attributes to apply to the `a` tag:

```php
LinkColumn::make('Action')
    ->title(fn($row) => 'Edit')
    ->location(fn($row) => route('admin.users.edit', $row))
    ->attributes(fn($row) => [
        'class' => 'rounded-full',
        'alt' => $row->name . ' Avatar',
    ]),
```

## Button Group Columns

Button group columns let you provide an array of LinkColumns to display in a single cell.

```php
ButtonGroupColumn::make('Actions')
    ->attributes(function($row) {
        return [
            'class' => 'space-x-2',
        ];
    })
    ->buttons([
        LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
            ->title(fn($row) => 'View ' . $row->name)
            ->location(fn($row) => route('user.show', $row))
            ->attributes(function($row) {
                return [
                    'class' => 'underline text-blue-500 hover:no-underline',
                ];
            }),
        LinkColumn::make('Edit')
            ->title(fn($row) => 'Edit ' . $row->name)
            ->location(fn($row) => route('user.edit', $row))
            ->attributes(function($row) {
                return [
                    'target' => '_blank',
                    'class' => 'underline text-blue-500 hover:no-underline',
                ];
            }),
    ]),
```

## Component Columns

Component columns let you specify a component name and attributes and provides the column value to the slot.

```php
// Before
Column::make("Email", "email")
    ->format(function ($value) {
        return view('components.alert')
            ->with('attributes', new ComponentAttributeBag([
                'type' => Str::endsWith($value, 'example.org') ? 'success' : 'danger',
                'dismissible' => true,
            ]))
            ->with('slot', $value);
    }),

// After
ComponentColumn::make('E-mail', 'email')
    ->component('email')
    ->attributes(fn ($value, $row, Column $column) => [
        'type' => Str::endsWith($value, 'example.org') ? 'success' : 'danger',
        'dismissible' => true,
    ]),
```

## Aggregate Columns

### AvgColumn

### CountColumn

### SumColumn