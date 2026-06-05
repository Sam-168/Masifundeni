{{-- resources/views/student/progress/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">My Progress</h2>
    </x-slot>

    <div class="space-y-6">
        @forelse($enrolments as $enrolment)
        <div class="bg-white rounded-lg shadow overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-gray-900">{{ $enrolment->course->title }}</h3>
                    <p class="text-sm text-gray-500">{{ $enrolment->course->instructor->name }}</p>
                </div>
                <div class="text-right">
                    <x-badge :status="$enrolment->status"/>
                    <p class="text-sm font-semibold mt-1 text-gray-700">
                        Overall: {{ $enrolment->average_score }}%
                    </p>
                </div>
            </div>

            @if($enrolment->grades->isNotEmpty())
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Assessment</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Out of</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">%</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($enrolment->grades as $grade)
                    <tr>
                        <td class="px-6 py-3 text-sm text-gray-900">{{ $grade->label }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $grade->score }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $grade->max_score }}</td>
                        <td class="px-6 py-3 text-sm text-gray-700">{{ $grade->percentage }}%</td>
                        <td class="px-6 py-3">
                            <span class="font-bold text-sm
                                {{ in_array($grade->letter_grade, ['A','B']) ? 'text-green-600' : '' }}
                                {{ $grade->letter_grade === 'C' ? 'text-yellow-600' : '' }}
                                {{ in_array($grade->letter_grade, ['D','F']) ? 'text-red-600' : '' }}">
                                {{ $grade->letter_grade }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="px-6 py-4 text-sm text-gray-500">No grades recorded yet.</p>
            @endif

        </div>
        @empty
        <div class="bg-white rounded-lg shadow px-6 py-8 text-center text-gray-500">
            You haven't enrolled in any courses.
            <a href="{{ route('student.courses.index') }}"
               class="text-indigo-600 hover:underline ml-1">Browse courses</a>
        </div>
        @endforelse
    </div>
</x-app-layout>