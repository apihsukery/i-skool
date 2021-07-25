@if($form)
    @include('livewire.parameters.form')
@endif
<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if($level >= 2)
        <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">{{ $param_one }} - {{ $p1_desc }}</li>
                @if($level >= 3) <li class="breadcrumb-item">{{ $param_two }} - {{ $p2_desc }}</li> @endif
                @if($level >= 4) <li class="breadcrumb-item">{{ $param_three }} - {{ $p3_desc }}</li> @endif
                @if($level >= 5) <li class="breadcrumb-item">{{ $param_four }} - {{ $p4_desc }}</li> @endif
            </ol>
        </div>
    @endif
    <button class="btn btn-success" wire:click="create()">Create New</button>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($parameters as $value)
                <tr>
                    <td>{{ $value->param_one }}</td>
                    <td>{{ $value->description }}</td>
                    <td>
                        @if($level < 5)
                            <button wire:click="list_by_level({{ $value->param_one }},{{ $value->param_two }},{{ $value->param_three }},{{ $value->param_four }},{{ $value->param_five }})" class="btn btn-default btn-sm">View</button>
                        @endif
                        <button wire:click="" class="btn btn-primary btn-sm">Edit</button>
                        <button wire:click.prevent="" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No Parameter found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($level > 1)
        <button wire:click="prev()" class="btn btn-default">Previous</button>
    @endif
</div>
