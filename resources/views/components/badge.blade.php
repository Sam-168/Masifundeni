
@props(['status'])

@php
$map = [
    'active'    => 'bg-green-100 text-green-800',
    'published' => 'bg-green-100 text-green-800',
    'pending'   => 'bg-yellow-100 text-yellow-800',
    'draft'     => 'bg-yellow-100 text-yellow-800',
    'completed' => 'bg-blue-100 text-blue-800',
    'dropped'   => 'bg-red-100 text-red-800',
    'suspended' => 'bg-red-100 text-red-800',
    'archived'  => 'bg-gray-100 text-gray-700',
    'graduated' => 'bg-purple-100 text-purple-800',
];
$classes = $map[$status] ?? 'bg-gray-100 text-gray-700';
@endphp

<span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $classes }}">
    {{ ucfirst($status) }}
</span>