<?php

namespace WendellAdriel\ModelCompleted;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasCompletionStatus
{
    /**
     * The required fields for the model to be considered complete.
     *
     * @return Attribute
     */
    public function requiredFields(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->required ?? [],
        );
    }

    /**
     * How many fields are needed to be filled for the model to be considered complete.
     *
     * @return Attribute
     */
    public function totalFields(): Attribute
    {
        return Attribute::make(
            get: fn () => count($this->required_fields),
        );
    }

    /**
     * How many required fields are already filled.
     *
     * @return Attribute
     */
    public function filledFields(): Attribute
    {
        return Attribute::make(
            get: fn () => collect($this->required_fields)->filter(fn ($property) => ! empty($this->{$property}))->count(),
        );
    }

    /**
     * How many required fields are empty.
     *
     * @return Attribute
     */
    public function emptyFields(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->total_fields - $this->filled_fields,
        );
    }

    /**
     * The percentage of completion of the model.
     *
     * @return Attribute
     */
    public function completionPercentage(): Attribute
    {
        return Attribute::make(
            get: fn () => ($this->filled_fields * 100) / $this->total_fields,
        );
    }

    /**
     * If all required fields are filled the model is considered complete.
     *
     * @return Attribute
     */
    public function isComplete(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->empty_fields === 0
        );
    }

    /**
     * Append the completion status.
     *
     * @return self
     */
    public function withCompletionStatus()
    {
        return $this->append(['required_fields', 'is_complete']);
    }

    /**
     * Append the completion field counts.
     *
     * @return self
     */
    public function withCompletionCounts()
    {
        return $this->append(['required_fields', 'total_fields', 'filled_fields', 'empty_fields', 'completion_percentage']);
    }

    /**
     * Append the completion field counts plus the completion status
     *
     * @return self
     */
    public function withCompletionInfo()
    {
        return $this->append(['required_fields', 'total_fields', 'filled_fields', 'empty_fields', 'completion_percentage', 'is_complete']);
    }
}
