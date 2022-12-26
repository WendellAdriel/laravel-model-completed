<?php

namespace WendellAdriel\ModelCompleted\Tests\Dataset;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\ModelCompleted\HasCompletionStatus;

class ModelInstance extends Model
{
    use HasCompletionStatus;

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
