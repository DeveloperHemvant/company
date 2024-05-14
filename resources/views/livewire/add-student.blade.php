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
                <select wire:model="university" id="university" class="form-select">
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
                    @foreach ($sessions as $mb)
                        <option value="{{ $mb->id }}">{{ $mb->name }}</option>
                    @endforeach
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
                    @foreach ($cousre as $data)
                        <option value="{{ $data->id }}">{{ $data->course_name }}</option>
                    @endforeach
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
                            <option value="{{ $data->id }}">{{ $data->specialization_name }}</option>
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
                    <option value="1">FRESH</option>
                    <option value="2">RE REG</option>
                    <option value="3">LATERAL</option>
                    <option value="4">OD</option>

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
                        <option value="{{ $i }}"> {{ $i }} Semester </option>
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
                    <option value="1">ASSOCIATE</option>
                    <option value="2">DIRECT</option>
                    <option value="3">SOCIAL MEDIA</option>
                    <option value="4">REFERENCE</option>

                </select>
                @error('source')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            @if ($source == 1)
                <div class="    px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="course">
                        Associate
                    </label>
                    <select wire:model="selectedassociate" id="associate" class="form-select">
                        <option value="">Select Associate</option>
                        @foreach ($associate as $item)
                            <option value="{{ $item->id }}">{{ $item->associate_name }}</option>
                        @endforeach>

                    </select>
                    @error('associate')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
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
                    10 and 12 Marksheets
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
            <button
                style="background-color: rgb(26, 149, 219); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;"
                class="hover:bg-blue-700" type="submit">
                Add Student
            </button>

        </div>

    </form>

</div>
