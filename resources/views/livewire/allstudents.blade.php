<div>

    <div class="m-15">
        <x-button title="Add Student"
            class="bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none cursor-pointer transition-colors duration-300 ease-in-out"
            href="{{ route('add-student') }}" wire:navigate>
            <i class="fa-solid fa-plus"></i><i class="fa-solid fa-user"></i>
        </x-button>
        <x-button title="Export Student"
            class="bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none cursor-pointer transition-colors duration-300 ease-in-out"
            wire:click='export_data'>
            <i class="fa-solid fa-user"></i><i class="fa-solid fa-right-to-bracket"></i>
        </x-button>
        <x-button title="Import Student"
            class="bg-pink-600 text-white font-bold py-2 px-4 rounded focus:outline-none cursor-pointer transition-colors duration-300 ease-in-out"
            wire:click='import'>
            <i class="fa-solid fa-right-to-bracket"></i><i class="fa-solid fa-user"></i>
        </x-button>
        <x-button title="Download Sample File"
            class="bg-orange-600 text-white font-bold py-2 px-4 rounded focus:outline-none cursor-pointer transition-colors duration-300 ease-in-out"
            wire:click='downloadSample'>
            <i class="fa-solid fa-download"></i>
        </x-button>

        @if (session('success') || session('error'))
            <div class="alert alert-{{ session('success') ? 'success' : 'danger' }}">
                {{ session('success') ? session('success') : session('error') }}
            </div>
        @endif
        @if ($errorMessage)
            <div class="alert alert-danger" role="alert">
                {{ $errorMessage }}
            </div>
        @endif

        @if ($importForm)
            <tr>
                <td colspan="2">
                    <form wire:submit.prevent="importexceldata" class="mb-4">
                        <div class="mb-4">
                            <label for="importData" class="block text-gray-700 text-sm font-bold mb-2">Upload Excel
                                sheet</label>
                            <input type="file" wire:model="importData">
                            @error('importData')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <x-button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">{{ __('Upload') }}</x-button>
                    </form>
                    <x-button wire:click="cancelimportform"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ __('Cancel') }}</x-button>
                </td>
            </tr>
        @endif

    </div>
    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white  relative shadow-md sm:rounded-lg overflow-hidden">
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
                                @foreach ($university as $item)
                                    <option value="{{ $item->id }}"> {{ $item->university_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900">Course:</label>
                            <select wire:model.live.debounce.150ms="c_search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value=""> Select Course </option>
                                @foreach ($course as $item)
                                    <option value="{{ $item->id }}"> {{ $item->course_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- {{$studentDatas}} --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-4 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Sr. No.</th>
                                <th scope="col"
                                    class="px-4 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Name</th>
                                <th scope="col"
                                    class="px-4 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Email Id</th>
                                <th scope="col"
                                    class="px-4 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Father Name</th>
                                <th scope="col"
                                    class="px-4 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    University</th>
                                <th scope="col"
                                    class="px-4 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Course</th>
                                <th scope="col"
                                    class="px-4 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp

                            @forelse ($studentDatas as $studentData)
                                <tr class="border-b dark:border-gray-700">
                                    <td scope="row" class="px-4 py-3 text-gray-900">
                                        {{ $count }}</td>
                                    <td scope="row" class="px-4 py-3 text-gray-900">
                                        {{ $studentData->name }}</td>
                                    <td class="px-4 py-3">{{ $studentData->email_id }}</td>
                                    <td class="px-4 py-3">{{ $studentData->father_name }}</td>
                                    <td class="px-4 py-3">
                                        @if (isset($studentData->university))
                                            {{ $studentData->university->university_name }}
                                        @else
                                            No University Data
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if (isset($studentData->course))
                                            {{ $studentData->course->course_name }}
                                        @else
                                            No Course Data
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 flex items-center space-x-2">
                                        <a href="{{ route('update-student', ['id' => $studentData->id]) }}"
                                            title="Update the student"
                                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600" wire:navigate ><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <x-button wire:click="universitypassword({{ $studentData->id }})"
                                            title="Enter the university details"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"><i
                                                class="fa-solid fa-building-columns"></i></x-button>
                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                            <button
                                                style="background-color: #f50808; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                                wire:click="confirmDelete({{ $studentData->id }})"
                                                wire:loading.attr="disabled" title="Delete the student"
                                                class="text-red-600 hover:text-red-900 ml-2"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        @endif
                                        <button wire:click="usemester({{ $studentData->id }})"
                                            title="Update the semester" type="button"
                                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                        </button>
                                    </td>
                                </tr>
                                @if ($showRegistrationForm && $studentData->id === $c_id)
                                    <tr>
                                        <td colspan="7" class="px-4 py-3">
                                            <form wire:submit.prevent="update" class="mb-4 space-y-4">
                                                <div>
                                                    <label for="university"
                                                        class="block text-gray-700 text-sm font-bold mb-2">University
                                                        Registration Number:</label>
                                                    <input type="text" wire:model="uni_reg_no"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                    @error('uni_reg_no')
                                                        <span class="text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="university"
                                                        class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                                                    <input type="text" wire:model="upassword"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                    @error('upassword')
                                                        <span class="text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="flex space-x-2">
                                                    <x-button type="submit"
                                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">{{ __('Update') }}</x-button>
                                                    <x-button type="button" wire:click="toggleAddForm"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ __('Cancel') }}</x-button>

                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                                @php
                                    $count++;
                                @endphp
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-red-500">No Student found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select wire:model.live="perPage"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{ $studentDatas->links() }}
            </div>
        </div>
    </section>
    @include('livewire.student-modal')
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
