<div>
<input type="text" wire:model="selected_id">
    @error('param_one')
        <p class="text-danger">{{$message}}</p>
    @enderror
    <div class="form-group">
        <label>ID Number</label>
        <input type="number" wire:model="param_one" class="form-control input-sm"  placeholder="ID Number">
    </div>
    @error('shortdesc')
        <p class="text-danger">{{$message}}</p>
    @enderror
    <div class="form-group">
        <label>Short Description</label>
        <input type="text" wire:model="shortdesc" class="form-control input-sm"  placeholder="Short Description">
    </div>
    @error('Description')
        <p class="text-danger">{{$message}}</p>
    @enderror
    <div class="form-group">
        <label>Description</label>
        <input type="text" wire:model="description" class="form-control input-sm" placeholder="Description">
    </div>
    <button wire:click="save()" class="btn btn-primary">Save</button>
    <button wire:click="back()" class="btn btn-default">Back</button>
</div>