<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Parameter;
use DB;

class CheckNewParam implements Rule
{
    protected $lvl, $param_one, $param_two, $param_three, $param_four, $param_five;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($level,$param_one,$param_two,$param_three,$param_four,$param_five)
    {
        $this->lvl = $level;
        $this->param_one = $param_one;
        $this->param_two = $param_two;
        $this->param_three = $param_three;
        $this->param_four = $param_four;
        $this->param_five = $param_five;
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
        $check = new Parameter;
        $check = DB::table('parameter');
        // level 2 list
        if($this->lvl == 1)
        {
            $check = $check->where('param_one', $value);
        }
        else if($this->lvl == 2)
        {
            $check = $check->where('param_one', $this->param_one);
            $check = $check->where('param_two', $value);
        }
        else if($this->lvl == 3)
        {
            $check = $check->where('param_one', $this->param_one);
            $check = $check->where('param_two', $this->param_two);
            $check = $check->where('param_three', $value);
        }
        else if($this->lvl == 4)
        {
            $check = $check->where('param_one', $this->param_one);
            $check = $check->where('param_two', $this->param_two);
            $check = $check->where('param_three', $this->param_three);
            $check = $check->where('param_four', $value);
        }
        else if($this->lvl == 5)
        {
            $check = $check->where('param_one', $this->param_one);
            $check = $check->where('param_two', $this->param_two);
            $check = $check->where('param_three', $this->param_three);
            $check = $check->where('param_four', $this->param_four);
            $check = $check->where('param_five', $value);
        }
        $check = $check->doesntExist();

        if ($check) {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The ID Number already taken. Please choose another number.';
    }
}
