<div>
    <button wire:click="toggleAddForm"
        style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
        class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded mb-4">
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
                <label for="course" class="block text-gray-700 text-sm font-bold mb-2">Course Name:</label>
                <x-input name="course_name" type="text" id="course_name" class="custom-class" wire:model="course_name"
                    required />
                @error('course_name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <button
                style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                type="submit" class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Add
                Course</button>
        </form>

    @endif

    @if (empty($course))
        <p>No Course found.</p>
    @else
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course
                        Name</th>

                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($course as $data)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $data->course_name }}</td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <button
                                style="background-color: rgb(26, 149, 219); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                wire:click="edit({{ $data->id }})"
                                style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button
                                style="background-color: rgb(255, 9, 9); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                wire:click="delete({{ $data->id }})" class="text-red-600 hover:text-red-900 ml-2"
                                style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;">Delete</button>
                        </td>
                    </tr>

                    @if ($showEditForm && $data->id === $c_id)
                        <tr>
                            <td colspan="2">
                                <form wire:submit.prevent="update" class="mb-4">
                                    <div class="mb-4">
                                        <label for="university"
                                            class="block text-gray-700 text-sm font-bold mb-2">Course Name:</label>
                                        <input type="text" name="course_name" wire:model="course_name">

                                        <div>
                                            @error('course_name')
                                                {{ $message }}
                                            @enderror
                                        </div>

                                    </div>
                                    <button
                                        style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                        type="submit"
                                        style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                        class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Update
                                        Course</button>
                                </form>

                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

</div>
