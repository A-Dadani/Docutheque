<x-layout>
    @unless (count($messages) == 0)
        @foreach ($messages as $msg)
            <h1 class="mb-1 mx-2">{{ $msg->full_name }}</h1>
            <h1 class="mb-1 mx-2">{{ $msg->objet }}</h1>
            <h1 class="mb-1 mx-2">{{ $msg->email }}</h1>
            <h1 class="mb-1 mx-2">{{ $msg->message }}</h1>
            <hr>
        @endforeach
    @else
    @endunless
</x-layout>
