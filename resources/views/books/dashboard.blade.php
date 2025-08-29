<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Books I've Borrowed</h3>
                    
                    @if(session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-4 text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if($borrowedBooks->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Book Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Author</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Borrowed Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Return By</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($borrowedBooks as $borrowedBook)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $borrowedBook->book->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $borrowedBook->book->author }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $borrowedBook->borrowed_at->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $borrowedBook->return_by->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="{{ route('books.return', $borrowedBook) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                        Return Book
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>You haven't borrowed any books yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
