<div>
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
    <button
    style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
    wire:click="toggleAddForm" class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded mb-4">
    {{ $showAddForm ? 'Cancel' : 'Add University' }}
</button>
    @endif
    
    @if (session()->has('status'))
        <div class="alert {{ session('status') ? 'text-green-500' : 'text-red-500' }}">
            {{ session('status') }}
        </div>
    @endif
    @if ($showAddForm)
        <form wire:submit.prevent="save" class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg"
            autocomplete="off">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">University Name:<span
                    class="text-red-500">*</span></label>
                <input type="text" id="university_name" wire:model="university_name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('university_name')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">University Code:<span
                    class="text-red-500">*</span></label>
                <input type="text"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="university_code" wire:model="university_code">

                @error('university_code')
                <div class="text-red-500">{{ $message }}</div>
                @enderror

            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Save
                </button>
            </div>
        </form>
    @endif
    <div class="flex flex-col md:flex-row md:w-auto w-full mb-4 md:mb-0 items-center">
        <div class="relative w-full md:w-auto mb-4 md:mb-0 md:mr-4">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" wire:model.live.debounce.250ms="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full md:w-80 pl-10 p-2"
                placeholder="Search">
        </div>
        {{-- <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline mx-2	">
           Search
        </button> --}}
        <button title="Export the University Data" wire:click="export"
            class="bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none cursor-pointer transition-colors duration-300 ease-in-out mx-5">
            <i class="fa-solid fa-user"></i><i class="fa-solid fa-right-to-bracket"></i>
        </button>
    </div>
    
    @if ($data->count())
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sr.
                        No.</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        University Name</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        University Code</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php
                    $count = 1;
                @endphp
                @foreach ($data as $university)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $count }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $university->university_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $university->university_code }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="edit({{ $university->id }})"
                                style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                class="text-indigo-600 hover:text-indigo-900">
                                <i
                                class="fa-solid fa-pen-to-square"></i>
                            </button>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                            <button
                                style="background-color: #ee0202; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                wire:click="confirmDelete({{ $university->id }})"  wire:loading.attr="disabled"
                                class="text-red-600 hover:text-red-900 ml-2"><i
                                class="fa-solid fa-trash"></i></button>
                                @endif
                        </td>
                    </tr>
                    @if ($showEditForm && $id === $university->id)
                        <tr>

                            <td colspan="2">
                                <!-- Edit University Form -->
                                <form wire:submit.prevent="update"
                                    class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg" autocomplete="off">
                                    <div class="mb-4">
                                        <label for="name" class="block text-gray-700 font-bold mb-2">University
                                            Name:</label>
                                        <input type="text" id="university_name" wire:model="university_name"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        @error('university_name')
                                        <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="description" class="block text-gray-700 font-bold mb-2">University
                                            Code:</label>
                                        <input type="text"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="university_code" wire:model="university_code">

                                        @error('university_code')
                                        <div class="text-red-500">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="flex items-center justify-between">
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Save
                                        </button>
                                    </div>
                                </form>

                            </td>
                        </tr>
                    @endif
                    @php
                        $count++;
                    @endphp
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    @else
        <p>No University found.</p>
    @endif
</div>
<script>
    window.addEventListener('delete', function () {

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