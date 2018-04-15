
<a class="block h-16 @if($location->hasEvent()) bg-yellow-lightest @else bg-white @endif border-b flex no-underline" href="@if(isset($link_to) && $link_to = 'admin') {{ URL::route('admin.show_location', $location->id) }} @else https://www.google.com/maps/place/{{ $location->lat }},{{ $location->lon }} @endif">
    <div class="inline-block w-1/4 bg-cover bg-center h-full" style='background-image: url("{{ $location->getImage() }}");'>
    </div>
    <div class="inline-block text-grey-darkest flex-grow h-full p-2">
        <h3 class="pb-2">{{ $location->name }}</h3>
        <div class="text-grey-dark text-small font-bold">
            <div class="inline-block px-2">
                <span><i class="fas fa-comment"></i> &nbsp; {{ $location->posts()->count() }}</span>
            </div>
            @if ($location->hasEvent())
                <div class="inline-block px-2 border-l">
                    <span class="fas fa-star"></span> &nbsp; Event!
                </div>

            @endif
        </div>
    </div>
</a>
