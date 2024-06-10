<div>
    <div>
        <button wire:click="toggleAddForm"
            style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
            class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded mb-4">
            {{ $showAddForm ? 'Cancel' : 'Add Specialization' }}
        </button>
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
            <form wire:submit.prevent="save" class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg">
                <div class="mb-4">
                    <label for="cousre_id" class="block text-gray-700 text-sm font-bold mb-2">University:<span
                            class="text-red-500">*</span></label>
                    <select wire:model.live="selecteduniversity" id="university_name"
                        class="shadow appearance-none border rounded py-2 px-8 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select University</option>
                        @foreach ($university as $programme)
                            <option value="{{ $programme->id }}">{{ $programme->university_name }}</option>
                        @endforeach
                    </select>
                    @error('selecteduniversity')
                        <p class="text-red-500 text-xs italic">University is required</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="cousre_id" class="block text-gray-700 text-sm font-bold mb-2">Courses:<span
                            class="text-red-500">*</span></label>
                    <select wire:model="course_id" id="university_name"
                        class="shadow appearance-none border rounded py-2 px-8 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select Course</option>
                        @if ($selecteduniversity != null)
                            @foreach ($cousre as $data)
                                <option value="{{ $data->id }}">{{ $data->course_name }}</option>
                            @endforeach
                        @endif

                    </select>
                    @error('course_id')
                        <p class="text-red-500 text-xs italic">Course is required</p>
                    @enderror

                </div>
                <div class="mb-4">
                    <label for="sessions" class="block text-gray-700 text-sm font-bold mb-2">Specialization:<span
                            class="text-red-500">*</span></label>
                    <x-input name="specialization_name" type="text" id="specialization_name" class="custom-class"
                        wire:model="specialization_name" required />
                    @error('specialization_name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror

                </div>

                <button type="submit"
                    style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                    class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Add
                    Specialization</button>
            </form>

        @endif

        @if (empty($special_data))
            <p>No Specialization found.</p>
        @else
            {{-- {{$special_data}} --}}
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SR No.</th>
                    <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">University Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Course Name</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialization Name
                        </th>
                        
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($special_data as $proggramme)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }} </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $proggramme->university->university_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $proggramme->cousre->course_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $proggramme->specialization_name }}</td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="edit({{ $proggramme->id }})"
                                    style="background-color: #0fe419; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                    class="text-indigo-600 hover:text-indigo-900"><i
                                    class="fa-solid fa-pen-to-square"></i></button>
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                <button
                                    style="background-color: #ff0000; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                    wire:click="confirmDelete('{{ $proggramme->id }}')" wire:loading.attr="disabled"
                                    class="text-red-600 hover:text-red-900 ml-2"><i
                                    class="fa-solid fa-trash"></i></button>
                                    @endif
                            </td>
                        </tr>
                        @if ($showEditForm && $proggramme->id === $s_id)
                            <tr>
                                <td colspan="2">
                                    <p>Edit Specialization Details</p>
                                    <form wire:submit.prevent="update" class="mb-4">
                                        <div class="mb-4">
                                            <label for="cousre_id"
                                                class="block text-gray-700 text-sm font-bold mb-2">University:<span
                                                    class="text-red-500">*</span></label>
                                            <select wire:model.live="selectedUniversity" id="university_name"
                                                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                <option value="">Select Course</option>
                                                @foreach ($university as $programme)
                                                    <option value="{{ $programme->id }}">
                                                        {{ $programme->university_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('university_id')
                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror

                                        </div>
                                        <div class="mb-4">
                                            <label for="cousre_id"
                                                class="block text-gray-700 text-sm font-bold mb-2">Courses:<span
                                                    class="text-red-500">*</span></label>
                                            <select wire:model="course_id" id="university_name"
                                                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                <option value="">Select Course</option>
                                                {{-- @if ($selectedUniversity != null) --}}
                                                @foreach ($cousre as $data)
                                                    <option value="{{ $data->id }}">{{ $data->course_name }}
                                                    </option>
                                                @endforeach
                                                {{-- @endif --}}

                                            </select>
                                            @error('course_id')
                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror

                                        </div>
                                        <div class="mb-4">
                                            <label for="sessions"
                                                class="block text-gray-700 text-sm font-bold mb-2">Specialization:<span
                                                    class="text-red-500">*</span></label>
                                            <x-input name="specialization_name" type="text" id="specialization_name"
                                                class="custom-class" wire:model="specialization_name" required />
                                            @error('specialization_name')
                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror

                                        </div>
                                        <button type="submit"
                                            style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;">Update
                                            Specialize</button>
                                    </form>

                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            {{-- {{$special_data->links()}} --}}
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
