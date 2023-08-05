<!-- resources/views/vendor/pagination/tailwind.blade.php -->

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center">
        <ul class="flex items-center space-x-4">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="px-2 py-1 text-gray-500 bg-gray-200 rounded-lg">
                    <span aria-disabled="true">Previous</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-2 py-1 text-blue-500 bg-white rounded-lg">
                        Previous
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="px-2 py-1 text-gray-500 bg-gray-200 rounded-lg" aria-disabled="true">
                        <span>{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-2 py-1 text-white bg-blue-500 rounded-lg" aria-current="page">
                                <span>{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="px-2 py-1 text-blue-500 bg-white rounded-lg">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-2 py-1 text-blue-500 bg-white rounded-lg">
                        Next
                    </a>
                </li>
            @else
                <li class="px-2 py-1 text-gray-500 bg-gray-200 rounded-lg" aria-disabled="true">
                    <span aria-disabled="true">Next</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
