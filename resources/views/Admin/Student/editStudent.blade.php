@extends('layouts.admin')

@section('page-title', 'Edit Student Details')

@section('main-content')

    <style>
        @media print {
            @page {
                size: A4;
                margin: 0;
            }

            .cardContainer {
                margin-left: 0 !important;
                width: 100% !important;
                padding: 0 !important;
            }

            .card {
                box-shadow: none !important;
                border: none !important;
                border-radius: 0 !important;
                width: 100% !important;
            }

            .header {
                box-shadow: none !important;
                -webkit-print-color-adjust: exact; /* Ensures background colors print */
                print-color-adjust: exact;
            }

            .information {
                display: flex !important;
                flex-wrap: wrap !important;
                flex-direction: row !important;
            }

            .information div {
                width: 33.33% !important;
                margin-bottom: 16px !important;
            }

            .enrollment {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: wrap !important;
            }

            .enrollment div {
                width: 50% !important;
                margin-bottom: 16px !important;
            }

            .no-print {
                display: none !important;
            }

            #name {
                font-size: 20px !important;
                color: black !important;
            }

            #student-id,
            #institute-name {
                color: black !important;
            }
        }
    </style>

    <div class="ml-[18vw] min-h-screen bg-gray-50 flex justify-center py-12 px-6 cardContainer">

        <form action="{{ route('student.update', $student) }}" method="POST" enctype="multipart/form-data" class="w-full max-w-6xl">
            @csrf
            @method('PUT')

            <div class="bg-white w-full rounded-2xl shadow-lg border border-gray-200 overflow-hidden relative card">

                <div class="bg-green-600 text-white p-8 rounded-t-2xl flex flex-col md:flex-row items-center justify-between shadow-md header">
                    <div class="flex items-center space-x-6">

                        <input type="file" name="photo" id="imageInput" class="hidden" accept="image/*">

                        <div class="relative group cursor-pointer" onclick="document.getElementById('imageInput').click()">
                            
                            <img id="profileImage" 
                                src="{{ $student->image ? asset('storage/' . $student->image) : '' }}" 
                                alt="Student Photo"
                                class="{{ $student->image ? '' : 'hidden' }} w-32 h-32 rounded-xl object-cover shadow-md border-2 border-white transition-transform transform group-hover:scale-105" />

                            <div id="placeholderImage" class="{{ $student->image ? 'hidden' : 'flex' }} flex-col items-center justify-center w-32 h-32 border-2 border-dashed border-white rounded-xl bg-green-500/20 text-white group-hover:bg-green-500/40 transition">
                                <svg class="w-10 h-10 mb-2 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m10 12V4m-9 8l2 2 4-4m5 6H5" />
                                </svg>
                                <p class="text-xs font-semibold">Upload Photo</p>
                            </div>

                            <div class="absolute inset-0 bg-black bg-opacity-40 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 no-print">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="">
                            <h2 class="text-3xl font-bold" id="name">{{ $student->name }}</h2>
                            <p class="text-sm text-green-100 mt-1" id="student-id">Student ID: {{ $student->id }}</p>
                            <p class="text-sm text-green-100" id="institute-name">
                                {{ $student->institute->institute_name ?? 'Institute: N/A' }}</p>
                        </div>
                    </div>

                    <div class="mt-6 md:mt-0 flex space-x-3 no-print">
                        <a href="{{ route('admin.studentList') }}"
                            class="bg-green-700 text-white px-5 py-2 rounded-lg font-semibold hover:bg-green-800 transition-all shadow">
                            Back
                        </a>
                    </div>
                </div>

                <div class="p-10">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Personal Information</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 information">
                        <div>
                            <p class="text-gray-500 text-sm">Full Name</p>
                            <input
                                class="font-medium text-gray-800 px-2 py-1 border border-1 border-gray-400 focus:border-green-600"
                                value="{{ $student->name }}" name="name" />
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Father Name</p>
                            <input
                                class="font-medium text-gray-800 px-2 py-1 border border-1 border-gray-400 focus:border-green-600"
                                value="{{ $student->fatherName }}" name="fatherName" />
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Date of Birth</p>
                            <input
                                type="date"
                                class="font-medium text-gray-800 px-2 py-1 border border-1 border-gray-400 focus:border-green-600"
                                value="{{ $student->dob }}" name="dob" />
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">CNIC</p>
                            <input
                                class="font-medium text-gray-800 px-2 py-1 border border-1 border-gray-400 focus:border-green-600"
                                value="{{ $student->cnic }}" name="cnic" id="cnic" />
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Email</p>
                            <input
                                class="font-medium text-gray-800 px-2 py-1 border border-1 border-gray-400 focus:border-green-600"
                                value="{{ $student->email }}" name="email" />
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Contact</p>
                            <input type="text"
                                class="font-medium text-gray-800 px-2 py-1 border border-1 border-gray-400 focus:border-green-600"
                                value="{{ $student->phone }}" name="phone" id="phone" maxlength="11" />
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Gender</p>
                            <input
                                class="font-medium text-gray-800 px-2 py-1 border border-1 border-gray-400 focus:border-green-600"
                                value="{{ $student->gender }}" name="gender" />
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-gray-500 text-sm">Address</p>
                            <input
                                class="font-medium text-gray-800 px-2 py-1 border border-1 border-gray-400 focus:border-green-600 w-full"
                                value="{{ $student->address }}" name="address" />
                        </div>
                    </div>

                    <div class="mt-10 border-t pt-6 enrollmentContainer">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Enrollment Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 enrollment">
                            <div>
                                <p class="text-gray-500 text-sm">Institute</p>
                                <select name="institute_id"
                                    class="font-medium text-gray-800 px-2 py-1 border border-1 border-gray-400 focus:border-green-600 w-full">
                                    @foreach ($institutes as $institute)
                                        <option value="{{ $institute->id }}"
                                            {{ $student->institute_id == $institute->id ? 'selected' : '' }}>
                                            {{ $institute->institute_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Registration Date</p>
                                <input
                                    class="font-medium text-gray-800 px-2 py-1 border border-1 border-gray-400 focus:border-green-600"
                                    value="{{ $student->joiningDate }}" name="joiningDate" />
                            </div>
                        </div>
                    </div>

                    <div class="button mt-4 flex flex-row justify-center no-print">
                        <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800 transition">
                            Submit Changes
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script>
        // 1. IMAGE PREVIEW LOGIC
        const imageInput = document.getElementById('imageInput');
        const profileImage = document.getElementById('profileImage');
        const placeholderImage = document.getElementById('placeholderImage');

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                    profileImage.classList.remove('hidden');
                    placeholderImage.classList.add('hidden');
                    placeholderImage.classList.remove('flex'); // Ensure flex is removed
                }
                reader.readAsDataURL(file);
            }
        });

        // 2. CNIC FORMATTING
        const cnicInput = document.getElementById('cnic');
        cnicInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            value = value.slice(0, 13);
            let formatted = value;
            if (value.length > 5 && value.length <= 12) {
                formatted = value.slice(0, 5) + '-' + value.slice(5);
            } else if (value.length > 12) {
                formatted = value.slice(0, 5) + '-' + value.slice(5, 12) + '-' + value.slice(12);
            }
            e.target.value = formatted;
        });

        // 3. PHONE FORMATTING
        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            value = value.slice(0, 11);
            e.target.value = value;
        });
    </script>
@endsection