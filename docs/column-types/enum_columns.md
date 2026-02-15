---
title: Enum Columns
weight: 10
---

Enum columns provide the capability to utilise your existing Enum casting, without having to use repetitive format().



## Undefined Enum Values

When you directly Cast to an Enum, you may experience an error similar to 
"4 is not a valid backing value for enum App\Enums\ExampleEnum"
where a value exists in your Model that you have not accounted for in your Enum.

The simplest mitigation for this, is utilising a CastsAttributes class between the Model and your Enum.  This is of course optional, and if you have ensured that your Model Values are always valid Enum values, then this isn't required.

An example of what this looks like is below, which utilises an int field in the database, with scale from 0 (None) to 3 (High).

### ExampleEnum
```php

namespace App\Enums;

enum ExampleEnum: int
{
    case None = 0;
    case Low = 1;
    case Medium = 2;
    case High = 3;
}
```

### ExampleCast
```php

namespace App\Casts; 
 
use Illuminate\Contracts\Database\Eloquent\CastsAttributes; 
use Illuminate\Database\Eloquent\Model; 
use App\Enums\ExampleEnum; 

class ExampleCast implements CastsAttributes 
{ 
    /** 
     * @param array<string, mixed> $attributes 
     */ 
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed 
    { 
       return rescue(fn() => ExampleEnum::tryFrom($value), report: false); 
    } 
 
    /** 
     * @param array<string, mixed> $attributes 
     */ 
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed 
    { 
        return $value instanceof ExampleEnum ? $value->value : $value; 
    } 
}
```

### Example Model
```php

namespace App\Models; 

use Illuminate\Database\Eloquent\Model;
use App\Casts\ExampleCast;

class ExampleModel extends Model
{
    protected function casts(): array
    {
        return [
            'example_field' => ExampleCast::class,
        ];
    }
}
```

### Example Table

This will return either the Enum value, or "Unknown" as a default value

```php

    /**
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            EnumColumn::make('Example Field', 'example_field')->setDefaultValue('Unknown')->sortable(),
        ];
    }
```