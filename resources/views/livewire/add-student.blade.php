<div class="container mx-auto px-4 py-8">
    <!-- Add this code to your Blade file where you want to display the error message -->
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="addstudent">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    University
                </label>
                <select wire:model.live="university" id="university" class="form-select">
                    <option value="">Choose University</option>
                    @foreach ($universities as $mb)
                        <option value="{{ $mb->id }}">{{ $mb->university_name }}</option>
                    @endforeach
                </select>
                @error('university')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="session">
                    Session
                </label>
                <select wire:model="session_name" id="session" class="form-select">
                    <option value="">Choose Session</option>
                    @if ($university != null)
                    @foreach ($sessions as $mb)
                        <option value="{{ $mb->id }}">{{ $mb->name }}</option>
                    @endforeach
                    @endif
                </select>
                @error('session_name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="course">
                    Course Name
                </label>
                <select id="selectedCourse" class="form-select" wire:model.live="selectedCourse">
                    <option value="">Choose Course</option>
                    @if ($university != null)
                    @foreach ($course as $data)
                        <option value="{{ $data->id }}">{{ $data->course_name }}</option>
                    @endforeach
                    @endif
                </select>
                @error('selectedCourse')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="programme">
                    Specialization Name
                </label>
                <select wire:model="selectedspecialization" id="programme" class="form-select">
                    <option value="">Choose Specialization</option>
                    @if ($selectedCourse != null)
                        @foreach ($specialization as $data)
                            <option value="{{ $data->specialization_name }}">{{ $data->specialization_name }}</option>
                        @endforeach
                    @endif
                </select>
                @error('specialization')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="course">
                    Admission Type
                </label>
                <select wire:model="admission_type" id="course" class="form-select">
                    <option value="">Admission Type</option>
                    <option value="FRESH">FRESH</option>
                    <option value="RE REG">RE REG</option>
                    <option value="LATERAL">LATERAL</option>
                    <option value="OD">OD</option>

                </select>
                @error('admission_type')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="semester">
                    Semester/Year
                </label>
                <select wire:model="semester" id="semester" class="form-select">
                    <option value="">Semester/Year</option>
                    @for ($i = 1; $i < 9; $i++)
                        <option value="{{ $i }} Semester"> {{ $i }} Semester </option>
                    @endfor

                </select>
                @error('semester')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="course">
                    Source
                </label>
                <select wire:model.live="source" id="source" class="form-select">
                    <option value="">Select Source</option>
                    <option value="ASSOCIATE">ASSOCIATE</option>
                    <option value="DIRECT">DIRECT</option>
                    <option value="SOCIAL MEDIA">SOCIAL MEDIA</option>
                    <option value="REFERENCE">REFERENCE</option>

                </select>
                @error('source')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            @if ($source == 'ASSOCIATE')
                <div class="    px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="course">
                        Associate
                    </label>
                    <select wire:model="selectedassociate" id="associate" class="form-select">
                        <option value="">Select Associate</option>
                        @foreach ($associate as $item)
                            <option value="{{$item->name}}">{{ $item->name }}</option>
                        @endforeach>

                    </select>
                    @error('associate')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                @else
                @php $selectedassociate = null; @endphp 
            @endif
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Full Name
                </label>
                <input type="text" name="fname" id="fname" wire:model="fname">
                <div>
                    @error('fname')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Father's Name
                </label>
                <input type="text" name="father_name" id="father_name" wire:model="father_name">
                <div>
                    @error('father_name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Mother's Name
                </label>
                <input type="text" name="mother_name" id="mother_name" wire:model="mother_name">
                <div>
                    @error('mother_name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Date of Birth
                </label>
                <input type="date" name="dob" id="dob" wire:model="dob">
                <div>
                    @error('dob')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Email
                </label>
                <input type="email" name="email" id="email" wire:model="email">
                <div>
                    @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="adhaar">
                    Adhaar Card Number
                </label>
                <input type="tel" name="adhaar" id="adhaar" wire:model="aadhar_no">
                <div>
                    @error('aadhar_no')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Mobile Number
                </label>
                <input type="tel" name="mob" id="mob" wire:model="mob">
                <div>
                    @error('mob')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Address
                </label>
                <textarea wire:model="address"></textarea>
                <div>
                    @error('address')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Previous Migration:
                </label>
                <input type="month" name="pmigration" id="pmigration" wire:model="pmigration">
                <div>
                    @error('pmigration')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Fee:
                </label>
                <input type="text" name="fee" id="fee" wire:model="fee">
                <div>
                    @error('fee')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Exam Status
                </label>
                <input type="text" name="exam_status" id="exam_status" wire:model="exam_status">
                <div>
                    @error('exam_status')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Project Status
                </label>
                <input type="text" name="prj_status" id="prj_status" wire:model="prj_status">
                <div>
                    @error('prj_status')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    UNI. Visit Date
                </label>
                <input type="date" name="visit_date" id="visit_date" wire:model="visit_date">
                <div>
                    @error('visit_date')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Pass/Back
                </label>
                <input type="text" name="pass_back" id="pass_back" wire:model="pass_back">
                <div>
                    @error('pass_back')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Documents
                </label>
                <input type="file" wire:model="documents" multiple>
                <div>
                    @if ($documents)
                        @foreach ($documents as $item)
                            <img id="previewImage" src="{{ $item->temporaryUrl() }}" alt="Documents">
                        @endforeach
                    @endif
                    @error('documents')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center">
            <x-button type="submit" class="bg-blue-500 text-white font-bold px-4 py-2 rounded outline-none transition duration-300 ease-in-out focus:bg-blue-600">{{ __('Add Student') }}</x-button>
        </div>
    </form>
</div>
