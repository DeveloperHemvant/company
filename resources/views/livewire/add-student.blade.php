<!-- livewire/form-component.blade.php -->

<div class="container mx-auto px-4 py-8">
    <form wire:submit.prevent="submitForm" class="max-w-lg mx-auto">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    University
                </label>
                <select wire:model="session_name" id="university" class="form-select">
                    <option value="" selected>Choose University</option>
                    @foreach ($university as $mb)
                        <option value="{{ $mb->id }}">{{ $mb->university_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="session">
                    Session
                </label>
                <select wire:model="session_name" id="session" class="form-select">
                    <option value="" selected>Choose Session</option>
                    @foreach ($sessions as $mb)
                        <option value="{{ $mb->id }}">{{ $mb->session_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="programme">
                    Programme Name
                </label>
                <select wire:model="programme_id" id="programme" class="form-select" wire:model.live="selectedProgramme">
                    <option value="" selected>Choose Programme</option>
                    @foreach ($programmes as $programme)
                        <option value="{{ $programme->id }}">{{ $programme->programme_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="course">
                    Course Name
                </label>
                <select wire:model="course_id" id="course" class="form-select" wire:model.live="selectedCourseFee">
                    <option value="" selected>Choose Course</option>
                    @if ($courses)
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="flex items-center justify-center">
            <button class="bg-blue-500 hover:bg-blue-700  font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Submit
            </button>
        </div>
    </form>
    <div class="mt-8 overflow-x-auto">
        @if ($selectedCourseFee)
        <table class="w-full bg-white shadow-md rounded-xl">
            <thead>
                <tr class="bg-blue-gray-100 text-gray-700">
                    <th class="py-3 px-4 text-left">Admission Fee</th>
                    <th class="py-3 px-4 text-left">Exam Fee</th>
                    <th class="py-3 px-4 text-left">Late Fee</th>
                    <th class="py-3 px-4 text-left">Total</th>
                </tr>
            </thead>
            <tbody class="text-blue-gray-900">
                <tr class="border-b border-blue-gray-200">
                    <td class="py-3 px-4">{{$selectedCourseFee->admission_fee}}</td>
                    <td class="py-3 px-4">{{$selectedCourseFee->exam_fee}}</td>
                    <td class="py-3 px-4">{{$selectedCourseFee->late_fee}}</td>
                    <td class="py-3 px-4">{{$selectedCourseFee->admission_fee+$selectedCourseFee->exam_fee+$selectedCourseFee->late_fee}}</td>
                </tr>
            </tbody>
        </table> 
        @endif
        
    </div>
</div>


