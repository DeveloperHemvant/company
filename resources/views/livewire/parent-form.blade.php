<div class="mt-4">
    <h2 class="text-lg font-bold mb-2 pl-4">Registered Users</h2>
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
        <x-button title="Export Associate Data"
            class="bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none cursor-pointer transition-colors duration-300 ease-in-out hover:bg-green-700 ml-4"
            wire:click='export'>
            <i class="fa-solid fa-user"></i><i class="fa-solid fa-right-to-bracket"></i>
        </x-button>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent's Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent's Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent's Mobile</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Has Laptop/Desktop</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($registeredUsers as $index => $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->parent_full_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->parent_email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->parent_mobile }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->student_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->has_laptop ? 'Yes' : 'No' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="delete({{ $user->id }})"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
