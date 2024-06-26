<div>
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
    <div class="pl-4 pt-4">
        <button wire:click="toggleAddForm"
        style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;">
        {{ $showAddForm ? 'Cancel' : 'Add Session' }}
    </button>
    
    
    @endif
    <x-button title="Export Session Data"
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
        @error('name')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
        @if(session()->has('error'))
    <div class="alert alert-danger">
        <p class="text-red-500 text-xs italic"> {{ session('error') }}</p>
    </div>
@endif

        <form wire:submit.prevent="save" class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="course">
                    University<span class="text-red-500">*</span>
                </label>
                <select wire:model="university_id" id="university"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select University</option>
                    @foreach ($universities as $item)
                        <option value="{{ $item->id }}">{{ $item->university_name }}</option>
                    @endforeach>

                </select>
                @error('university_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="sessions" class="block text-gray-700 font-bold mb-2">Starting Month:<span
                        class="text-red-500">*</span></label>
                <input type="month"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="startmonth" wire:model.live="startmonth" id="startmonth">
                @error('startmonth')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="university" class="block text-gray-700 font-bold mb-2">Ending Month:<span
                        class="text-red-500">*</span></label>
                <input type="month"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="endmonth" wire:model="endmonth" id="endmonth" min="{{ $startmonth }}">

                @error('endmonth')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Add Session</button>
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

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SR No.</th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">University
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>

                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            {{-- {{$sessiondata}} --}}
            @foreach ($sessionData as $sessions)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }} </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sessions->university->university_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sessions->name }}</td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <button
                            style="background-color: rgb(26, 149, 219); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                            wire:click="edit({{ $sessions->id }})"
                            class="text-indigo-600 hover:text-indigo-900"><i
                            class="fa-solid fa-pen-to-square"></i></button>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                        <button
                            style="background-color: rgb(250, 5, 5); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                            wire:click="confirmDelete({{ $sessions->id }})" wire:loading.attr="disabled"
                            class="text-red-600 hover:text-red-900 ml-2"><i
                            class="fa-solid fa-trash"></i></button>
                            @endif
                    </td>
                </tr>

                @if ($showEditForm && $sessions->id === $session_id)
                    <tr>
                        {{-- {{$u_session}} --}}
                        <td colspan="2">
                            <!-- Edit sessions Form -->
                            <form wire:submit.prevent="update"
                                class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg">
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-bold mb-2" for="course">
                                        University<span class="text-red-500">*</span>
                                    </label>
                                    <select wire:model="university_id" id="university"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Select University</option>
                                        @foreach ($universities as $item)
                                            <option value="{{ $item->id }}">{{ $item->university_name }}</option>
                                        @endforeach>

                                    </select>
                                    @error('university_id')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="sessions" class="block text-gray-700 font-bold mb-2">Starting
                                        Month:<span class="text-red-500">*</span></label>
                                    <input type="month"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        name="startmonth" wire:model.live="startmonth" id="startmonth">
                                    @error('sessions_id')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="university" class="block text-gray-700 font-bold mb-2">Ending
                                        Month:<span class="text-red-500">*</span></label>
                                    <input type="month"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        name="endmonth" wire:model="endmonth" id="endmonth" min="{{ $startmonth }}">
                                    @error('sessions_id')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                    @error('endmonth')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit"
                                    style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                    class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Update
                                    Session</button>
                            </form>

                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    {{ $sessionData->links() }}


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
