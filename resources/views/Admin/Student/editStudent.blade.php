@extends('layouts.admin')
@section('page-title', 'Student Edit Form')
@section('main-content')
    <div class="ml-[18vw] min-h-screen bg-gray-50 flex justify-center py-10 px-6">
        <div class="bg-white w-[90%] max-w-6xl rounded-2xl shadow-md border border-gray-200 p-10 relative">
            <!-- Header -->
            <div class="flex flex-col md:flex-row items-center justify-end mb-10">
                <form action="{{ route('student.update', encrypt($student->id) ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Upload Image -->
                    <div class="flex flex-col items-center mb-6 md:mb-0">
                        <input type="file" name="photo" id="imageInput" class="hidden" accept="image/*">
                        <label for="photo"
                            class="flex flex-col items-center justify-center w-40 h-40 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition relative overflow-hidden">
                            <img id="photoPreview" src="{{ $student->image ? asset('storage/' . $student->image) : '' }}" alt="Preview"
                                class="absolute inset-0 w-full h-full object-cover rounded-lg" />
                            <div id="uploadPlaceholder" class="flex flex-col items-center justify-center text-center">
                                <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m10 12V4m-9 8l2 2 4-4m5 6H5" />
                                </svg>
                                <p class="text-sm text-gray-500">Upload std image</p>
                            </div>
                            <input id="photo" type="file" name="photo" class="hidden" accept="image/*" />
                        </label>
                    </div>
                    <!-- Title -->
                    <h2
                        class="absolute top-[10vh] left-[200px] inline-block text-2xl font-bold text-gray-800 text-center md:text-right w-[60%]">
                        Student Edit Form
                    </h2>
            </div>
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
                    <input type="text" name="name" value="{{ $student->name }}" maxlength="30"
                        placeholder="Enter Student Name"
                        class="mt-1 w-full border rounded-lg px-4 py-2
            {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}">
                    @error('name')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Father Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Father Name</label>
                    <input type="text" name="fatherName" value="{{ $student->fatherName }}" maxlength="30"
                        placeholder="Enter Father Name"
                        class="mt-1 w-full border rounded-lg px-4 py-2
            {{ $errors->has('fatherName') ? 'border-red-500' : 'border-gray-300' }}">
                    @error('fatherName')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Date of Birth -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" name="dob" min="1900-01-01" max="3000-12-31" value="{{ $student->dob }}"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 {{ $errors->has('dob') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}">
                    @error('dob')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- CNIC -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">CNIC</label>
                    <input type="text" name="cnic" placeholder="Enter your CNIC" value="{{ $student->cnic }}"
                        id="cnic"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 {{ $errors->has('cnic') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}"
                        maxlength="15">
                    @error('cnic')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" placeholder="Enter email address" value="{{ $student->email }}"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 {{ $errors->has('email') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Institute -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Institute</label>
                    <select name="institute_id"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:ring-green-500 focus:border-green-500 {{ $errors->has('institute_id') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}">
                        <option value="">Select institute</option>
                        @foreach ($insts as $institute)
                            <option value="{{ $institute->id }}"
                                {{ $student->instituteId == $institute->id ? 'selected' : '' }}>
                                {{ $institute->institute_name }}</option>
                        @endforeach
                    </select>
                    @error('institute_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Contact -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact</label>
                    <input type="text" name="phone" id="phone" placeholder="Contact number"
                        value="{{ $student->phone }}" maxlength="11"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2
                        focus:ring-green-500 focus:border-green-500
                        {{ $errors->has('phone') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}">
                    @error('phone')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Gender -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:ring-green-500 focus:border-green-500 {{ $errors->has('gender') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}">
                        <option value="">Select a Gender</option>
                        <option value="Male" {{ $student->gender === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $student->gender === 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Others" {{ $student->gender === 'Others' ? 'selected' : '' }}>Others</option>
                    </select>
                    @error('gender')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700" for="joiningDate">Joining Date</label>
                    <input type="Date" name="joiningDate" value="{{ $student->joiningDate }}" maxlength="11"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 {{ $errors->has('joiningDate') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}">
                    @error('joiningDate')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700" for="fromDate">From</label>
                    <input type="Date" name="fromDate" value="{{ $student->from }}" maxlength="11"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 {{ $errors->has('fromDate') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}">
                    @error('fromDate')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700" for="toDate">To</label>
                    <input type="Date" name="toDate" value="{{ $student->to }}" maxlength="11"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 {{ $errors->has('toDate') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}">
                    @error('toDate')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Address -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text"  name="address" placeholder="Address"
                    value="{{ $student->address }}" maxlength="200"
                    class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 {{ $errors->has('address') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}">
                @error('address')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Submit Button -->
            <div class="flex justify-center mt-8">
                <button type="submit"
                    class="bg-green-600 text-white px-10 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                    Save
                </button>
            </div>
            </form>
        </div>
    </div>
    <script>
        const input = document.getElementById('photo');
        const preview = document.getElementById('photoPreview');
        const placeholder = document.getElementById('uploadPlaceholder');
        input.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }
        });
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
