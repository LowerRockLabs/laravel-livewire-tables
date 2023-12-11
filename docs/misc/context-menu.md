---
title: Context Menu
weight: 8
---

**NOTE - THIS FEATURE IS CURRENTLY IN BETA**

There is a "whole table" context menu, which is disabled by default.

This presents the following configuration abilities

## enableContextMenu

To enable the Context Menu 
```php
    public function configure(): void
    {
        $this->enableContextMenu();
    }
```

## disableContextMenu

To disable the Context Menu 
```php
    public function configure(): void
    {
        $this->disableContextMenu();
    }
```

## setContextMenuContent

To disable the Context Menu, you may define the content within the configure() method.

When interacted with, the AlpineJS variable "contextRowPrimaryKey" will be set to the primary key of the row interacted with.

In this example:
- The "Alert" item, will use a js alert() call with the Primary Key of the row.
- The "Edit" item will call the "editItem" method in your Component, passing the Primary Key of the rowas the first parameter.

You may of course use Livewire dispatch methods or similar to open Modals, or pass to other Livewire Components.
```php
    public function configure(): void
    {
        $this->enableContextMenu();
        $this->setContextMenuContent('<div>
                Context Menu for Primary Key: <span x-text="contextRowPrimaryKey"></span>
            </div>
            <div @click="alert(contextRowPrimaryKey)" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                Alert
            </div>
            <div @click="$wire.editItem(contextRowPrimaryKey)" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                <span>Edit</span>
            </div>');
    }
```


## setContextMenuAttributes

To set default classes for the context menu, you may define them here.  Note that this will over-write the standard classes, unless "default" is set to true.
```php
    public function configure(): void
    {
        $this->enableContextMenu();
        $this->setContextMenuContent('<div>
                Context Menu for Primary Key: <span x-text="contextRowPrimaryKey"></span>
            </div>
        ');
        $this->setContextMenuAttributes([
            'class' => 'z-50 min-w-[8rem] text-neutral-800 rounded-md border border-neutral-200/70 bg-white text-sm fixed p-1 shadow-md w-12',
            'default' => true,
        ]);
    }
```

## Full Example

This combines the above configuration examples to display what a typical context menu may look like:

```php
    public function configure(): void
    {
        $this->enableContextMenu()
            ->setContextMenuContent('<div>
                Context Menu for Primary Key: <span x-text="contextRowPrimaryKey"></span>
            </div>
            <div @click="alert(contextRowPrimaryKey)" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                Alert
            </div>
            <div @click="$wire.editItem(contextRowPrimaryKey)" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                <span>Edit</span>
            </div>')
            ->setContextMenuAttributes([
            'class' => 'z-50 min-w-[8rem] text-neutral-800 rounded-md border border-neutral-200/70 bg-white text-sm fixed p-1 shadow-md w-64',
            'default' => true,
        ]);
    }
```