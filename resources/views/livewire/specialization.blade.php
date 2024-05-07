<div>
    <div>
    <button wire:click="toggleAddForm" class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded mb-4">
        {{ $showAddForm ? 'Cancel' : 'Add Specialization' }}
    </button>

    @if ($showAddForm)
    @if (session()->has('status'))
    <div class="alert {{ session('status') ? 'alert-success' : 'alert-danger' }}">
        {{ session('status') }}
    </div>
 @endif
        <form wire:submit.prevent="save" class="mb-4">
            <div class="mb-4">
                <label for="course_name" class="block text-gray-700 text-sm font-bold mb-2">Course:</label>
                <select wire:model="course_name" id="course_name" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                    <option value="">Select Course</option>
                    @foreach ($courses as $programme) 
                    <option value="{{ $programme->id }}">{{ $programme->course_name }}</option>
                   @endforeach
                </select>
                @error('course_name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                
            </div>
            <div class="mb-4">
                <label for="sessions" class="block text-gray-700 text-sm font-bold mb-2">Specialization:</label>
                <x-input name="specialization_name" type="text" id="specialization_name" class="custom-class"
                        wire:model="specialization_name" 
                    required 
                />
                @error('specialization_name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                
            </div>
            
            <button type="submit" class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Add Specialization</button>
        </form>

    @endif

    @if (empty($specialization) )
    <p>No Specialization found.</p>
 @else
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($proggrammes as $proggramme)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $proggramme->programme_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button wire:click="edit({{ $proggramme->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                        <button wire:click="delete({{ $proggramme->id }})" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                    </td>
                </tr>
                
               @if ($showEditForm && $proggramme->id === $programme_id)
                    <tr>
                       
                        <td colspan="2">
                           Edit proggramme Form 
                           <form wire:submit.prevent="update" class="mb-4">
                            <div>
                                <label for="name">Programme Name:</label>
                                <x-input name="oprogramme_name" type="text" id="oprogramme_name" class="custom-class" wire:model="oprogramme_name"  required />

                                <div>@error('oprogramme_name') {{ $message }} @enderror</div>
                            </div>
                            <button type="submit" class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Update Programme</button>
                        </form>
                            
                        </td>
                    </tr>
                @endif 
            @endforeach
        </tbody>
    </table>
 @endif

</div>

