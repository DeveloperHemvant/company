<div>
    <button wire:click="toggleAddForm" class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded mb-4">
        {{ $showAddForm ? 'Cancel' : 'Add Course' }}
    </button>

    @if ($showAddForm)
    @if (session()->has('status'))
    <div class="alert {{ session('status') ? 'alert-success' : 'alert-danger' }}">
        {{ session('status') }}
    </div>
@endif
        <form wire:submit.prevent="save" class="mb-4">
            <div class="mb-4">
                <label for="sessions" class="block text-gray-700 text-sm font-bold mb-2">Programme:</label>
                <select wire:model="programme_id" id="programme_id" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Programme</option>
                    @foreach ($programmes as $programme) 
                    <option value="{{ $programme->id }}">{{ $programme->programme_name }}</option>
                   @endforeach
                </select>
                @error('programmes') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                
            </div>
            <div class="mb-4">
                <label for="course" class="block text-gray-700 text-sm font-bold mb-2">Course Name:</label>
                <x-input name="course_name" type="text" id="course_name" class="custom-class"
                                 wire:model="course_name" 
                                required 
                            />
                @error('course_name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="course" class="block text-gray-700 text-sm font-bold mb-2">Admission Fee:</label>
                <x-input name="admission_fee" type="text" id="admission_fee" class="custom-class"
                                 wire:model="admission_fee" 
                                required 
                            />
                @error('admission_fee') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="course" class="block text-gray-700 text-sm font-bold mb-2">Exam Fee:</label>
                <x-input name="exam_fee" type="text" id="exam_fee" class="custom-class"
                                 wire:model="exam_fee" 
                                required 
                            />
                @error('exam_fee') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>
           
            <div class="mb-4">
                <label for="course" class="block text-gray-700 text-sm font-bold mb-2">Late Fee:</label>
                <x-input name="late_fee" type="text" id="late_fee" class="custom-class"
                                 wire:model="late_fee" 
                                required 
                            />
                @error('exam_fee') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div>
            

            


            <button type="submit" class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Add Course</button>
        </form>

    @endif

    @if (empty($course) )
    <p>No Course found.</p>
@else
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Programme Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($course as $data)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $data->course_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $data->programmes->programme_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button wire:click="edit({{ $data->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                        <button wire:click="delete({{ $data->id }})" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                    </td>
                </tr>
                
                @if ($showEditForm && $data->id === $c_id)
                    <tr>
                        {{-- {{$u_session}} --}}
                        <td colspan="2">
                            <!-- Edit sessions Form -->
                            <form wire:submit.prevent="update" class="mb-4">
                                <div class="mb-4">
                                    <label for="university" class="block text-gray-700 text-sm font-bold mb-2">Course Name:</label>
                                    <input type="text" name="id" wire:model="oldcourse" >
                                    
                                    <div>@error('oldcourse') {{ $message }} @enderror</div>
                              
                                </div>
                                <div class="mb-4">
                                    <label for="selectedMonth" class="block text-gray-700 text-sm font-bold mb-2">Programme:</label>
                                    <select wire:model="u_programme" id="selectedMonth" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Select Programme</option>
                                        @foreach ($programmes as $programme)
                                        <option value="{{ $programme->id }}" {{ $programme->id === $old_p_id ? 'disabled' : '' }}>{{ $programme->programme_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedMonth') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                                </div>
                                
                            
                                <button type="submit" class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Update Course</button>
                            </form>
                            
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endif

</div>

