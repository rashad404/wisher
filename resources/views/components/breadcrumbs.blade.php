<ul class="flex items-center space-x-2 text-sm text-gray-600">
    @foreach($links as $link)
        @if (!$loop->last)
            <li>
                <a href="{{ $link['url'] }}" class="hover:underline text-indigo-600">{{ $link['label'] }}</a>
                <svg class="inline-block h-4 w-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </li>
        @else
            <li class="text-gray-500">{{ $link['label'] }}</li>
        @endif
    @endforeach
</ul>
