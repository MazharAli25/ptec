@extends('layouts.superAdmin')
@section('page-title', 'Certificates Requests')

@section('main-content')

<div class="flex justify-center ml-[15vw] mt-10">
    <div class="overflow-x-auto w-[80%]">
        <table class="min-w-full divide-y divide-gray-200 institute-table">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-4 text-center font-semibold">ID</th>
                    <th class="py-3 px-4 text-center font-semibold">Student Name</th>
                    <th class="py-3 px-4 text-center font-semibold">Diploma</th>
                    <th class="py-3 px-4 text-center font-semibold">Session</th>
                    <th class="py-3 px-4 text-center font-semibold">Status</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 text-center">
                @if ($requests && $requests->count())
                    @foreach ($requests as $certificate)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4">{{ $certificate->student->id }}</td>
                            <td class="py-3 px-4">{{ $certificate->student->name }}</td>
                            <td class="py-3 px-4">{{ $certificate->diploma->DiplomaName }}</td>
                            <td class="py-3 px-4">{{ $certificate->session->session }}</td>
                            <td class="py-3 px-4 font-semibold">
                                {{-- If status is already approved or rejected --}}
                                @if (in_array($certificate->status, ['approved', 'rejected']))
                                    <span class="inline-flex items-center px-3 py-1.5 rounded text-sm font-medium
                                        {{ $certificate->status === 'approved' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                        {{ ucfirst($certificate->status) }}
                                    </span>
                                @else
                                    {{-- If pending, show Approve/Reject buttons --}}
                                    <div class="flex justify-center gap-2">
                                        <form action="{{ route('certificate.update', $certificate->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600 transition-colors">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('certificate.update', $certificate->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition-colors">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                @endif
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
