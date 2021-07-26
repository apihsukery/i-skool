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
        @if($users)
            @foreach($users as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->ic }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>
                @if(Auth::user()->id===$value->id)
                    <button wire:click="edit({{ $value->id }})" class="btn btn-primary btn-sm">Edit</button>
                    <!-- <button wire:click="deleteId({{ $value->id }})" class="btn btn-danger btn-sm">Delete</button> -->
                @else
                    <button wire:click="delete({{ $value->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" class="btn btn-sm btn-danger">Delete</button>
                @endif
                </td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
