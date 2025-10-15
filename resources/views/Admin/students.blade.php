@extends('layouts.admin')

@section('page-title', 'Add Student')

@section('main-content')
    <div class="w-[80vw] bg-gray-50 flex justify-center items-center px-6 py-10 ml-[19vw]">
        <div class="bg-white shadow-xl rounded-2xl w-full max-w-6xl p-10 border border-gray-200">
            <h2 class="text-3xl font-semibold text-green-600 mb-8 text-center">
                Add New Student
            </h2>

            <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Picture + Info Section -->
                <div class="flex flex-col md:flex-row items-center gap-8">

                    <!-- Image Upload & Preview -->
                    <div class="flex flex-col items-center w-full md:w-1/3">
                        <div class="w-40 h-40 rounded-full overflow-hidden bg-gray-100 border-4 border-green-500 mb-4">
                            <img id="previewImage" src=""
                                class="object-cover w-full h-full transition-all duration-300">
                        </div>

                        <input type="file" name="photo" id="photoInput" accept="image/*" value="{{ old('photo') }}"
                            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:ring-green-500 focus:border-green-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-600 file:text-white hover:file:bg-green-700 transition">
                        <p class="text-xs text-gray-500 mt-2 text-center">Allowed formats: JPG, PNG, JPEG (Max 2MB)</p>
                    </div>

                    <!-- Student Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full md:w-2/3">

                        <!-- Select Institute (Full Width) -->
                        <div class="md:col-span-2">
                            <label for="institute" class="block text-sm font-medium text-gray-700">Select Institute</label>
                            <select name="institute_id" id="institute"
                                class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 bg-white">
                                <option value="">-- Choose an Institute --</option>
                                @foreach ($insts as $institute)
                                    <option value="{{ $institute->id }}" value="{{ $institute->id }}" {{ old('institute_id') == $institute->id ? 'selected' : '' }}>{{ $institute->institute_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" id="name"
                                class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="Enter full name" required>
                        </div>
                        {{-- Father Name --}}
                        <div>
                            <label for="fatherName" class="block text-sm font-medium text-gray-700">Father Name</label>
                            <input type="text" name="fatherName" value="{{ old('fatherName') }}" id="fatherName"
                                class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="Enter father name" required>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" id="email"
                                class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="Enter email address" required>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" id="phone"
                                class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="Enter phone number" maxlength="8" required>
                        </div>

                        <!-- CNIC -->
                        <div class="mb-4">
                            <label for="cnic" class="block text-sm font-medium text-gray-700 mb-1">
                                CNIC Number
                            </label>

                            <input
                                type="text" id="cnic" name="cnic" value="{{ old('cnic') }}" placeholder="12345-6789012-3" value="{{ old('cnic') }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('cnic') border-red-500 @enderror" pattern="[0-9]{5}-[0-9]{6}-[0-9]{1}"
                                title="Enter CNIC in format 12345-6789012-3" maxlength="14" required
                            >

                            @error('cnic')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                            <select name="gender" id="gender"
                                class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- Course -->
                        <div>
                            <label for="course" class="block text-sm font-medium text-gray-700">Course</label>

                            <select name="course_id" id="course"
                                class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 bg-white">
                                <option value="">-- Choose an Institute --</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->courseName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Session -->
                        <div>
                            <label for="session" class="block text-sm font-medium text-gray-700">Session</label>
                            <select name="session_id" id="session"
                                class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">Select Session</option>
                                @foreach ($sessions as $session)
                                <option value="{{ $session->id }}" {{ old('session_id' ?? '') == $session->id ? 'selected' : '' }}>
                                    {{ $session->sessionStart->format('d/m/Y') }}
                                    to
                                    {{ $session->sessionEnd->format('d/m/Y') }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea name="address" id="address" rows="3"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-green-500 focus:border-green-500"
                        placeholder="Enter student's address">{{ old('address') }}</textarea>
                </div>

                <!-- Submit -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-green-600 text-white px-10 py-2 rounded-lg font-semibold text-lg hover:bg-green-700 transition-all duration-300 shadow-md">
                        Save Student
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        const photoInput = document.getElementById('photoInput');
        const previewImage = document.getElementById('previewImage');

        photoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                previewImage.src = URL.createObjectURL(file);
            }
        });

        document.getElementById('cnic').addEventListener('input', function (e) {
            let value = e.target.value.replace(/[^0-9]/g, ''); // keep only digits

            // Format as XXXXX-XXXXXX-X
            if (value.length > 5 && value.length <= 11) {
                value = value.slice(0, 5) + '-' + value.slice(5);
            } else if (value.length > 11) {
                value = value.slice(0, 5) + '-' + value.slice(5, 11) + '-' + value.slice(11, 12);
            }
            e.target.value = value;
        });
    </script>
@endsection
