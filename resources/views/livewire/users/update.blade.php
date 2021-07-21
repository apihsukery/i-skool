<div>
    <input type="hidden" wire:model="selected_id">
    @error('ic')
        <p class="text-danger">{{$message}}</p>
    @enderror
    <div class="form-group">
        <label>IC Number</label>
        <input type="text" wire:model="ic" class="form-control input-sm"  placeholder="IC Number">
    </div>
    @error('name')
        <p class="text-danger">{{$message}}</p>
    @enderror
    <div class="form-group">
        <label>Name</label>
        <input type="text" wire:model="name" class="form-control input-sm"  placeholder="Name">
    </div>
    @error('email')
        <p class="text-danger">{{$message}}</p>
    @enderror
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control input-sm" placeholder="email" wire:model="email">
    </div>
    <button wire:click="update()" class="btn btn-primary">Update</button>
    <button wire:click="back()" class="btn btn-default">Back</button>
</div>