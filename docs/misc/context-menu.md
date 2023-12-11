---
title: Context Menu
weight: 8
---

There is a "whole table" context menu, with the following configuration abilities:

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

## disableContextMenu

To disable the Context Menu, you may define the content within the configure() method.

You have available the AlpineJS parameter "contextRowPrimaryKey" for use.

```php
    public function configure(): void
    {
        $this->setContextMenuContent('<div>
                Context Menu for Primary Key: <span x-text="contextRowPrimaryKey"></span>
            </div>
            <div @click="alert(contextRowPrimaryKey)" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                Alert
            </div>
            <div @click="contextMenuOpen=false" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                <span>Back</span>
            </div>
            <div @click="contextMenuOpen=false" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none" data-disabled>
                <span>Forward</span>
            </div>
            <div @click="contextMenuOpen=false" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none" data-disabled>
                <span>Edit</span>
            </div>
            <div @click="contextMenuOpen=false" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                <span>Reload</span>
            </div>');
    }
```