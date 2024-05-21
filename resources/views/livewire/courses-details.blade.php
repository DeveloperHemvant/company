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
        <form wire:submit.prevent="save" class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg" autocomplete="off">
            <div class="mb-4">
                <label for="course" class="block text-gray-700 font-bold mb-2">University:</label>
                <select wire:model="university_id" id="university" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select University</option>
                    @foreach ($universities as $item)
                        <option value="{{$item->id}}">{{ $item->university_name }}</option>
                    @endforeach
                </select>
                @error('university_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="course_type" class="block text-gray-700 font-bold mb-2">Course Type:</label>
                <select wire:model="course_type" id="course_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Course Type</option>
                    <option value="UG">UG</option>
                    <option value="PG">PG</option>
                    <option value="Diploma">Diploma</option>
                </select>
                @error('course_type')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="course_name" class="block text-gray-700 font-bold mb-2">Course Name:</label>
                <input type="text" id="course_name" wire:model="course_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('course_name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="duration" class="block text-gray-700 font-bold mb-2">Duration:</label>
                <select wire:model="duration" id="duration" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Course Duration</option>
                    <option value="1 Semester">1 Semester</option>
                    <option value="2 Semester">2 Semester</option>
                    <option value="3 Semester">3 Semester</option>
                    <option value="4 Semester">4 Semester</option>
                    <option value="5 Semester">5 Semester</option>
                    <option value="6 Semester">6 Semester</option>
                    <option value="7 Semester">7 Semester</option>
                    <option value="8 Semester">8 Semester</option>
                </select>
                @error('duration')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add Course
                </button>
            </div>
        </form>
        

    @endif

    @if (empty($courses))
        <p>No Course found.</p>
    @else
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course
                        Name</th>
                        <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">University
                        Name</th>
                        <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course
                        Type</th>

                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            {{-- {{$courses}} --}}
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($courses as $data)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $data->course_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{  $data->university->university_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $data->course_type }}</td>
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
                                <form wire:submit.prevent="update" class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg" autocomplete="off">
                                    <div class="mb-4">
                                        <label for="course" class="block text-gray-700 font-bold mb-2">University:</label>
                                        <select wire:model="university_id" id="university" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <option value="">Select University</option>
                                            @foreach ($universities as $item)
                                                <option value="{{$item->id}}">{{ $item->university_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('university_id')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="course_type" class="block text-gray-700 font-bold mb-2">Course Type:</label>
                                        <select wire:model="course_type" id="course_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <option value="">Select Course Type</option>
                                            <option value="UG">UG</option>
                                            <option value="PG">PG</option>
                                            <option value="Diploma">Diploma</option>
                                        </select>
                                        @error('course_type')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="course_name" class="block text-gray-700 font-bold mb-2">Course Name:</label>
                                        <input type="text" id="course_name" wire:model="course_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('course_name')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="duration" class="block text-gray-700 font-bold mb-2">Duration:</label>
                                        <select wire:model="duration" id="duration" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <option value="">Select Course Duration</option>
                                            <option value="1 Semester">1 Semester</option>
                                            <option value="2 Semester">2 Semester</option>
                                            <option value="3 Semester">3 Semester</option>
                                            <option value="4 Semester">4 Semester</option>
                                            <option value="5 Semester">5 Semester</option>
                                            <option value="6 Semester">6 Semester</option>
                                            <option value="7 Semester">7 Semester</option>
                                            <option value="8 Semester">8 Semester</option>
                                        </select>
                                        @error('duration')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Add Course
                                        </button>
                                    </div>
                                </form>
                                

                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
            
        </table>
        {{ $courses->links()}}
    @endif

</div>
