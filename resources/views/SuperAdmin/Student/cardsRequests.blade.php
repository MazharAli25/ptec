@extends('layouts.superAdmin')
@section('page-title', 'Student Cards Requests')

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
                        <th class="py-3 px-4 text-center font-semibold">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200 text-center">
                    @if ($requests && $requests->count())
                        @foreach ($requests as $card)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4">{{ $card->student->id }}</td>
                                <td class="py-3 px-4">{{ $card->student->name }}</td>
                                <td class="py-3 px-4">{{ $card->diploma->DiplomaName }}</td>
                                <td class="py-3 px-4">{{ $card->session->session }}</td>
                                <td class="py-3 px-4 font-semibold">

                                    <div class="flex flex-row items-center justify-center gap-3 whitespace-nowrap">
                                        {{-- STATUS BADGE --}}
                                        @if ($card->status === 'approved')
                                            <span class="px-3 py-1 rounded bg-green-500 text-white text-sm">Approved</span>
                                        @elseif ($card->status === 'rejected')
                                            <span class="px-3 py-1 rounded bg-red-500 text-white text-sm">Rejected</span>
                                        @else
                                            <span class="px-3 py-1 rounded bg-yellow-500 text-white text-sm">Pending</span>
                                        @endif

                                    </div>
                                <td class="py-3 px-4">
                                    <div class="flex flex-row no-wrap gap-3">
                                        {{-- APPROVE BUTTON --}}
                                        <form action="{{ route('card.update', $card->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit"
                                                class="px-3 py-1 text-sm font-medium rounded
                                                    {{ $card->status === 'approved'
                                                        ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                                                        : 'bg-green-500 text-white hover:bg-green-600' }}"
                                                {{ $card->status === 'approved' ? 'disabled' : '' }}>
                                                Approve
                                            </button>
                                        </form>
    
                                        {{-- REJECT BUTTON --}}
                                        <form action="{{ route('card.update', $card->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit"
                                                class="px-3 py-1 text-sm font-medium rounded
                                                    {{ $card->status === 'rejected'
                                                        ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                                                        : 'bg-red-500 text-white hover:bg-red-600' }}"
                                                {{ $card->status === 'rejected' ? 'disabled' : '' }}>
                                                Reject
                                            </button>
                                        </form>

                                    </div>
                                </td>
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
