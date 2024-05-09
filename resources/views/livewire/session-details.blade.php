<div>
    <button wire:click="toggleAddForm"
        style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;">
        {{ $showAddForm ? 'Cancel' : 'Add Session' }}
    </button>

    @if ($showAddForm)
                @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        <form wire:submit.prevent="save" class="mb-4">
            <div class="mb-4">
                <label for="sessions" class="block text-gray-700 text-sm font-bold mb-2">Starting Month:</label>
                <input type="month" name="startmonth" wire:model.live="startmonth" id="startmonth">
                @error('sessions_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="university" class="block text-gray-700 text-sm font-bold mb-2">Ending Month:</label>
                <input type="month" name="endmonth" wire:model="endmonth" id="endmonth" min="{{$startmonth}}">
                @error('sessions_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
                @error('endmonth')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Add Session</button>
        </form>

    @endif

    @if (empty($sessiondata))
        <p>No Session found.</p>
    @else
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SR No.</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                {{-- {{$rotationCount = 1}} --}}
                @foreach ($sessiondata as $sessions)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }} </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $sessions->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button
                                style="background-color: rgb(26, 149, 219); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                wire:click="edit({{ $sessions->id }})"
                                class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button
                                style="background-color: rgb(250, 5, 5); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                wire:click="delete({{ $sessions->id }})"
                                class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        </td>
                    </tr>

                    @if ($showEditForm && $sessions->id === $session_id)
                        <tr>
                            {{-- {{$u_session}} --}}
                            <td colspan="2">
                                <!-- Edit sessions Form -->
                                <form wire:submit.prevent="update" class="mb-4">
                                    <div class="mb-4">
                                        <label for="sessions" class="block text-gray-700 text-sm font-bold mb-2">Starting Month:</label>
                                        <input type="month" name="startmonth" wire:model.live="startmonth" id="startmonth">
                                        @error('sessions_id')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="university" class="block text-gray-700 text-sm font-bold mb-2">Ending Month:</label>
                                        <input type="month" name="endmonth" wire:model="endmonth" id="endmonth" min="{{$startmonth}}">
                                        @error('sessions_id')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                        @error('endmonth')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit"
                                        style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                        class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Update Session</button>
                                </form>

                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

</div>
