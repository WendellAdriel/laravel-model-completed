<?php

namespace WendellAdriel\ModelCompleted\Tests\Unit;

use WendellAdriel\ModelCompleted\Tests\Dataset\ModelInstance;
use WendellAdriel\ModelCompleted\Tests\TestCase;

class ModelCompletionTest extends TestCase
{
    private array $modelRequiredFields = ['name', 'email', 'password'];

    public function testCompletionStatus()
    {
        $model = new ModelInstance();
        $model->withCompletionStatus();
        $this->assertFalse($model->is_complete);
        $this->assertIsArray($model->required_fields);
        $this->assertEquals($this->modelRequiredFields, $model->required_fields);

        $model->fill([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 's3cR3T',
        ]);

        $this->assertTrue($model->is_complete);
    }

    public function testCompletionCounts()
    {
        $model = new ModelInstance();
        $model->withCompletionCounts();
        $this->assertTrue($model->total_fields === 3);
        $this->assertTrue($model->filled_fields === 0);
        $this->assertTrue($model->empty_fields === 3);
        $this->assertTrue($model->completion_percentage === 0);
        $this->assertIsArray($model->required_fields);
        $this->assertEquals($this->modelRequiredFields, $model->required_fields);

        $model->fill([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 's3cR3T',
        ]);

        $this->assertTrue($model->total_fields === 3);
        $this->assertTrue($model->filled_fields === 3);
        $this->assertTrue($model->empty_fields === 0);
        $this->assertTrue($model->completion_percentage === 100);
    }

    public function testCompletionInfo()
    {
        $model = new ModelInstance();
        $model->withCompletionInfo();
        $this->assertTrue($model->total_fields === 3);
        $this->assertTrue($model->filled_fields === 0);
        $this->assertTrue($model->empty_fields === 3);
        $this->assertTrue($model->completion_percentage === 0);
        $this->assertFalse($model->is_complete);
        $this->assertIsArray($model->required_fields);
        $this->assertEquals($this->modelRequiredFields, $model->required_fields);

        $model->fill([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 's3cR3T',
        ]);

        $this->assertTrue($model->total_fields === 3);
        $this->assertTrue($model->filled_fields === 3);
        $this->assertTrue($model->empty_fields === 0);
        $this->assertTrue($model->completion_percentage === 100);
        $this->assertTrue($model->is_complete);
    }
}
