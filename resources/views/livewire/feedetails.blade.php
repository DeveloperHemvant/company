<div>
    <div class="pl-4 pt-4">
        <button
            style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
            wire:click="toggleAddForm" class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded mb-4">
            {{ $showAddForm ? 'Cancel' : 'Add Fee Details' }}
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
            <form wire:submit.prevent="save" class="mb-4 mx-auto p-4 bg-white shadow-md rounded-lg" autocomplete="off">
                <div class="grid grid-cols-4 gap-4">
                    <div class="mb-4">
                        <label for="date" class="block text-gray-700 font-bold mb-2">DATE<span
                                class="text-red-500">*</span></label>
                        <input type="date" id="date" wire:model="date" autocomplete="off"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter date">
                        @error('date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="received_from" class="block text-gray-700 font-bold mb-2">RECEIVED WITH THANKS
                            FROM<span class="text-red-500">*</span></label>
                        <input type="text" id="received_from" wire:model="received_from" autocomplete="off"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter name">
                        @error('received_from')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="received_amount" class="block text-gray-700 font-bold mb-2">RECEIVED AMOUNT<span
                                class="text-red-500">*</span></label>
                        <input type="number" id="received_amount" wire:model="received_amount" autocomplete="off"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter amount">
                        @error('received_amount')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold mb-2">DESCRIPTION<span
                                class="text-red-500">*</span></label>
                        <textarea id="description" wire:model="description" autocomplete="off"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter description"></textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="mode" class="block text-gray-700 font-bold mb-2">MODE<span
                                class="text-red-500">*</span></label>
                        <select id="mode" wire:model="mode" autocomplete="off"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select mode</option>
                            <option value="UPI">UPI</option>
                            <option value="IMPS">IMPS</option>
                            <option value="NEFT">NEFT</option>
                            <option value="UNIVERSITY_ACCOUNT">UNIVERSITY ACCOUNT</option>
                            <option value="CASH">CASH</option>
                        </select>
                        @error('mode')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="remark" class="block text-gray-700 font-bold mb-2">REMARK<span
                                class="text-red-500">*</span></label>
                        <textarea id="remark" wire:model="remark" autocomplete="off"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter remark"></textarea>
                        @error('remark')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between col-span-4">
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
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" wire:model.live.debounce.250ms="rsearch"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 pr-2 py-2"
                    placeholder="Search by Received From">
            </div>
        </div>
        <div class="mb-4 md:ml-4">
           
            <select id="mode" wire:model.live.debounce.250ms="search" autocomplete="off"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select mode</option>
                <option value="UPI">UPI</option>
                <option value="IMPS">IMPS</option>
                <option value="NEFT">NEFT</option>
                <option value="UNIVERSITY_ACCOUNT">UNIVERSITY ACCOUNT</option>
                <option value="CASH">CASH</option>
            </select>
        </div>
    </div>
    
    {{-- @if ($data->count()) --}}
    <div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Received
                        From</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Received
                        Amount</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Description</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mode
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remark
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($feeDetails as $feeDetail)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $feeDetail->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $feeDetail->received_from }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $feeDetail->received_amount }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $feeDetail->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $feeDetail->mode }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $feeDetail->remark }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="edit({{ $feeDetail->id }})"
                                class="text-indigo-600 hover:text-indigo-900"
                                style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                <button
                                    style="background-color: #f50808; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                                    wire:click="deleteconfirmation({{ $feeDetail->id }})" wire:loading.attr="disabled"
                                    class="text-red-600 hover:text-red-900 ml-2">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                    @if ($showEditForm && $feeDetailId === $feeDetail->id)
                        <tr>
                            <td colspan="7">
                                <!-- Edit Fee Detail Form -->
                                <form wire:submit.prevent="update"
                                    class="mb-4 mx-auto p-4 bg-white shadow-md rounded-lg" autocomplete="off">
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="mb-4">
                                            <label for="date" class="block text-gray-700 font-bold mb-2">Date<span
                                                    class="text-red-500">*</span></label>
                                            <input type="date" id="date" wire:model="date"
                                                autocomplete="off"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            @error('date')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="received_from"
                                                class="block text-gray-700 font-bold mb-2">Received From<span
                                                    class="text-red-500">*</span></label>
                                            <input type="text" id="received_from" wire:model="received_from"
                                                autocomplete="off"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                placeholder="Enter received from">
                                            @error('received_from')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="received_amount"
                                                class="block text-gray-700 font-bold mb-2">Received Amount<span
                                                    class="text-red-500">*</span></label>
                                            <input type="number" step="0.01" id="received_amount"
                                                wire:model="received_amount" autocomplete="off"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                placeholder="Enter received amount">
                                            @error('received_amount')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="description"
                                                class="block text-gray-700 font-bold mb-2">Description</label>
                                            <input type="text" id="description" wire:model="description"
                                                autocomplete="off"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                placeholder="Enter description">
                                            @error('description')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="mode" class="block text-gray-700 font-bold mb-2">Mode<span
                                                    class="text-red-500">*</span></label>
                                            <select id="mode" wire:model="mode"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                <option value="">Select Mode</option>
                                                <option value="UPI">UPI</option>
                                                <option value="IMPS">IMPS</option>
                                                <option value="NEFT">NEFT</option>
                                                <option value="UNIVERSITY ACCOUNT">UNIVERSITY ACCOUNT</option>
                                                <option value="CASH">CASH</option>
                                            </select>
                                            @error('mode')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="remark"
                                                class="block text-gray-700 font-bold mb-2">Remark</label>
                                            <input type="text" id="remark" wire:model="remark"
                                                autocomplete="off"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                placeholder="Enter remark">
                                            @error('remark')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="flex items-center justify-between col-span-4">
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                Update
                                            </button>
                                            <button type="button" wire:click="resetForm"
                                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                Cancel
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
