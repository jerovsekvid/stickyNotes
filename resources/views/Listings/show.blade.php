<x-layout>
  <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
  </a>
  <div class="mx-4">
    <x-card class="p-10">
      <div class="flex flex-col items-center justify-center text-center">
        

        <h3 class="text-2xl mb-2">
          {{$listing->title}}
        </h3>
        <div class="text-xl font-bold mb-4">{{$listing->company}}</div>

        <x-listing-tags :tagsCsv="$listing->tags" />

        <div class="text-lg my-4">
          
        </div>
        <div class="border border-gray-200 w-full mb-6"></div>
        <div>
          
          <div class="text-lg space-y-6">
            {{$listing->description}}

           
          </div>
        </div>
      </div>
    </x-card>
    @if($listing->user_id == auth()->id())
     <x-card class="mt-4 p-2 flex space-x-6">
      <a href="/listings/{{$listing->id}}/edit">
        <i class="fa-solid fa-pencil"></i> Edit
      </a>
      <a href="/listings/{{$listing->id}}/share">
        <i class="fa-solid fa-users"></i> Share
      </a>
      <form method="POST" action="/listings/{{$listing->id}}">
        @csrf
        @method('DELETE')
        <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
      </form>
    </x-card> 
    @endif


  </div>
</x-layout>