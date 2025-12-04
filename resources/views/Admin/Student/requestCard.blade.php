@extends('layouts.admin')
@section('page-title', 'Request For Student Card')

@section('main-content')

    <div class="flex justify-center ml-[12vw] mt-10">
        <div class="overflow-x-auto w-[80%]">
            <h2 class="text-2xl font-semibold text-center mb-5">Students Assigned to Diplomas</h2>

            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-cyan-600 text-white">
                    <tr>
                        <th class="py-2.5 px-4 text-center font-semibold">Student ID</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Student Name</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Father Name</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Diploma</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Session</th>
                        <th class="py-2.5 px-4 text-center font-semibold">Action</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700 divide-y divide-gray-200 text-center">
                    @forelse ($studentDiplomas as $sd)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-2.5 px-4">{{ $sd->student->id }}</td>
                            <td class="py-2.5 px-4">{{ $sd->student->name }}</td>
                            <td class="py-2.5 px-4">{{ $sd->student->fatherName }}</td>
                            <td class="py-2.5 px-4 font-semibold">{{ $sd->diploma->DiplomaName ?? 'N/A' }}</td>
                            <td class="py-2.5 px-4 font-semibold">{{ $sd->diploma->session->session ?? 'N/A' }}</td>
                            <td class="py-2.5 px-4">
                                <form action="{{ route('card.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="student_id" value="{{ $sd->student->id }}">
                                    <input type="hidden" name="diploma_id" value="{{ $sd->diploma->id }}">
                                    <input type="hidden" name="session_id" value="{{ $sd->diploma->session->id }}">

                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                        Request ID Card
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-gray-400 font-medium text-center">
                                No students with assigned diplomas found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
