@if($form)
    @include('livewire.parameters.form')
@endif
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
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <button class="btn btn-primary" wire:click="create()">Create New</button>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="30%">Short Description</th>
                <th>Description</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($parameters as $value)
                @if($level == 1)
                    @php
                        $id = $value->param_one
                    @endphp
                @elseif($level == 2)
                    @php
                        $id = $value->param_two
                    @endphp
                @elseif($level == 3)
                    @php
                        $id = $value->param_three
                    @endphp
                @elseif($level == 4)
                    @php
                        $id = $value->param_four
                    @endphp
                @else
                    @php
                        $id = $value->param_five
                    @endphp
                @endif
                <tr>
                    <td>{{ $id }}</td>
                    <td>{{ $value->shortdesc }}</td>
                    <td>{{ $value->description }}</td>
                    <td>
                        @if($level < 5)
                            <button wire:click="list_by_level({{ $value->param_one }},{{ $value->param_two }},{{ $value->param_three }},{{ $value->param_four }},{{ $value->param_five }})" class="btn btn-default btn-sm">View</button>
                        @endif
                        <button wire:click="edit( {{ $value->id }},{{ $id }} )" class="btn btn-primary btn-sm">Edit</button>
                        <button wire:click="delete({{ $id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" class="btn btn-sm btn-danger">Delete</button>
                        <!-- <button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-sm btn-danger">Delete</button> -->
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

<!-- <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Parameter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to delete this ID?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click="deleteShowModal()" class="btn btn-primary close-modal">Delete</button>
            </div>
        </div>
    </div>
</div> -->
