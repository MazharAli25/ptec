@extends('layouts.superAdmin')
@section('page-title', 'Certificates Requests')

@section('main-content')

    <div class="flex justify-center ml-[15vw] mt-10">
        <div class="overflow-x-auto w-[80%]">
            <table class="min-w-full divide-y divide-gray-200 institute-table">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-center font-semibold">ID</th>
                        <th class="py-3 px-4 text-center     font-semibold">Student Name</th>
                        <th class="py-3 px-4 text-center font-semibold">Diploma</th>
                        <th class="py-3 px-4 text-center font-semibold">Session</th>
                        <th class="py-3 px-4 text-center font-semibold">Status</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200 text-center">
                    @if ($certificates && $certificates->count())
                        @foreach ($certificates as $certificate)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4">{{ $certificate->student->id }}</td>
                                <td class="py-3 px-4">{{ $certificate->student->name }}</td>
                                <td class="py-3 px-4">{{ $certificate->diploma->DiplomaName }}</td>
                                <td class="py-3 px-4">{{ $certificate->session->session }}</td>
                                <td class="py-3 px-4 font-semibold ">
                                    {{-- If status is already approved or rejected --}}

                                    <form action="{{ route('superAdmin.printFront', $certificate->id) }}" class="inline-block" method="POST">
                                        @csrf
                                        <input type="hidden" name="diplomaID" value="{{ $certificate->diplomaID }}">
                                        <input type="hidden" name="sessionID" value="{{ $certificate->sessionID }}">
                                        <button type="submit" class="text-[14px] bg-blue-500 text-white px-3 py-1 rounded">
                                            Print Front
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('superAdmin.printFront', $certificate->id) }}" class="inline-block" method="POST">
                                        @csrf
                                        <input type="hidden" name="diplomaID" value="{{ $certificate->diplomaID }}">
                                        <input type="hidden" name="sessionID" value="{{ $certificate->sessionID }}">
                                        <button type="submit" class="text-[14px] bg-blue-500 text-white px-3 py-1 rounded">
                                            Print Back
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
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
