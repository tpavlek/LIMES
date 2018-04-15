<div class="mx-4">
    <div class="relative">

        @if ($post->hasImage())
            <div class="h-64 bg-cover bg-center" style='background-image: url("{{ $post->getImage() }}");'></div>
        @endif
        <div class="@if($post->hasImage()) pin-b -mb-8 @else pin-t -mt-6 @endif border-green-dark shadow border-2 absolute pin-l ml-4 h-16 w-16 rounded-full text-center inline z-40 bg-center bg-cover" style='background-image: url("{{ $post->author->getImage() }}");'>
        </div>
    </div>

    <div class="border-b border-l border-r shadow bg-white mb-8 z-10">
        <div class="pt-2 text-sm font-bold tracking-wide text-grey-darker" style="margin-left:6rem;">{{ strtoupper($post->author->name) }}</div>
        <p class="p-4 text-left leading-loose">
            {{ $post->body }}
        </p>

        @if($post->isConnectable())
            <div class="text-right">
                <form action="{{route('add_connection', ['id' => $post->author->id])}}" method="post">
                    {{csrf_field()}}
                    <button type="submit" class="text-grey-darker p-2 border-l border-t rounded shadow"><span class="fas fa-link"></span></button>
                </form>
            </div>
        @endif

    </div>
</div>
