{{-- resources/views/student/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Welcome back, {{ auth()->user()->name }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card label="Enrolled"  :value="$stats['enrolled']"  color="indigo"/>
        <x-stat-card label="Active"    :value="$stats['active']"    color="green"/>
        <x-stat-card label="Completed" :value="$stats['completed']" color="yellow"/>
        <x-stat-card label="Dropped"   :value="$stats['dropped']"   color="red"/>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="font-semibold text-gray-700">My courses</h3>
            <a href="{{ route('student.courses.index') }}"
               class="text-sm text-indigo-600 hover:underline">Browse more</a>
        </div>
        <ul class="divide-y divide-gray-100">
            @forelse($enrolments as $enrolment)
            <li class="px-6 py-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-900">
                        {{ $enrolment->course->title }}
                    </p>
                    <p class="text-xs text-gray-500">
                        by {{ $enrolment->course->instructor->name }}
                        · enrolled {{ $enrolment->enrolled_at?->format('d M Y') ?? '—' }}
                    </p>
                </div>
                <x-badge :status="$enrolment->status"/>
            </li>
            @empty
            <li class="px-6 py-4 text-sm text-gray-500">
                You haven't enrolled in any courses yet.
                <a href="{{ route('student.courses.index') }}"
                   class="text-indigo-600 hover:underline ml-1">Browse courses</a>
            </li>
            @endforelse
        </ul>
    </div>
</x-app-layout>