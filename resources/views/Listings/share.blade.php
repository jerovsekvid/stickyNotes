<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
      <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">Edit note</h2>
        <p class="mb-4">Edit: {{$listing->title}}</p>
      </header>
  
      <form method="POST" action="/listings/{{$listing->id}}/share" enctype="multipart/form-data">
        @csrf
        {{--@method('PUT')--}}
       
  
        <div class="mb-6">
          <label for="title" class="inline-block text-lg mb-2">Note title: {{$listing->title}}</label>
         
          @error('title')
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>
  
  
        <div class="mb-6">
          <label for="tags" class="inline-block text-lg mb-2">
            Tags: {{$listing->tags}}
          </label>
         
          @error('tags')
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>
  
       
  
        <div class="mb-6">
          <label for="description" class="inline-block text-lg mb-2">
            Note:
            <p>
                {{$listing->description}}
          </label>
          
  
          @error('description')
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
        </div>

        <div class="mb-6">
            <label for="username" class="inline-block text-lg mb-2">Username</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="username"
              placeholder="Enter username of who you want to share with" value="" />
    
            @error('title')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
          </div>
  
        <div class="mb-6">
          <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
            Share note
          </button>
  
          <a href="/listings/{{$listing->id}}/shared" class="text-black ml-4"> Back </a>
        </div>
      </form>
    </x-card>
  </x-layout>
  