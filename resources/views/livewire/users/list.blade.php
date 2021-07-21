@if($updateMode)
    @include('livewire.users.update')
@endif
<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>IC Number</th>
                <th>Name</th>
                <th>Email</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->ic }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>
                    <button wire:click="edit({{ $value->id }})" class="btn btn-primary btn-sm">Edit</button>
                    <!-- <button wire:click="deleteId({{ $value->id }})" class="btn btn-danger btn-sm">Delete</button> -->
                    @if($delete_id===$value->id)
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $value->id }})">YES</button>
                            <button type="button" class="btn btn-secondary btn-sm" wire:click="back()">NO</button>
                        </div>
                    @else
                        <button wire:click="deleteId({{ $value->id }})" class="btn btn-danger btn-sm">Delete</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>