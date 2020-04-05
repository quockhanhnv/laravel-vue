<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueAnswerCorrectValidate implements Rule
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
        $corrects = [];

        foreach ($this->answers as $answer) {
            if ($answer['correct']) {
                array_push($corrects, true);
            }
        }

        return count($corrects) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Một câu hỏi chỉ được phép có 1 câu trả lời đúng';
    }
}
