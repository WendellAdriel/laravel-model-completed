<?php

use WendellAdriel\ModelCompleted\Tests\Datasets\ModelInstance;

it('adds completion status fields', function (...$requiredFields) {
    $model = new ModelInstance();
    $model->withCompletionStatus();

    expect($model->is_complete)
        ->toBeFalse()
        ->and($model->required_fields)
        ->toBeArray()
        ->toEqual($requiredFields);

    $model->fill([
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'password' => 's3cR3T',
    ]);

    expect($model->is_complete)->toBeTrue();
})->with('required_fields');

it('adds completion counts fields', function (...$requiredFields) {
    $model = new ModelInstance();
    $model->withCompletionCounts();

    expect($model->total_fields)
        ->toBe(3)
        ->and($model->filled_fields)
        ->toBe(0)
        ->and($model->empty_fields)
        ->toBe(3)
        ->and($model->completion_percentage)
        ->toBe(0)
        ->and($model->required_fields)
        ->toBeArray()
        ->toEqual($requiredFields);

    $model->fill([
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'password' => 's3cR3T',
    ]);

    expect($model->total_fields)
        ->toBe(3)
        ->and($model->filled_fields)
        ->toBe(3)
        ->and($model->empty_fields)
        ->toBe(0)
        ->and($model->completion_percentage)
        ->toBe(100);
})->with('required_fields');

it('adds completion info fields', function (...$requiredFields) {
    $model = new ModelInstance();
    $model->withCompletionCounts();

    expect($model->total_fields)
        ->toBe(3)
        ->and($model->filled_fields)
        ->toBe(0)
        ->and($model->empty_fields)
        ->toBe(3)
        ->and($model->completion_percentage)
        ->toBe(0)
        ->and($model->is_complete)
        ->toBeFalse()
        ->and($model->required_fields)
        ->toBeArray()
        ->toEqual($requiredFields);

    $model->fill([
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'password' => 's3cR3T',
    ]);

    expect($model->total_fields)
        ->toBe(3)
        ->and($model->filled_fields)
        ->toBe(3)
        ->and($model->empty_fields)
        ->toBe(0)
        ->and($model->completion_percentage)
        ->toBe(100)
        ->and($model->is_complete)
        ->toBeTrue();
})->with('required_fields');
