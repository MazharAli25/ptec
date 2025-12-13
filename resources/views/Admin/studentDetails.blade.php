@extends('layouts.admin')

@section('page-title', 'Student Details')

@section('main-content')
    <div class="ml-[18vw] min-h-screen bg-gray-50 flex justify-center py-10 px-6">

        <div class="bg-white w-[90%] max-w-6xl rounded-2xl shadow-md border border-gray-200 p-10 relative">

            <!-- Header -->
            <div class="flex flex-col md:flex-row items-center justify-end mb-10">
                <!-- Upload Image -->
                <div class="flex flex-col items-center mb-6 md:mb-0">
                    <div for="photo"
                        class="flex flex-col items-center justify-center w-40 h-40 border-2 border-dashed border-gray-300 rounded-lg relative ">
                        <img id="photoPreview" src="{{ asset('storage/' . $student->image) }}"
                            class="absolute inset-0 w-full h-full object-cover rounded-lg z-10" />

                </div>
                </div>

                <!-- Title -->
                <h2
                    class="absolute top-[10vh] left-[200px] inline-block text-2xl font-bold text-gray-800 text-center md:text-right w-[60%]">
                    Student Details
                </h2>
            </div>

            <!-- Form -->

            @csrf

            <div class="absolute top-40">
                <label class="block text-sm font-medium text-gray-700">Student ID</label>
                <input type="text" name="id" placeholder="Upcoming Student ID"
                    value="{{ $student->id ?? 'Not Set' }}" readonly
                    class="mt-1 w-20 border rounded-lg px-4 py-2 
                        focus:ring-green-500 focus:border-green-500
                        {{ $errors->has('id') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">

                <!-- Student Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input value="{{ $student->name }}" class="mt-1 w-full border rounded-lg px-4 py-2" readonly>
                </div>

                <!-- Father Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Father Name</label>
                    <input value="{{ $student->fatherName }}" class="mt-1 w-full border rounded-lg px-4 py-2" readonly>
                </div>

            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Date of Birth -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input value="{{ $student->dob }}" class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2"
                        readonly>
                </div>

                <!-- CNIC -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">CNIC</label>
                    <input value="{{ $student->cnic }}" id="cnic"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2"readonly>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input value="{{ $student->email }}" class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2"
                        readonly>
                </div>

                <!-- Institute -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Institute</label>
                    <input class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2"
                        value="{{ $student->institute->institute_name }}" readonly>
                </div>

                <!-- Contact -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact</label>
                    <input class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2" value="{{ $student->phone }}"
                        readonly>
                </div>


                <!-- gender -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <input class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2" value="{{ $student->gender }}"
                        readonly>
                </div>
                <!-- Address -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <input class="mt-1 w-[300%] border border-gray-300 rounded-lg px-4 py-2"
                        value="{{ $student->address }}" readonly>

                </div>
            </div>
        </div>

        <script>
            // CNIC FORMAT
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

            // PHONE NUMBER FORMAT
            const phoneInput = document.getElementById('phone');

            phoneInput.addEventListener('input', (e) => {
                // Remove all non-digit characters
                let value = e.target.value.replace(/\D/g, '');

                // Limit to 11 digits
                value = value.slice(0, 11);

                e.target.value = value;
            });
        </script>
    @endsection
