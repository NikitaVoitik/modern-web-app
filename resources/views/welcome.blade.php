<x-site-layout title="Goida">
    @foreach($articles as $article)
        <div class="mt-4">
            <h1 class="font-bold text-xl">{{$article->title}}</h1>
            <div>
                {{$article->published_at->diffForHumans()}}
                 |
                {{$article->author->name}}
            </div>
            <p class="text-sm"> {{$article->summary()}}</p>
        </div>
    @endforeach
</x-site-layout>
