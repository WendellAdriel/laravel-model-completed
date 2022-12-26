# Laravel Model Completed

> Laravel helper to know the completion status of an Eloquent Model

## Installation

```
composer require wendelladriel/laravel-model-completed
```

## Usage

This package provides a trait: `\WendellAdriel\ModelCompleted\HasCompletionStatus` that you can use in your **Eloquent Models**.

You also need to provide a `protected array $required` property with a list of required properties to consider your
**Model** completed:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use WendellAdriel\ModelCompleted\HasCompletionStatus;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasCompletionStatus;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    protected array $required = [
        'name',
        'email',
        'password'
    ];
}
```

## Properties

This trait adds six properties to the **Model**:

### required_fields

The list of required fields for the **Model** to be considered complete (the `$required` property or an **empty array** if the `$required` property is not set).

### total_fields

How many fields are needed to be filled for the **Model** to be considered complete.

### filled_fields

How many required fields are already filled.

### empty_fields

How many required fields are empty.

### completion_percentage

The percentage of completion of the **Model**.

### is_complete

If all required fields are filled the **Model** is considered complete.

## Methods

You can use the methods below to append them to the **Model** when needed:

### `withCompletionStatus`

Appends the `required_fields` and `is_complete` properties to the **Model**.

### `withCompletionCounts`

Appends the `required_fields`, `total_fields`, `filled_fields`, `empty_fields` and `completion_percentage` properties to the **Model**.

### `withCompletionInfo`

Appends the `required_fields`, `total_fields`, `filled_fields`, `empty_fields`, `completion_percentage` and `is_complete` properties to the **Model**.

## Credits

- [Wendell Adriel](https://github.com/WendellAdriel)
- [All Contributors](../../contributors)

## Contributing

All PRs are welcome.

For major changes, please open an issue first describing what you want to add/change.