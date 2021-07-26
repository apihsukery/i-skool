<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Parameter;
use Auth;
use DB;
use App\Rules\CheckNewParam;

class Parameters extends Component
{
    public $parameters, $p1_desc, $p2_desc, $p3_desc, $p4_desc;
    public $param_one=0, $param_two=0, $param_three=0, $param_four=0, $param_five=0, $shortdesc, $description, $new_param, $selected_id;
    public $form = false, $level=1, $confirmDeletion = false;

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
                                ->orderBy('param_one')
                                ->get();
        }
        // show other level 1
        else{
            $param = new Parameter;
            $param = DB::table('parameter');
            // level 2 list
            if($this->level == 2)
            {
                $param = $param->where([
                                    ['param_one','=', $this->param_one],
                                    ['param_two','>', 0],
                                    ['param_three','=', 0],
                                    ['param_four','=', 0],
                                    ['param_five','=', 0]
                                ])
                                ->orderBy('param_two');

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
                                    ['param_three','>', 0],
                                    ['param_four','=', 0],
                                    ['param_five','=', 0]
                                ])
                                ->orderBy('param_three');

                $desc2 = DB::table('parameter')
                        ->where([
                            ['param_one','=', $this->param_one],
                            ['param_two','=',$this->param_two],
                            ['param_three','=', 0]
                        ])
                        ->first();
                $this->p2_desc = $desc2->description;
            }
            // level 4 list
            else if($this->level == 4)
            {
                $param = $param->where([
                                    ['param_one','=', $this->param_one],
                                    ['param_two','=', $this->param_two],
                                    ['param_three','=', $this->param_three],
                                    ['param_four','>', 0],
                                    ['param_five','=', 0]
                                ])
                                ->orderBy('param_four');

                $desc3 = DB::table('parameter')
                        ->where([
                            ['param_one','=', $this->param_one],
                            ['param_two','=',$this->param_two],
                            ['param_three','=',$this->param_three],
                            ['param_four','=', 0]
                        ])
                        ->first();
                $this->p3_desc = $desc3->description;
            }
            // level 5 list
            else if($this->level == 5)
            {
                $param = $param->where([
                                    ['param_one','=', $this->param_one],
                                    ['param_two','=', $this->param_two],
                                    ['param_three','=', $this->param_three],
                                    ['param_four','=', $this->param_four],
                                    ['param_five','>', 0]
                                ])
                                ->orderBy('param_five');

                $desc4 = DB::table('parameter')
                        ->where([
                            ['param_one','=', $this->param_one],
                            ['param_two','=',$this->param_two],
                            ['param_three','=',$this->param_three],
                            ['param_four','=',$this->param_four],
                            ['param_five','=', 0]
                        ])
                        ->first();
                $this->p4_desc = $desc4->description;
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

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);

    //     // if (DB::table('parameter')->where('param_one', $this->new_param)->where('param_one', $this->new_param)->exists()) {
    //     //     $this->error_msg = "This ID already use. Please choose another number.";
    //     // }
    //     // else{
    //     //     $this->error_msg = '';
    //     // }
    // }

    // protected $rules = [
    //     'new_param'    => ['required','max:3'],
    //     'shortdesc'  => ['required','string','max:255'],
    //     'description' => ['required','string','max:255']
    // ];

    protected $messages = [
        'new_param.required' => 'The ID Number field is required',
        'new_param.max' => 'The ID Number must not be greater than 3 characters.',
    ];

    public function create()
    {
        $this->form = true;
    }

    public function save()
    {
        // $this->validate();
        $this->validate([
            'new_param'    => ['required','max:3',new CheckNewParam($this->level,$this->param_one,$this->param_two,$this->param_three,$this->param_four,$this->param_five)],
            'shortdesc'  => ['required','string','max:255'],
            'description' => ['required','string','max:255']
        ]);

        $create = new Parameter;
        $create = DB::table('parameter');
        if($this->level == 1)
        {
            $create = $create->insert([
                'param_one'     => $this->new_param,
                'shortdesc'     => $this->shortdesc,
                'description'   => $this->description
            ]);
        }
        else if($this->level == 2)
        {
            $create = $create->insert([
                'param_one'     => $this->param_one,
                'param_two'     => $this->new_param,
                'shortdesc'     => $this->shortdesc,
                'description'   => $this->description
            ]);
        }
        else if($this->level == 3)
        {
            $create = $create->insert([
                'param_one'     => $this->param_one,
                'param_two'     => $this->param_two,
                'param_three'   => $this->new_param,
                'shortdesc'     => $this->shortdesc,
                'description'   => $this->description
            ]);
        }
        else if($this->level == 4)
        {
            $create = $create->insert([
                'param_one'     => $this->param_one,
                'param_two'     => $this->param_two,
                'param_three'   => $this->param_three,
                'param_four'    => $this->new_param,
                'shortdesc'     => $this->shortdesc,
                'description'   => $this->description
            ]);
        }
        else if($this->level == 5)
        {
            $create = $create->insert([
                'param_one'     => $this->param_one,
                'param_two'     => $this->param_two,
                'param_three'   => $this->param_three,
                'param_four'    => $this->param_four,
                'param_five'    => $this->new_param,
                'shortdesc'     => $this->shortdesc,
                'description'   => $this->description
            ]);
        }

        $this->resetInput();
        $this->form = false;
        session()->flash('message', 'New Parameter Save Successfully');
    }

    public function edit($id,$param_id)
    {
        $record = Parameter::findOrFail($id);
        $this->selected_id  = $id;
        $this->new_param    = $param_id;
        $this->shortdesc    = $record->shortdesc;
        $this->description  = $record->description;
        $this->form         = true;
    }

    public function update()
    {
        $this->validate([
            'shortdesc'  => ['required','string','max:255'],
            'description' => ['required','string','max:255']
        ]);
        if ($this->selected_id) {
            $record = Parameter::find($this->selected_id);
            $record->update([
                'shortdesc'     => $this->shortdesc,
                'description'   => $this->description
            ]);
            $this->form = false;
            session()->flash('message', 'ID Number '.$this->new_param.' Update Successfully.');
            $this->resetInput();
        }
    }

    public function delete($id)
    {
        $delete = DB::table('parameter');
        if($this->level == 1){
            $delete->where("param_one", $id);
        }
        else if($this->level == 2){
            $delete->where("param_one", $this->param_one);
            $delete->where("param_two", $id);
        }
        else if($this->level == 3){
            $delete->where("param_one", $this->param_one);
            $delete->where("param_two", $this->param_two);
            $delete->where("param_three", $id);
        }
        else if($this->level == 4){
            $delete->where("param_one", $this->param_one);
            $delete->where("param_two", $this->param_two);
            $delete->where("param_three", $this->param_three);
            $delete->where("param_four", $id);
        }
        else if($this->level == 5){
            $delete->where("param_one", $this->param_one);
            $delete->where("param_two", $this->param_two);
            $delete->where("param_three", $this->param_three);
            $delete->where("param_four", $this->param_four);
            $delete->where("param_five", $id);
        }
        $delete->delete();
        session()->flash('message', 'ID Number '.$id.' Delete Successfully.');
    }

    private function resetInput(){
        $this->selected_id  = '';
        $this->new_param    = '';
        $this->shortdesc    = '';
        $this->description  = '';
    }

    public function back()
    {
        $this->form = false;
        $this->error_msg = '';
        $this->resetInput();
        $this->resetErrorBag();
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

    public function deleteShowModal(){
        session()->flash('message', 'ID Number '.$id.' Delete Successfully.');
    }
}
