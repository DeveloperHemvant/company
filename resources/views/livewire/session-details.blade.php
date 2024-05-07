<div>
    <button wire:click="toggleAddForm"
        style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;">
        {{ $showAddForm ? 'Cancel' : 'Add Session' }}
    </button>

    @if ($showAddForm)
        @if (session()->has('status'))
            <div class="alert {{ session('status') ? 'alert-success' : 'alert-danger' }}">
                {{ session('status') }}
            </div>
        @endif
        <form wire:submit.prevent="save" class="mb-4">
            <div class="mb-4">
                <label for="sessions" class="block text-gray-700 text-sm font-bold mb-2">Month:</label>
                <select wire:model="selectedMonth" id="months"
                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Month</option>
                    @foreach ($months as $key => $month)
                        <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
                </select>
                @error('sessions_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="university" class="block text-gray-700 text-sm font-bold mb-2">University Name:</label>
                <select wire:model="university" id="university"
                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select University</option>
                    @foreach ($universities as $university)
                        <option value="{{ $university->id }}">{{ $university->university_name }}</option>
                    @endforeach
                </select>
                @error('university_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- <div class="mb-4">
                <label for="sessions" class="block text-gray-700 text-sm font-bold mb-2">sessions Name:</label>
                <select wire:model="sessions_id" id="sessions" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select sessions</option>
                    @foreach ($sessionss as $sessions)
                        <option value="{{ $sessions->id }}">{{ $sessions->sessions_name }}</option>
                    @endforeach
                </select>
                @error('sessions_id') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </div> --}}


            <button type="submit"
                style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Add Session</button>
        </form>

    @endif

    @if (empty($session))
        <p>No Session found.</p>
    @else
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($session as $sessions)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $sessions->session_name }}</td>
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
                                        <label for="selectedMonth"
                                            class="block text-gray-700 text-sm font-bold mb-2">Month:</label>
                                        <select wire:model="u_month" id="selectedMonth"
                                            class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <option value="">Select Month</option>
                                            @foreach ($months as $key => $month)
                                                @selected($month === $u_session->month ? 'disabled' : '')
                                                <option value="{{ $month }}"
                                                    {{ $month === $u_session->month ? 'disabled' : '' }}>
                                                    {{ $month }}</option>
                                            @endforeach
                                        </select>
                                        @error('selectedMonth')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="university"
                                            class="block text-gray-700 text-sm font-bold mb-2">University Name:</label>
                                        <select wire:model="u_university" id="university"
                                            class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <option value="">Select University </option>
                                            @foreach ($universities as $uni)
                                                <option value="{{ $uni->id }}"
                                                    {{ $uni->id === $u_session->u_id ? 'disabled' : '' }}>
                                                    {{ $uni->university_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('university')
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
    @endif

</div>
