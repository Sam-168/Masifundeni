{{-- resources/views/admin/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Admin Dashboard</h2>
    </x-slot>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card label="Total students"    :value="$stats['total_students']"    color="indigo"/>
        <x-stat-card label="Total instructors" :value="$stats['total_instructors']" color="green"/>
        <x-stat-card label="Total courses"     :value="$stats['total_courses']"     color="yellow"/>
        <x-stat-card label="Total enrolments"  :value="$stats['total_enrolments']"  color="red"/>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent students --}}
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="font-semibold text-gray-700">Recent students</h3>
                <a href="{{ route('admin.students.index') }}"
                   class="text-sm text-indigo-600 hover:underline">View all</a>
            </div>
            <ul class="divide-y divide-gray-100">
                @foreach($recentStudents as $student)
                <li class="px-6 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $student->name }}</p>
                        <p class="text-xs text-gray-500">{{ $student->email }}</p>
                    </div>
                    @if($student->studentProfile)
                        <x-badge :status="$student->studentProfile->status"/>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>

        {{-- Recent courses --}}
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="font-semibold text-gray-700">Recent courses</h3>
                <a href="{{ route('admin.courses.index') }}"
                   class="text-sm text-indigo-600 hover:underline">View all</a>
            </div>
            <ul class="divide-y divide-gray-100">
                @foreach($recentCourses as $course)
                <li class="px-6 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $course->title }}</p>
                        <p class="text-xs text-gray-500">{{ $course->instructor->name }}</p>
                    </div>
                    <x-badge :status="$course->status"/>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>