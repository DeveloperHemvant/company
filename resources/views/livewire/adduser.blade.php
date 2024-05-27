<div>
    <button
        style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
        wire:click="toggleAddForm" class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded mb-4">
        {{ $showAddForm ? 'Cancel' : 'Add User' }}
    </button>
    @if (session()->has('status'))
        <div class="alert {{ session('status') ? 'alert-success' : 'alert-danger' }}">
            {{ session('status') }}
        </div>
    @endif
    <div class="relative">
        @if ($showAddForm)
            <form wire:submit.prevent="save" class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg"
                autocomplete="off">
                
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">User Name</label>
                    <input type="text" id="name" wire:model="name" autocomplete="off"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter associate name">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="mobile" class="block text-gray-700 font-bold mb-2">User Mobile</label>
                    <input type="tel" id="mobile" wire:model="mobile" autocomplete="off"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter Mobile Number">
                    @error('mobile')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">User Email</label>
                    <input type="email" id="email" wire:model="email" autocomplete="off"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter associate email">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">User Password</label>
                    <input type="password" id="password" wire:model="password" autocomplete="off"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter associate password">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 font-bold mb-2">User Address</label>
                    <textarea wire:model="address"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Address"></textarea>
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
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


    @if ($data->count())
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
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
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="edit({{ $user->id }})"
                                class="text-indigo-600 hover:text-indigo-900"
                                style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;">Edit</button>
                            <button
                                style="background-color: #f50808; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                wire:click="delete({{ $user->id }})" wire:confirm="Are you sure you want to delete this User?"
                                class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        </td>
                    </tr>
                    @if ($showEditForm && $id === $user->id)
                        <tr>

                            <td colspan="2">
                                <!-- Edit Associate Form -->
                                <form wire:submit.prevent="update"
                                    class="mb-4 max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg" autocomplete="off">
                                    <div class="mb-4">
                                        <label for="name" class="block text-gray-700 font-bold mb-2">Associate
                                            Name</label>
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
                                        <label for="email" class="block text-gray-700 font-bold mb-2">Associate
                                            Email</label>
                                        <input type="email" id="email" wire:model="email" autocomplete="off"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            placeholder="Enter associate email">
                                        @error('email')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="address" class="block text-gray-700 font-bold mb-2">Associate
                                            Address</label>
                                        <textarea wire:model="address"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            placeholder="Address"></textarea>
                                        @error('address')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
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
        <p>No Staff User  found.</p>
    @endif
</div>