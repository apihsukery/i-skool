<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Parameter;
use Auth;
use DB;

class Parameters extends Component
{
    public $parameters, $p1_desc, $p2_desc, $p3_desc, $p4_desc;
    public $param_one=0, $param_two=0, $param_three=0, $param_four=0, $param_five=0, $shortdesc, $description, $selected_id;
    public $updateMode = false, $createMode = false, $form = false, $level=1;

    public function render()
    {
        // show all level 1 parameter
        if($this->param_one == 0)
        {
            $this->parameters = DB::table('parameter')
                                ->where([
                                    ['param_one','>', 0],
                                    ['param_two','=',0]
                                ])
                                ->get();
        }
        // show other level 1
        else{
            // $this->parameters = DB::table('parameter');
            $param = new Parameter;
            $param = DB::table('parameter');
            // level 2 list
            if($this->level == 2)
            {
                $param = $param->where([
                                    ['param_one','=', $this->param_one],
                                    ['param_two','>', 0]
                                ]);

                $desc1 = DB::table('parameter')
                        ->where([
                            ['param_one','=', $this->param_one],
                            ['param_two','=',0]
                        ])
                        ->first();
                $this->p1_desc = $desc1->description;
            }
            // level 3 list
            else if($this->level == 3)
            {
                $param = $param->where([
                                    ['param_one','=', $this->param_one],
                                    ['param_two','=', $this->param_two],
                                    ['param_three','>', 0]
                                ]);

                $desc2 = DB::table('parameter')
                        ->where([
                            ['param_one','=', $this->param_one],
                            ['param_two','=',$this->param_two],
                            ['param_three','=', 0]
                        ])
                        ->first();
                $this->p2_desc = $desc2->description;
            }

            $param = $param->get();
            $this->parameters = $param;
        }
        // dd($this->parameters);
        return view('livewire.parameters.list')->layout('layouts.base', ['title' => 'Parameters']);
    }

    public function list_by_level($p1,$p2,$p3,$p4,$p5)
    {
        if($p1) $this->param_one = $p1;
        if($p2) $this->param_two = $p2;
        if($p3) $this->param_three = $p3;
        if($p4) $this->param_four = $p4;
        if($p5) $this->param_five = $p5;

        $this->level++;
    }


    public function create()
    {
        $this->form = true;
    }

    public function save()
    {
        $this->validate([
            'param_one'    => 'required|max:3',
            'shortdesc'  => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $record = Parameter::firstOrCreate([
            'id' => $this->selected_id
        ],
        [
            'param_one'     => $this->param_one,
            'param_two'     => $this->param_two,
            'param_three'   => $this->param_three,
            'param_four'    => $this->param_four,
            'param_five'    => $this->param_five,
            'shortdesc'     => $this->shortdesc,
            'description'   => $this->description
        ]);

        // $this->resetInput();
        $this->form = false;
        session()->flash('message', 'Parameter save Successfully');
    }

    public function back()
    {
        $this->form = false;
    }

    public function prev()
    {
        $this->level--;

        if($this->level == 1)
        {
            $this->param_one = 0;
        }
        else if($this->level == 2)
        {
            $this->param_two = 0;
        }
        else if($this->level == 3)
        {
            $this->param_three = 0;
        }
        else if($this->level == 4)
        {
            $this->param_four = 0;
        }
        else if($this->level == 5)
        {
            $this->param_five = 0;
        }
    }
}
