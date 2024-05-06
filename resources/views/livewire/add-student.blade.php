<div class="container mx-auto px-4 py-8">
    <form wire:submit.prevent="submitForm" class="max-w-lg mx-auto">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    University
                </label>
                <select wire:model="university" id="university" class="form-select">
                    <option value="" selected>Choose University</option>
                    @foreach ($university as $mb)
                        <option value="{{ $mb->id }}">{{ $mb->university_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
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
            <div class=" md:w-1/2 px-3 mb-6">
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
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="course">
                    Course Name
                </label>
                <select wire:model="course_id" id="course" class="form-select" >
                    <option value="" selected>Choose Course</option>
                    @if ($courses)
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                {{-- <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    First Name
                </label>
                <input type="text" name="fname" id="fname"> --}}
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    First Name
                </label>
                <input type="text" name="fname" id="fname" wire:model="fname">
                <div>@error('fname') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Last Name
                </label>
                <input type="text" name="lname" id="lname" wire:model="lname">
                <div>@error('lname') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Father's Name
                </label>
                <input type="text" name="father_name" id="father_name" wire:model="father_name">
                <div>@error('father_name') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Mother's Name
                </label>
                <input type="text" name="mother_name" id="mother_name" wire:model="mother_name">
                <div>@error('mother_name') {{ $message }} @enderror</div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                   Date of Birth
                </label>
                <input type="date" name="dob" id="dob" wire:model="dob">
                <div>@error('dob') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Email
                </label>
                <input type="email" name="email" id="email" wire:model="email">
                <div>@error('email') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Mobile Number
                </label>
                <input type="tel" name="mob" id="mob" wire:model="mob">
                <div>@error('mob') {{ $message }} @enderror</div>
            </div>
            
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                   Address
                </label>
                <textarea wire:model="address" ></textarea>
                <div>@error('address') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    City
                </label>
                <input type="text" name="city" id="city" wire:model="city">
                <div>@error('city') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Pin Code
                </label>
                <input type="number" name="pincode" id="pincode" wire:model="pincode" min="6" max="6">
                <div>@error('pincode') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    State
                </label>
                <input type="text" name="state" id="state" wire:model="state">
                <div>@error('state') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    District
                </label>
                <input type="text" name="distt" id="distt" wire:model="distt">
                <div>@error('distt') {{ $message }} @enderror</div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                   Academic Qualification:
                </label>
                <input type="text" name="academic" id="academic" wire:model="academic">
                <div>@error('academic') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Main Subject
                </label>
                <input type="text" name="subject" id="subject" wire:model="subject">
                <div>@error('subject') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Passing Year
                </label>
                <input type="month" name="passingyear" id="passingyear" wire:model="passingyear">
                <div>@error('passingyear') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Division
                </label>
                <input type="text" name="division" id="division" wire:model="division">
                <div>@error('division') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    % of Marks
                </label>
                <input type="text" name="marks" id="marks" wire:model="marks">
                <div>@error('marks') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Medium
                </label>
                <input type="text" name="medium" id="medium" wire:model="medium">
                <div>@error('medium') {{ $message }} @enderror</div>
            </div>
            <div class=" md:w-1/2 px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="university">
                    Board
                </label>
                <input type="text" name="board" id="board" wire:model="board" data-role="tagsinput">
                <div>@error('board') {{ $message }} @enderror</div>
            </div>
        </div>
        {{-- <div class="mt-8 overflow-x-auto">
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
        </div> --}}
        
        <div class="flex items-center justify-center">
            <button style="background-color: #1e40af; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; outline: none; cursor: pointer; transition: background-color 0.3s ease;" 
        class="hover:bg-blue-700" type="submit">
    Add Student
</button>

        </div>
        
    </form>
  
    
</div>


