@extends('layouts.admin')
@section('title', 'Change Account Password')
@section('body-classes', 'bg-gray-100')
@section('main-content')

    <!-- Container -->
    <div class="max-w-5xl bg-white rounded-lg shadow p-6 my-10 ml-70">

        <!-- Title -->
        <h2 class="text-xl font-semibold mb-6">Update Student's  Account Password</h2>
        <!-- User Info Section -->
        <div class="flex flex-col md:flex-row gap-6 items-start mt-[70px]">


            <!-- User Details -->

            <!-- Profile Image -->
            <div class="w-40 h-40 border rounded overflow-hidden">
                <img src="{{ asset('storage/' . $student->image) }}" alt="Profile" class="w-full h-full object-cover">
            </div>

            <form action="{{ route('student.updateStudentAccount', encrypt($student->id)) }}" method="POST">
                @csrf
                <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">User ID</label>
                        <input type="text" value="{{ $student->id }}" readonly
                            class="w-full bg-gray-100 border rounded px-3 py-2 focus:outline-none focus:ring">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Username</label>
                        <input type="text" value="{{ $student->name }}" readonly
                            class="w-full bg-gray-100 border rounded px-3 py-2 focus:outline-none focus:ring">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" value="{{ $student->email }}" readonly
                            class="w-full bg-gray-100 border rounded px-3 py-2 focus:outline-none focus:ring">
                    </div>


                    {{-- Updating Password  --}}
                    <div class="md:col-span-4">
                        <label class="block text-sm font-medium mb-1">Password</label>
                        <input type="password" id="password" name='password'
                            class="w-[75%] border rounded px-3 py-2 focus:outline-none focus:ring"
                            placeholder="New password">
                    </div>
                    <div class="md:col-span-4">
                        <label class="block text-sm font-medium mb-1">Confirm Password</label>
                        <input type="password" id="password" name='password_confirmation'
                            class="w-[75%] border rounded px-3 py-2 focus:outline-none focus:ring"
                            placeholder="Confirm password">
                    </div>


                    <!-- Action Button -->
                    <div class="mt-8 text-center">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                            Save
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
