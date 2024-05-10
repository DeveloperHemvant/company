<div>
    <div class="m-15">
        <button
            style="background-color: rgb(28, 146, 4); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"><a
                href="{{ route('add-student') }}">Add Student</a></button>
    </div>
    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
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
                            <input type="text" wire:model.live.debounce.150ms="search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search" >
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900">University:</label>
                            <select wire:model.live="u_search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value=""> Select University </option>
                                @foreach ($university as $item)
                                    <option value="{{ $item->id }}"> {{ $item->university_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900">Course:</label>
                            <select wire:model.live="c_search"
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
                                <th scope="col" class="px-4 py-3">name</th>
                                <th scope="col" class="px-4 py-3">email</th>
                                <th scope="col" class="px-4 py-3">Father Name</th>
                                <th scope="col" class="px-4 py-3">University</th>
                                <th scope="col" class="px-4 py-3">Course</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($studentdata as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td scope="row" class="px-4 py-3 font-medium text-black-900">
                                        {{ $item->NAME }}</td>
                                    <td class="px-4 py-3">{{ $item->EMAIL_ID }}</td>
                                    <td class="px-4 py-3 ">
                                        {{ $item->FATHER_NAME }}</td>
                                    <td class="px-4 py-3">{{ $item->university->university_name }}</td>
                                    <td class="px-4 py-3">{{ $item->course->course_name }}</td>
                                    <td class="px-4 py-3 flex items-center  ">
                                        <button class="px-3 py-1 bg-green-500 text-white rounded" >Update</button>
                                        @livewire('confirm-alert', ['contactId' => $item->id])
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="py-4 px-3">
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
                    {{-- {{$studentdata->links()}} --}}
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            @this.on('triggerDelete', contactId => {
                Swal.fire({
                    title: 'Are You Sure?',
                    text: 'Contact record will be deleted!',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Delete!'
                }).then((result) => {
                    // If user clicks on delete
                    if (result.value) {
                        // Calling destroy method to delete
                        @this.call('destroy', contactId)
                            .then(() => {
                                // Success response
                                Swal.fire({
                                    title: 'Contact deleted successfully!',
                                    icon: 'success'
                                });
                            })
                            .catch(error => {
                                // Handle any errors
                                console.error(error);
                            });
                    } else {
                        Swal.fire({
                            title: 'Operation Cancelled!',
                            icon: 'success'
                        });
                    }
                });
            });
        })
    </script>
@endpush