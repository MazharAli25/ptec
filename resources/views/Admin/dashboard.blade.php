@extends('layouts.admin');
@section('page-title', 'Admin Dashboard')

@section('main-content')

            <!-- MAIN -->
            <main class="flex-1 flex flex-col md:ml-64">
                <!-- TOP NAV -->
    
                <x-admin-header />

                <div class="min-h-screen bg-gray-100 p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Card 1 -->
                        <div class="bg-white rounded-lg shadow p-6 text-center border border-gray-200">
                            <div class="flex justify-center mb-3">
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6l4 2" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-4xl font-bold text-gray-800">{{count($students)}}</p>
                            <p class="text-gray-600 mt-1">Total Students</p>
                        </div>
    
                        <!-- Card 2 -->
                        <div class="bg-white rounded-lg shadow p-6 text-center border border-gray-200">
                            <div class="flex justify-center mb-3">
                                <div class="w-12 h-12 rounded-full bg-blue-200 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6l4 2" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-4xl font-bold text-gray-800">{{count($pending)}}</p>
                            <p class="text-gray-600 mt-1">Pending Diplomas</p>
                        </div>
    
                        <!-- Card 3 -->
                        <div class="bg-white rounded-lg shadow p-6 text-center border border-gray-200">
                            <div class="flex justify-center mb-3">
                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6l4 2" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-4xl font-bold text-gray-800">{{count($approved)}}</p>
                            <p class="text-gray-600 mt-1">Diplomas Issued</p>
                        </div>
    
                        <!-- Card 4 -->
                        <div class="bg-white rounded-lg shadow p-6 text-center border border-gray-200 relative">
                            <span class="absolute top-2 left-2 bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded">Click to Pay</span>
                            <div class="flex justify-center mb-3 mt-3">
                                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6l4 2" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-4xl font-bold text-gray-800">0</p>
                            <p class="text-gray-600 mt-1">Fee Dues (PKR)</p>
                        </div>
    
                        <!-- Card 5 -->
                        <div class="bg-white rounded-lg shadow p-6 text-center border border-gray-200">
                            <div class="flex justify-center mb-3">
                                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6l4 2" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-4xl font-bold text-gray-800">0</p>
                            <p class="text-gray-600 mt-1">Unverified Fee (PKR)</p>
                        </div>
    
                        <!-- Card 6 -->
                        <div class="bg-white rounded-lg shadow p-6 text-center border border-gray-200">
                            <div class="flex justify-center mb-3">
                                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6l4 2" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-4xl font-bold text-gray-800">0</p>
                            <p class="text-gray-600 mt-1">Verified Fee (PKR)</p>
                        </div>
                    </div>
    
                </div>
    
            </main>

@endsection