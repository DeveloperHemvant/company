<div>
    <div class="pl-4 pt-4">
        <button
            style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
            wire:click="toggleAddForm" class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded mb-4">
            {{ $showAddForm ? 'Cancel' : 'Add Courier Details' }}
        </button>


        <x-button title="Export Fee Details"
            class="bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none cursor-pointer transition-colors duration-300 ease-in-out hover:bg-green-700"
            wire:click='export'>
            <i class="fa-solid fa-user"></i><i class="fa-solid fa-right-to-bracket"></i>
        </x-button>
    </div>
    @if (session()->has('status'))
        <div class="alert {{ session('status') ? 'text-green-500' : 'text-red-500' }}">
            {{ session('status') }}
        </div>
    @endif
    <div class="relative">
        @if ($showAddForm)
            <form wire:submit="save" class="mx-auto p-4 bg-white shadow-md rounded-lg" autocomplete="off">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="mb-4">
                        <label for="type" class="block text-gray-700 font-bold mb-2">INWARD/OUTWARD<span
                                class="text-red-500">*</span></label>
                        <select id="type" wire:model="type"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select</option>
                            <option value="inward">Inward</option>
                            <option value="outward">Outward</option>
                        </select>
                        @error('type')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">ASSOCIATE/UNIVERSITY/DIRECT<span
                                class="text-red-500">*</span></label><br>
                        <select id="formType" wire:model='formType'
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select</option>
                            <option value="associate">Associate</option>
                            <option value="university">University</option>
                            <option value="direct">Direct</option>
                        </select>
                        <span id="formTypeError" class="text-red-500 text-sm"></span>
                    </div>






                    <div class="mb-4 col-span-1 md:col-span-2 lg:col-span-3">
                        <label for="particular_details" class="block text-gray-700 font-bold mb-2">PARTICULAR
                            DETAILS<span class="text-red-500">*</span></label>
                        <textarea id="particular_details" wire:model="particular_details"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter particular details"></textarea>
                        @error('particular_details')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="courier_type" class="block text-gray-700 font-bold mb-2">COURIER TYPE<span
                                class="text-red-500">*</span></label>
                        <select wire:model="courier_type"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select</option>
                            <option value="courier">Courier</option>
                            <option value="speed">Speed Post</option>
                            <option value="byhand">By Hand</option>
                        </select>
                        @error('courier_type')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tracking_no" class="block text-gray-700 font-bold mb-2">TRACKING NO.<span
                                class="text-red-500">*</span></label>
                        <input type="text" id="tracking_no" wire:model="tracking_no"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter tracking number">
                        @error('tracking_no')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="delivery_status"
                            class="block text-gray-700 font-bold mb-2">DELIVERED/UNDELIVERED<span
                                class="text-red-500">*</span></label>
                        <select id="delivery_status" wire:model="delivery_status"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select status</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Undelivered">Undelivered</option>
                        </select>
                        @error('delivery_status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4 col-span-1 md:col-span-2 lg:col-span-3">
                        <label for="remarks" class="block text-gray-700 font-bold mb-2">REMARKS<span
                                class="text-red-500">*</span></label>
                        <textarea id="remarks" wire:model="remarks"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter remarks"></textarea>
                        @error('remarks')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end col-span-1 md:col-span-2 lg:col-span-3">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>
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
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 pr-2 py-2"
                    placeholder="Search by Received From">
            </div>
        </div>
        <div class="mb-4 md:ml-4">
            <label for="formType" class="block text-gray-700 font-bold mb-2">Type<span class="text-red-500">*</span></label>
            <select id="formType" wire:model.live='s_formType'
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select</option>
                <option value="associate">Associate</option>
                <option value="university">University</option>
                <option value="direct">Direct</option>
            </select>
        </div>
        <div class="mb-4 md:ml-4">
            <label for="delivery_status" class="block text-gray-700 font-bold mb-2">Delivery Status<span class="text-red-500">*</span></label>
            <select id="delivery_status" wire:model.live='s_delivery'
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select status</option>
                <option value="Delivered">Delivered</option>
                <option value="Undelivered">Undelivered</option>
            </select>
        </div>
        <div class="mb-4 md:ml-4">
            <label for="s_tracking_no" class="block text-gray-700 font-bold mb-2">Tracking No.<span class="text-red-500">*</span></label>
            <input type="text" id="s_tracking_no" wire:model.live="s_tracking_no"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Enter tracking number">
        </div>
    </div>
    

    {{-- @if ($data->count()) --}}
    <div>
        <div>


            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100">Type</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100">Particular Details</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100">Courier Type</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100">Tracking No.</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100">Delivery Status</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100">Remarks</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100">Form Type</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($records as $record)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $record->type }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $record->particular_details }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $record->courier_type }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $record->tracking_no }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $record->delivery_status }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $record->remarks }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $record->form_type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button wire:click="edit({{ $record->id }})"
                                        style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                        class="text-blue-500 hover:text-blue-700">Edit</button>

                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                        <button wire:click="deleteconfirmation({{ $record->id }})"
                                            style="background-color: #e20808; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                            class="text-red-500 hover:text-red-700 ml-2"> <i
                                                class="fa-solid fa-trash"></i>

                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @if ($showEditForm && $recordId === $record->id)
                                <tr>
                                    <td colspan="7">
                                        <!-- Edit Fee Detail Form -->
                                        <form wire:submit="update" class="mx-auto p-4 bg-white shadow-md rounded-lg"
                                            autocomplete="off">
                                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                                <div class="mb-4">
                                                    <label for="type"
                                                        class="block text-gray-700 font-bold mb-2">INWARD/OUTWARD<span
                                                            class="text-red-500">*</span></label>
                                                    <select id="type" wire:model="type"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                        <option value="">Select</option>
                                                        <option value="inward">Inward</option>
                                                        <option value="outward">Outward</option>
                                                    </select>
                                                    @error('type')
                                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label
                                                        class="block text-gray-700 font-bold mb-2">ASSOCIATE/UNIVERSITY/DIRECT<span
                                                            class="text-red-500">*</span></label><br>
                                                    <select id="formType" wire:model='formType'
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                        <option value="">Select</option>
                                                        <option value="associate">Associate</option>
                                                        <option value="university">University</option>
                                                        <option value="direct">Direct</option>
                                                    </select>
                                                    <span id="formTypeError" class="text-red-500 text-sm"></span>
                                                </div>






                                                <div class="mb-4 col-span-1 md:col-span-2 lg:col-span-3">
                                                    <label for="particular_details"
                                                        class="block text-gray-700 font-bold mb-2">PARTICULAR
                                                        DETAILS<span class="text-red-500">*</span></label>
                                                    <textarea id="particular_details" wire:model="particular_details"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        placeholder="Enter particular details"></textarea>
                                                    @error('particular_details')
                                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mb-4">
                                                    <label for="courier_type"
                                                        class="block text-gray-700 font-bold mb-2">COURIER TYPE<span
                                                            class="text-red-500">*</span></label>
                                                    <select wire:model="courier_type"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                        <option value="">Select</option>
                                                        <option value="courier">Courier</option>
                                                        <option value="speed">Speed Post</option>
                                                        <option value="byhand">By Hand</option>
                                                    </select>
                                                    @error('courier_type')
                                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mb-4">
                                                    <label for="tracking_no"
                                                        class="block text-gray-700 font-bold mb-2">TRACKING NO.<span
                                                            class="text-red-500">*</span></label>
                                                    <input type="text" id="tracking_no" wire:model="tracking_no"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        placeholder="Enter tracking number">
                                                    @error('tracking_no')
                                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mb-4">
                                                    <label for="delivery_status"
                                                        class="block text-gray-700 font-bold mb-2">DELIVERED/UNDELIVERED<span
                                                            class="text-red-500">*</span></label>
                                                    <select id="delivery_status" wire:model="delivery_status"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                        <option value="">Select status</option>
                                                        <option value="Delivered">Delivered</option>
                                                        <option value="Undelivered">Undelivered</option>
                                                    </select>
                                                    @error('delivery_status')
                                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mb-4 col-span-1 md:col-span-2 lg:col-span-3">
                                                    <label for="remarks"
                                                        class="block text-gray-700 font-bold mb-2">REMARKS<span
                                                            class="text-red-500">*</span></label>
                                                    <textarea id="remarks" wire:model="remarks"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                        placeholder="Enter remarks"></textarea>
                                                    @error('remarks')
                                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div
                                                    class="flex items-center justify-end col-span-1 md:col-span-2 lg:col-span-3">
                                                    <button type="submit"
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-3 rounded shadow-sm">
                {{ session('message') }}
            </div>
        @endif
    </div>

    {{-- {{ $data->links() }} --}}
    {{-- @else
        <p>No associates found.</p>
    @endif --}}
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
