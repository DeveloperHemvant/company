<div x-data="{ open: @entangle('showDropdown') }">
    <!-- Livewire modal -->
    <div x-show="open" class="fixed inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" x-show="open"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
            <i class="fa-solid fa-xmark"></i>
            <!-- Modal -->
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-3/4 lg:w-1/2"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline" x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <!-- Modal content -->
                <form wire:submit.prevent="updatesem">
                    <div class="px-6 py-4">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Student Semester Update</h2>
                        <div class="mb-4">
                            <label for="session" class="block text-sm font-bold text-gray-700">Session<span
                                    class="text-red-500">*</span></label>
                            <select wire:model.live="uselectedSession" id="session" class="form-select mt-1 block w-full">
                                <option value="">Choose Session</option>
                                @if ($admissionSessions)
                                @foreach ($admissionSessions as $session)
                                <option value="{{ $session['id'] }}">{{ $session['name'] }}</option>
                            @endforeach
                                @endif
                               
                            </select>
                            @error('uselectedSession')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="fee" class="block text-sm font-bold text-gray-700">Fee:<span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="fee" id="fee" wire:model="fee"
                                class="form-input mt-1 block w-full">
                            @error('fee')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="semester" class="block text-sm font-bold text-gray-700">Semester/Year <span
                                    class="text-red-500">*</span></label>
                            <select wire:model="semester" id="semester" class="form-select mt-1 block w-full">
                               
                                <option value=""> Select Semester </option>
                                @if ($this->monthDifference >= 11)
                                    @foreach ([2, 4, 6] as $i)
                                        <option value="{{ $i }}"> {{ $i }} Semester </option>
                                    @endforeach
                                @elseif ($this->monthDifference >= 23)
                                    @foreach ([4, 8] as $i)
                                        <option value="{{ $i }}"> {{ $i }} Semester </option>
                                    @endforeach
                                @else
                                    @for ($i = 1; $i < 9; $i++)
                                        <option value="{{ $i }}"> {{ $i }} Semester </option>
                                    @endfor
                                @endif
                            </select>
                            @error('semester')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-100 border-t border-gray-200 flex justify-end">
                        <button type="button" @click="showModal = false" wire:click="hide"
                            class="text-gray-600 mr-4">Close</button>
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('exists', function(event) {
        const message = event.detail[0].message;
        // console.log(event);
        Swal.fire({
            position: "top-end",
            icon: "warning",
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    });
    window.addEventListener('semesterUpdated', function() {
       
        // console.log(event);
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Semester updated successfully",
            showConfirmButton: false,
            timer: 3000
        });
    });
</script>
