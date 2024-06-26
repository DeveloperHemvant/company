<div>
    <div class="pl-4 pt-4">

    
    <button wire:click="toggleAddForm"
        style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
        class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded mb-4">
        {{ $showAddForm ? 'Cancel' : 'Add Course' }}
    </button>
    <x-button title="Export Course Data"
    class="bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none cursor-pointer transition-colors duration-300 ease-in-out hover:bg-green-700"
    wire:click='export'>
    <i class="fa-solid fa-user"></i><i class="fa-solid fa-right-to-bracket"></i>
</x-button>
</div>
    @if (session()->has('status'))
        <div class="alert {{ session('status') ? 'text-green-500' : 'text-red-500' }}">
            {{ session('status') }}
        </div>
    @endif
    @if ($showAddForm)
        @if (session()->has('status'))
            <div class="alert {{ session('status') ? 'alert-success' : 'alert-danger' }}">
                {{ session('status') }}
            </div>
        @endif
        <form wire:submit.prevent="save" class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg"
            autocomplete="off">
            <div class="mb-4">
                <label for="course" class="block text-gray-700 font-bold mb-2">University:<span
                        class="text-red-500">*</span></label>
                <select wire:model="university_id" id="university"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select University</option>
                    @foreach ($universities as $item)
                        <option value="{{ $item->id }}">{{ $item->university_name }}</option>
                    @endforeach
                </select>
                @error('university_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="course_type" class="block text-gray-700 font-bold mb-2">Course Type:<span
                        class="text-red-500">*</span></label>
                <select wire:model="course_type" id="course_type"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                <label for="course_name" class="block text-gray-700 font-bold mb-2">Course Name:<span
                        class="text-red-500">*</span></label>
                <input type="text" id="course_name" wire:model="course_name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('course_name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="duration" class="block text-gray-700 font-bold mb-2">Duration:<span
                        class="text-red-500">*</span></label>
                <select wire:model="duration" id="duration"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add Course
                </button>
            </div>
        </form>


    @endif
    <div class="md:flex items-center justify-between p-4">
        <div class="flex md:w-auto w-full mb-4 md:mb-0">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" wire:model.live.debounce.250ms="search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                    placeholder="Search">
            </div>
        </div>
        <div class="flex flex-col md:flex-row md:space-x-3">
            <div class="flex space-x-3 items-center mb-4 md:mb-0">
                <label class="w-40 text-sm font-medium text-gray-900">University:</label>
                <select wire:model.live.debounce.150ms="u_search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value=""> Select University </option>
                    @foreach ($universities as $item)
                        <option value="{{ $item->id }}"> {{ $item->university_name }} </option>
                    @endforeach
                </select>
            </div>
            
        </div>
    </div>
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
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        University
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
                        <td class="px-6 py-4 whitespace-nowrap">{{ $data->university->university_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $data->course_type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button
                                style="background-color: rgb(26, 149, 219); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                wire:click="edit({{ $data->id }})"
                                style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                class="text-indigo-600 hover:text-indigo-900"><i
                                class="fa-solid fa-pen-to-square"></i></button>
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                            <button
                                style="background-color: rgb(255, 9, 9); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                wire:click="confirmDelete({{ $data->id }})" wire:loading.attr="disabled"
                                style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"><i
                                class="fa-solid fa-trash"></i></button>
                                @endif
                            </td>
                    </tr>

                    @if ($showEditForm && $data->id === $c_id)
                        <tr>
                            <td colspan="2">
                                <form wire:submit.prevent="update"
                                    class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg" autocomplete="off">
                                    <div class="mb-4">
                                        <label for="course"
                                            class="block text-gray-700 font-bold mb-2">University:<span
                                                class="text-red-500">*</span></label>
                                        <select wire:model="university_id" id="university"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <option value="">Select University</option>
                                            @foreach ($universities as $item)
                                                <option value="{{ $item->id }}">{{ $item->university_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('university_id')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="course_type" class="block text-gray-700 font-bold mb-2">Course
                                            Type:<span class="text-red-500">*</span></label>
                                        <select wire:model="course_type" id="course_type"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                                        <label for="course_name" class="block text-gray-700 font-bold mb-2">Course
                                            Name:<span class="text-red-500">*</span></label>
                                        <input type="text" id="course_name" wire:model="course_name"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('course_name')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="duration"
                                            class="block text-gray-700 font-bold mb-2">Duration:<span
                                                class="text-red-500">*</span></label>
                                        <select wire:model="duration" id="duration"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Update Course
                                        </button>
                                    </div>
                                </form>


                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>

        </table>
        {{ $courses->links() }}
    @endif

</div>
<script>
    window.addEventListener('delete', function() {

        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('goOn-Delete')
            }
        });


        //   Livewire.on('postDeleted', function (data) {
        //       Swal.fire({
        //           title: 'Success!',
        //           text: data.message,
        //           icon: 'success'
        //       });
        //   });
    });
</script>
