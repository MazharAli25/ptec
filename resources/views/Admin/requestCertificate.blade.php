@extends('layouts.admin');
@section('page-title', 'Request For Certificate')

@section('main-content')

    <div class="ml-[20vw] flex justify-center">
        <div class="w-[70%] mt-6">

            <h4 class="text-center text-[25px] font-semibold">SEARCH STUDENT</h4>
            <form action="{{ route('admin.requestCertificate') }}" method="GET">
                <div class="mt-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Search Student By Name</label>
                    <div class="flex flex-row gap-3">
                        <input type="text" name="name" id="name"
                            class="mt-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 w-[60%]"
                            placeholder="Enter full name" >
                        <button type="submit" class="bg-green-600 text-white px-3 py-0 rounded text-[14px]">Search</button>
                    </div>
                </div>
                {{-- <div class="mt-3">
                    <label for="fatherName" class="block text-sm font-medium text-gray-700">Search Student By Father
                        Name</label>
                    <div class="flex flex-row gap-3">
                        <input type="text" name="fatherName" value="{{ request('fatherName') }}" id="fatherName"
                            class="mt-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 w-[60%]"
                            placeholder="Enter Father name" >
                        <button type="submit" class="bg-green-600 text-white px-3 py-0 rounded text-[14px]">Search</button>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="email" class="block text-sm font-medium text-gray-700">Search Student By Email</label>
                    <div class="flex flex-row gap-3">
                        <input type="text" name="email" value="{{ request('email') }}" id="email"
                            class="mt-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500 focus:border-green-500 w-[60%]"
                            placeholder="Enter Email" >
                        <button type="submit" class="bg-green-600 text-white px-3 py-0 rounded text-[14px]">Search</button>
                    </div>
                </div> --}}
            </form>
        </div>


    </div>
    <div class="flex justify-center ml-[12vw] mt-10">
        <div class="overflow-x-auto w-[70%]">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-cyan-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-center font-semibold">ID</th>
                        <th class="py-3 px-4 text-center font-semibold">Student Name</th>
                        <th class="py-3 px-4 text-center font-semibold">Father Name</th>
                        <th class="py-3 px-4 text-center font-semibold">Email</th>
                        <th class="py-3 px-4 text-center font-semibold">Status</th>
                        <th class="py-3 px-4 text-center font-semibold">Actions</th>

                    </tr>
                </thead>

                <tbody class="text-gray-700 divide-y divide-gray-200 text-center">
                    <!-- Example Row -->
                    @if ($reqStudents->count())
                        @foreach ($reqStudents as $student)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4">{{$student->id}}</td>
                                <td class="py-3 px-4">{{$student->name}}</td>
                                <td class="py-3 px-4">{{$student->fatherName}}</td>
                                <td class="py-3 px-4">{{$student->email}}</td>
                                <td class="py-3 px-4 text-green-600 font-semibold">Paid</td>

                                
                                <td class="py-3 px-4 text-green-600 font-semibold">
                                    <a href="{{ route('certificate.store', $student->id) }}"
                                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors no-underline">
                                        {{-- <i class="fas fa-edit text-base"></i> --}}
                                        print certificate
                                    </a>

                                    <!-- Delete Link -->
                                    <a href="#"
                                        class="inline-flex items-center px-2 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                                        <i class="fas fa-trash text-base"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else

                        <!-- Empty State -->
                        <tr>
                            <td colspan="6" class="py-12 text-gray-400 font-medium text-center">
                                No fee paid yet!
                            </td>
                        </tr>

                    @endif


                </tbody>
            </table>
        </div>
    </div>



@endsection
