@extends('admin.layouts.admin')

@section('title', 'Guide Categories')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-semibold text-gray-900">Guide Categories</h1>
                <p class="mt-2 text-sm text-gray-700">Manage main and sub categories for the guide menu.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ route('admin.guide-categories.create') }}"
                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/90">
                    <i class="bi bi-plus-lg mr-2"></i> Add Category
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mt-4 rounded-md bg-green-50 p-4">{{ session('success') }}</div>
        @endif

        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold">ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Parent</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $cat)
                                    <tr>
                                        <td>{{ $cat->id }}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td>{{ $cat->slug }}</td>
                                        <td>{{ $cat->parent?->name ?? '-' }}</td>
                                        <td>{{ $cat->order }}</td>
                                        <td>
                                            <form action="{{ route('admin.guide-categories.toggle-status', $cat) }}"
                                                method="POST">@csrf @method('PATCH')<button type="submit"
                                                    class="px-2 py-1 text-xs rounded-full {{ $cat->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $cat->is_active ? 'Active' : 'Inactive' }}</button>
                                            </form>
                                        </td>
                                        <td><a href="{{ route('admin.guide-categories.edit', $cat) }}"
                                                class="text-primary">Edit</a> | <form
                                                action="{{ route('admin.guide-categories.destroy', $cat) }}" method="POST"
                                                class="inline" onsubmit="return confirm('Delete?')">@csrf
                                                @method('DELETE')<button type="submit" class="text-red-600">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6">{{ $categories->links() }}</div>
    </div>
@endsection
