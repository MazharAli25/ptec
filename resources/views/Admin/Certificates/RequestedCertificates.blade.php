@extends('layouts.admin');
@section('page-title', 'Requested Certificates')

@section('main-content')

    <div class="flex justify-center ml-[15vw] mt-10">
        <div class="overflow-x-auto w-[80%]">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-cyan-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-center font-semibold">ID</th>
                        <th class="py-3 px-4 text-center font-semibold">Student Name</th>
                        <th class="py-3 px-4 text-center font-semibold">Diploma</th>
                        <th class="py-3 px-4 text-center font-semibold">Session</th>
                        <th class="py-3 px-4 text-center font-semibold">Status</th>
                        <th class="py-3 px-4 text-center font-semibold">Actions</th>

                    </tr>
                </thead>

                <tbody class="text-gray-700 divide-y divide-gray-200 text-center">
                    <!-- Example Row -->
                    @if ($requests)
                        @foreach ($requests as $certificate)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4">{{ $certificate->student->id }}</td>
                                <td class="py-3 px-4">{{ $certificate->student->name }}</td>
                                <td class="py-3 px-4">{{ $certificate->diploma->DiplomaName }}</td>
                                <td class="py-3 px-4">{{ $certificate->session->session }}</td>
                                <td class="py-3 px-4 text-green-600 font-semibold">
                                    <span
                                        class="inline-flex items-center px-2 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors no-underline {{ $certificate->status === 'pending' ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }}">
                                        {{-- <i class="fas fa-edit text-base"></i> --}}
                                        {{ ucFirst($certificate->status) }}
                                </span>
                                </td>


                                <td class="py-3 px-4 text-green-600 font-semibold">
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
                                No Requests Found!
                            </td>
                        </tr>
                        
                    @endif


                </tbody>
            </table>
        </div>
    </div>



@endsection
