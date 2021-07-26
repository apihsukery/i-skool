<div>
    @if($level >= 2)
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">{{ $param_one }} - {{ $p1_desc }}</li>
                    @if($level >= 3) <li class="breadcrumb-item">{{ $param_two }} - {{ $p2_desc }}</li> @endif
                    @if($level >= 4) <li class="breadcrumb-item">{{ $param_three }} - {{ $p3_desc }}</li> @endif
                    @if($level >= 5) <li class="breadcrumb-item">{{ $param_four }} - {{ $p4_desc }}</li> @endif
                </ol>
            </div>
        </div> 
    @endif
    <input type="hidden" wire:model="selected_id">

    @error('new_param')
        <p class="text-danger">{{$message}}</p>
    @enderror
    <div class="form-group">
        <label>ID Number</label>
        <input type="number" wire:model="new_param" class="form-control input-sm"  placeholder="ID Number" @if($selected_id) disabled @endif>
    </div>
    @error('shortdesc')
        <p class="text-danger">{{$message}}</p>
    @enderror
    <div class="form-group">
        <label>Short Description</label>
        <input type="text" wire:model="shortdesc" class="form-control input-sm"  placeholder="Short Description">
    </div>
    @error('description')
        <p class="text-danger">{{$message}}</p>
    @enderror
    <div class="form-group">
        <label>Description</label>
        <input type="text" wire:model="description" class="form-control input-sm" placeholder="Description">
    </div>
    @if($selected_id)
        <button wire:click="update()" class="btn btn-primary">Update</button>
    @else
    <button wire:click="save()" class="btn btn-primary">Save</button>
    @endif
    <button wire:click="back()" class="btn btn-default">Back</button>
</div>