<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AnswerNumberValidate implements Rule
{
    private $answers;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($answers)
    {
        $this->answers = $answers;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return count($this->answers) >= 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Câu hỏi phải có tối thiểu là 2 câu trả lời';
    }
}
