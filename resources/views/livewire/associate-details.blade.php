<div>
    <button wire:click="toggleAddForm" class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded mb-4">
        {{ $showAddForm ? 'Cancel' : 'Add Associate' }}
    </button>

    @if ($showAddForm)
    @if (session()->has('status'))
    <div class="alert {{ session('status') ? 'alert-success' : 'alert-danger' }}">
        {{ session('status') }}
    </div>
@endif
        <form wire:submit.prevent="save" class="mb-4">
            <input type="text" wire:model="associate_name" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter associate name">
            <div>@error('associate_name') {{ $message }} @enderror</div>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">Add</button>
        </form>
    @endif

    @if ($data->count())
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($data as $associate)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $associate->associate_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="edit({{ $associate->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button wire:click="delete({{ $associate->id }})" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        </td>
                    </tr>
                    @if ($showEditForm && $associate->id === $associate_id)
                        <tr>
                       
                            <td colspan="2">
                                <!-- Edit Associate Form -->
                                <form wire:submit.prevent="update">
                                    {{-- <input type="hidden" name="id" wire:model="id" value="{{$associate->id}}"> --}}
                                    <input type="text" wire:model="updateassociate_name" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter associate name">
                                    <button type="submit" class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Update</button>
                                </form>
                                
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <p>No associates found.</p>
    @endif
</div>

