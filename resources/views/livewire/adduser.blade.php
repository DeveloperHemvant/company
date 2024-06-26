<div>
    <div class="pl-4 pt-4">
        <button
        style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
        wire:click="toggleAddForm" class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded mb-4">
        {{ $showAddForm ? 'Cancel' : 'Add User' }}
    </button>
    <x-button title="Export Course Data"
        class="bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none cursor-pointer transition-colors duration-300 ease-in-out hover:bg-green-700"
        wire:click='export'>
        <i class="fa-solid fa-user"></i><i class="fa-solid fa-right-to-bracket"></i>
    </x-button>
    </div>
    
    @if (session()->has('status'))
        <div class="alert {{ session('status') ? 'alert-success' : 'alert-danger' }}">
           <p class="text-green-500 text-sm">{{ session('status') }}</p> {{ session('status') }}
        </div>
    @endif
    <div class="relative">
        @if ($showAddForm)
            <form wire:submit.prevent="save" class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg"
                autocomplete="off">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">User Name<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="name" wire:model="name" autocomplete="off"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter associate name">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="mobile" class="block text-gray-700 font-bold mb-2">User Mobile<span
                            class="text-red-500">*</span></label>
                    <input type="tel" id="mobile" wire:model="mobile" autocomplete="off"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter Mobile Number">
                    @error('mobile')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">User Email<span
                            class="text-red-500">*</span></label>
                    <input type="email" id="email" wire:model="email" autocomplete="off"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter associate email">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">User Password<span
                            class="text-red-500">*</span></label>
                    <input type="password" id="password" wire:model="password" autocomplete="off"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter associate password">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-gray-700 font-bold mb-2">User Address<span
                            class="text-red-500">*</span></label>
                    <textarea wire:model="address"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Address"></textarea>
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="is_admin" class="block text-gray-700 font-bold mb-2">Create as Admin</label>
                    <input type="checkbox" id="is_admin" wire:model="is_admin"
                        class="shadow appearance-none border rounded w-6 h-6 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Save
                    </button>
                </div>
            </form>
            <div wire:loading wire:target="save"
                class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-75">
                <div class="text-lg font-semibold text-gray-700">
                    Please Wait...
                </div>
            </div>
        @endif
    </div>

    <style>
        [wire\:loading] .form-blur {
            filter: blur(4px);
            pointer-events: none;
            user-select: none;
        }
    </style>
    <div class="md:flex items-center justify-between p-4">
        <div class="flex md:w-auto w-full mb-4 md:mb-0">
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                <label class="w-40 text-sm font-medium text-gray-900">Role:</label>
                <select wire:model.live.debounce.150ms="u_search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value=""> Select role </option>

                    <option value="admin"> Admin</option>
                    <option value="user"> User</option>
                    {{-- <option value="Associate"> Associate</option> --}}
                    {{-- <option value="admin"> admin</option> --}}

                </select>
            </div>

        </div>
    </div>
    @if ($data->count())
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                    </th>

                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($data as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->role }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="edit({{ $user->id }})"
                                class="text-indigo-600 hover:text-indigo-900"
                                style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;">Edit</button>
                            <button
                                style="background-color: #f50808; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                wire:click="confirmDelete('{{ $user->id }}')"
                                class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        </td>
                    </tr>
                    @if ($showEditForm && $id === $user->id)
                        <tr>

                            <td colspan="2">
                                <!-- Edit Associate Form -->
                                <form wire:submit.prevent="update"
                                    class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg"
                                    autocomplete="off">
                                    <div class="mb-4">
                                        <label for="name" class="block text-gray-700 font-bold mb-2">User
                                            Name<span class="text-red-500">*</span></label>
                                        <input type="text" id="name" wire:model="name" autocomplete="off"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            placeholder="Enter associate name">
                                        @error('name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mobile" class="block text-gray-700 font-bold mb-2">Associate
                                            Mobile</label>
                                        <input type="tel" id="name" wire:model="mobile" autocomplete="off"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            placeholder="Enter Mobile Number">
                                        @error('mobile')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="email" class="block text-gray-700 font-bold mb-2">User
                                            Email<span class="text-red-500">*</span></label>
                                        <input type="email" id="email" wire:model="email" autocomplete="off"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            placeholder="Enter associate email">
                                        @error('email')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="address" class="block text-gray-700 font-bold mb-2">User
                                            Address<span class="text-red-500">*</span></label>
                                        <textarea wire:model="address"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            placeholder="Address"></textarea>
                                        @error('address')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  
                                    <div class="mb-4">
                                        <label for="is_admin" class="block text-gray-700 font-bold mb-2">Create as Admin</label>
                                        <input type="checkbox" id="is_admin" wire:model="s_is_admin"
                                            class="shadow appearance-none border rounded w-6 h-6 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            @if ($s_is_admin === 'admin') checked @endif>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Update
                                        </button>
                                    </div>
                                </form>

                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    @else
        <p>No Staff User found.</p>
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
    });
</script>
