<div>
    <div class="m-15">
        <button class="m-5"
            style="background-color: rgb(28, 146, 4); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"><a
                href="{{ route('add-student') }}">Add Student</a></button>

        <button class="m-5" wire:click='export_data'
            style="background-color: rgb(4, 105, 236); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;">Export
            Students</button>
        <button wire:click='import'
            style="background-color: rgb(228, 14, 181); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;">Import
            Students</button>
        @if ($importForm)
            <tr>
                <td colspan="2">
                    <form wire:submit.prevent="importexceldata" class="mb-4">
                        <div class="mb-4">
                            <label for="importData" class="block text-gray-700 text-sm font-bold mb-2">Upload Excel sheet</label>
                            <input type="file" wire:model="importData">
                            @error('importData')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Upload</button>
                    </form>                    
                    <button wire:click="cancelimportform"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                </td>
            </tr>
        @endif

    </div>
    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white  relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" wire:model.live.debounce.250ms="search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search">
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900">University:</label>
                            <select wire:model.live.debounce.150ms="u_search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value=""> Select University </option>
                                @foreach ($university as $item)
                                    <option value="{{ $item->id }}"> {{ $item->university_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900">Course:</label>
                            <select wire:model.live.debounce.150ms="c_search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value=""> Select Course </option>
                                @foreach ($course as $item)
                                    <option value="{{ $item->id }}"> {{ $item->course_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">Sr. No.</th>
                                <th scope="col" class="px-4 py-3">Name</th>
                                <th scope="col" class="px-4 py-3">Email Id</th>
                                <th scope="col" class="px-4 py-3">Father Name</th>
                                <th scope="col" class="px-4 py-3">University</th>
                                <th scope="col" class="px-4 py-3">Course</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @forelse ($studentdata as $student)
                                <tr class="border-b dark:border-gray-700">
                                    <td scope="row" class="px-4 py-3 font-medium text-black-900">
                                        {{ $count }}</td>
                                    <td scope="row" class="px-4 py-3 font-medium text-black-900">
                                        {{ $student['name'] }}</td>
                                    <td class="px-4 py-3">{{ $student['email_id'] }}</td>
                                    <td class="px-4 py-3">
                                        {{ $student['father_name'] }}</td>
                                    <td class="px-4 py-3">
                                        @if (isset($student['university']))
                                            {{ $student['university']['university_name'] }}
                                        @else
                                            No University Data
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if (isset($student['course']))
                                            {{ $student['course']['course_name'] }}
                                        @else
                                            No Course Data
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 flex items-center">
                                        <a href="{{ route('update-student', ['id' => $student['id']]) }}"><button
                                                class="px-3 py-1 m-1 bg-green-500 text-white rounded">Update</button></a>
                                        <button wire:click="universitypassword({{ $student['id'] }})"
                                            class="px-3 py-1 m-1 bg-green-500 text-white rounded">Enter University
                                            Details</button>
                                        <button wire:click="delete({{ $student['id'] }})"
                                            class="px-3 py-1 m-1 bg-red-500 text-white rounded">Delete</button>
                                    </td>
                                </tr>
                                @if ($showRegistrationForm && $student['id'] === $c_id)
                                    <tr>
                                        <td colspan="2">
                                            <form wire:submit.prevent="update" class="mb-4">
                                                <div class="mb-4">
                                                    <label for="university"
                                                        class="block text-gray-700 text-sm font-bold mb-2">University
                                                        Registration Number
                                                        :</label>
                                                    <input type="text" wire:model="uni_reg_no">
                                                    <div>
                                                        @error('uni_reg_no')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="university"
                                                        class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                                                    <input type="text" wire:model="upassword">
                                                    <div>
                                                        @error('upassword')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button
                                                    style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                                    type="submit"
                                                    class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Update</button>
                                            </form>
                                            <button wire:click="toggleAddForm"
                                                style="background-color: #e72727; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                                class="bg-green-500 hover:bg-green-700  font-bold py-2 px-4 rounded ml-2">Cancel</button>
                                        </td>
                                    </tr>
                                @endif
                                @php
                                    $count++;
                                @endphp

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-red-500">No Student found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select wire:model.live=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
</div>
