<div x-data="{ open: @entangle('showViewDropdown') }">
    <!-- Livewire modal -->
    <div x-show="open" class="fixed inset-0 overflow-y-auto z-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" x-show="open"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

            <!-- Modal -->
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-3/4 lg:w-1/2"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline" x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                <!-- Modal header -->
                <div class="px-4 py-2 bg-gray-100 flex justify-between items-center border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ __('Student Details') }}
                    </h2>
                    <button @click="open = false" class="text-gray-600 hover:text-gray-900">
                        <i class="fa-solid fa-xmark fa-lg"></i>
                    </button>
                </div>

                <!-- Modal content -->
                <div class="p-6 bg-gray-50">
                    <div class="card mt-4">
                        <div class="card-header bg-gray-200 px-4 py-2 rounded-t-lg border-b border-gray-300">
                            <h3 class="text-lg font-medium text-gray-700">Student Information</h3>
                        </div>
                        <div class="card-body bg-white px-4 py-6 rounded-b-lg shadow">
                            @if ($studentsingleview)
                            <table class="table-auto w-full">
                                <tbody>
                                    @foreach([
                                        'University' => $studentsingleview->university->university_name,
                                        'Session' => $studentsingleview->session->name,
                                        'Course' => $studentsingleview->course->course_name,
                                        'Specialization' => $studentsingleview->specialization->name,
                                        'Admission Type' => $studentsingleview->type,
                                        'Semester/Year' => $studentsingleview->sem_year,
                                        'Source' => $studentsingleview->source,
                                        'Associate' => $studentsingleview->associate->name ?? 'N/A',
                                        'Full Name' => $studentsingleview->name,
                                        'Father\'s Name' => $studentsingleview->father_name,
                                        'Mother\'s Name' => $studentsingleview->mother_name,
                                        'Date of Birth' => $studentsingleview->dob,
                                        'Email' => $studentsingleview->email_id,
                                        'Aadhar Number' => $studentsingleview->aadhar_no,
                                        'Mobile Number' => $studentsingleview->mob_no,
                                        'Address' => $studentsingleview->address,
                                        'Previous Migration' => $studentsingleview->previous_migration,
                                        'Fee' => $studentsingleview->fee,
                                        'Exam Status' => $studentsingleview->exam_status,
                                        'Project Status' => $studentsingleview->project_status,
                                        'University Visit Date' => $studentsingleview->uni_visit_date,
                                        'Pass Back' => $studentsingleview->pass_back,
                                        'Marksheet 1st Sem' => $studentsingleview->marksheet_1st_sem,
                                        'Marksheet 2nd Sem' => $studentsingleview->marksheet_2nd_sem,
                                        'Marksheet 3rd Sem' => $studentsingleview->marksheet_3rd_sem,
                                        'Marksheet 4th Sem' => $studentsingleview->marksheet_4th_sem,
                                        'Marksheet 5th Sem' => $studentsingleview->marksheet_5th_sem,
                                        'Marksheet 6th Sem' => $studentsingleview->marksheet_6th_sem,
                                        'Marksheet 7th Sem' => $studentsingleview->marksheet_7th_sem,
                                        'Marksheet 8th Sem' => $studentsingleview->marksheet_8th_sem,
                                    ] as $key => $value)
                                    <tr class="border-b">
                                        <th class="text-left py-2 px-4 bg-gray-100">{{ $key }}</th>
                                        <td class="py-2 px-4">{{ $value }}</td>
                                    </tr>
                                    @endforeach

                                    @if ($studentsingleview->documents)
                                    <tr class="border-b">
                                        <th class="text-left py-2 px-4 bg-gray-100">Documents</th>
                                        <td class="py-2 px-4">
                                            <a href="{{ Storage::url($studentsingleview->documents) }}" target="_blank"
                                                class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700 transition-colors duration-300">
                                                View PDF
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="px-4 py-2 bg-gray-100 flex justify-end border-t border-gray-200">
                    <button type="button" @click="open = false" wire:click="hide"
                            class="text-gray-600 hover:text-gray-900">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
