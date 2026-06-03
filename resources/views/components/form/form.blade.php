@props(['title', 'description'])


    <div class="flex min-h-[call(100dvd-4rem)] items-center justify-center">
        <div class="w-full max-w-md">
            <div class="text-center">
                <h1 class="text-3xl font-bold tranking-tight">{{$title}}</h1>
                <p class="text-muted-foreground mt-1">{{$description}}</p>
            </div>

            {{$slot}}




    </div>
    </div>



