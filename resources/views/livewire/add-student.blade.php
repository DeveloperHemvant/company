<div class="container mx-auto px-4 py-8">
    <form wire:submit.prevent="addstudent" class="max-w-lg mx-auto">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    University
                </label>
                <select wire:model="university" id="universities" class="form-select">
                    <option value="">Choose University</option>
                    @foreach ($universities as $mb)
                        <option value="{{ $mb->id }}">{{ $mb->university_name }}</option>
                    @endforeach
                </select>
                @error('university')
                     <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="session">
                    Session
                </label>
                <select wire:model="session_name" id="session" class="form-select">
                    <option value="">Choose Session</option>
                    @foreach ($sessions as $mb)
                        <option value="{{ $mb->id }}">{{ $mb->session_name }}</option>
                    @endforeach
                </select>
                @error('session_name')
                   <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
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
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="programme">
                    Specialization Name
                </label>
                <select wire:model="specialization" id="programme" class="form-select">
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
            <div class=" md:w-1/2 px-3 mb-6">
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
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    First Name
                </label>
                <input type="text" name="fname" id="fname" wire:model="fname">
                <div>
                    @error('fname')
                         <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Last Name
                </label>
                <input type="text" name="lname" id="lname" wire:model="lname">
                <div>
                    @error('lname')
                         <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
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
            <div class=" md:w-1/2 px-3 mb-6">
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
            <div class=" md:w-1/2 px-3 mb-6">
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
            <div class=" md:w-1/2 px-3 mb-6">
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
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="adhaar">
                    Adhaar Card Number
                </label>
                <input type="tel" name="adhaar" id="adhaar" wire:model="adhaar"
                    pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}">
                <div>
                    @error('adhaar')
                         <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
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
            <div class=" md:w-1/2 px-3 mb-6">
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
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Academic Qualification:
                </label>
                <input type="text" name="academic" id="academic" wire:model="academic">
                <div>
                    @error('academic')
                         <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Main Subject
                </label>
                <input type="text" name="subject" id="subject" wire:model="subject">
                <div>
                    @error('subject')
                         <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Passing Year
                </label>
                <input type="month" name="passingyear" id="passingyear" wire:model="passingyear">
                <div>
                    @error('passingyear')
                         <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Division
                </label>
                <input type="text" name="division" id="division" wire:model="division">
                <div>
                    @error('division')
                         <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    % of Marks
                </label>
                <input type="text" name="marks" id="marks" wire:model="marks">
                <div>
                    @error('marks')
                         <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Medium
                </label>
                <input type="text" name="medium" id="medium" wire:model="medium">
                <div>
                    @error('medium')
                         <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Board
                </label>
                <input type="text" name="board" id="board" wire:model="board" data-role="tagsinput">
                <div>
                    @error('board')
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
