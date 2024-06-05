<div class="container mx-auto px-4 py-8">
    <form wire:submit="updatestudent">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="    px-3 mb-6">

                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    University<span class="text-red-500">*</span>
                </label>
                <select wire:model.live="uuniversity" id="university" class="form-select">
                    <option value="">Choose University</option>
                    @foreach ($university as $mb)
                        <option value="{{ $mb->id }}">{{ $mb->university_name }}</option>
                    @endforeach
                </select>
                @error('university')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="session">
                    Session<span class="text-red-500">*</span>
                </label>
                <select wire:model="usession_name" id="session" class="form-select">
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
                    Course Name<span class="text-red-500">*</span>
                </label>
                <select id="selectedCourse" class="form-select" wire:model.live="uselectedCourse">
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
                    Specialization Name<span class="text-red-500">*</span>
                </label>
                <select wire:model="uselectedspecialization" id="programme" class="form-select">
                    <option value="">Choose Specialization</option>
                    @foreach ($specialization as $data)
                        <option value="{{ $data->id }}">{{ $data->specialization_name }}</option>
                    @endforeach
                </select>
                @error('uselectedspecialization')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="course">
                    Admission Type<span class="text-red-500">*</span>
                </label>
                <select wire:model="uadmission_type" id="course" class="form-select">
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
                    Semester/Year<span class="text-red-500">*</span>
                </label>
                <select wire:model="usemester" id="semester" class="form-select">
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
                    Source<span class="text-red-500">*</span>
                </label>
                <select wire:model.live="usource" id="source" class="form-select">
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
            @if ($usource == 'ASSOCIATE')
                <div class="px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="course">
                        Associate<span class="text-red-500">*</span>
                    </label>
                    <select wire:model="uassociate" id="associate" class="form-select">
                        <option value="">Select Associate</option>
                        @foreach ($associate as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('uassociate')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            @elseif ($usource == 'DIRECT' || $usource == 'SOCIAL MEDIA' || $usource == 'REFERENCE')
                <div class="px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                        Name<span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="refname" id="refname" wire:model="refname">
                    <div>
                        @error('refname')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            @endif

            <div class="    px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Full Name<span class="text-red-500">*</span>
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
                    Father's Name<span class="text-red-500">*</span>
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
                    Mother's Name<span class="text-red-500">*</span>
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
                    Date of Birth<span class="text-red-500">*</span>
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
                    Email<span class="text-red-500">*</span>
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
                    Adhaar Card Number<span class="text-red-500">*</span>
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
                    Mobile Number<span class="text-red-500">*</span>
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
                    Address<span class="text-red-500">*</span>
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
            @foreach ($files as $index => $file)
                <div class="px-3 mb-6 flex items-center">
                    <label for="file_{{ $index }}"
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mr-2">
                        Documents
                    </label>
                    <input type="file" id="file_{{ $index }}" wire:model="files.{{ $index }}.file"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @if (count($files) > 1)
                        <button type="button" wire:click.prevent="removeFile({{ $index }})"
                            class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Remove
                        </button>
                    @endif
                    @error('files.' . $index . '.file')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach

            <div class="px-3 mb-6">
                <button type="button" wire:click.prevent="addFile"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add File
                </button>
            </div>
            <div class="    px-3 mb-6">
                @if ($studentdata->documents)
                    <div>
                        <a href="{{ Storage::url($studentdata->documents) }}" target="_blank"
                            style="background-color: rgb(50, 110, 32); color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;">View
                            PDF</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex items-center justify-center">
            <x-button type="submit" class="bg-blue-500 text-white font-bold px-4 py-2 rounded outline-none transition duration-300 ease-in-out focus:bg-blue-600">{{ __('Update Student') }}</x-button>
        </div>

    </form>
</div>
