<div class="mt-4">
    <h2 class="text-lg font-bold mb-2">Registered Users</h2>
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
                <!-- Loop through registered users data -->
                @foreach ($registeredUsers as $index => $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->parent_full_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->parent_email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->parent_mobile }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->student_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->has_laptop ? 'Yes' : 'No' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button> --}}
                            <button wire:click="delete({{ $user->id}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>