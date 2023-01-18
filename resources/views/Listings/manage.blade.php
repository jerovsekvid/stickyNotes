 {{--<x-layout>
  
    <header>
      <h1 class="text-3xl text-center font-bold my-6 uppercase">
        My notes
      </h1>
    </header>
    <x-card class="p-10">
   <table class="w-full table-auto rounded-sm">
      <tbody>
        @unless($listings->isEmpty())
        @foreach($listings as $listing)
        <tr class="border-gray-300">
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <a href="/listings/{{$listing->id}}"> {{$listing->title}} </a>
          </td>
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <a href="/listings/{{$listing->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                class="fa-solid fa-pen-to-square"></i>
              Edit</a>
          </td>
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <form method="POST" action="/listings/{{$listing->id}}">
              @csrf
              @method('DELETE')
              <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
        @else
        <tr class="border-gray-300">
          <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
            <p class="text-center">No Listings Found</p>
          </td>
        </tr>
        @endunless

      </tbody>
    </table>
    <div class="lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4">

      @unless(count($listings) == 0)
  
      @foreach($listings as $listing)
      <x-listing-card :listing="$listing" />
      @endforeach
  
      @else
      <p>No note found</p>
      @endunless
  
    </div>
  
    <div class="mt-6 p-4">
      {{$listings->links()}}
    </div>

  {{--</x-card>
</x-layout>--}}

{{--<x-layout>
  @if (Auth::check())
  {{--  @include('partials._hero')
  
  <div class="lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4">

    {{$listings->auth()->user ==$listings->user_id }}
    {{}}
    @unless(count($listings) == 0)

    @foreach($listings as $listing)
    <x-listing-card :listing="$listing" />
    @endforeach

    @else
    <p>No note found</p>
    @endunless

  </div>

  <div class="mt-6 p-4">
    {{$listings->links()}}
  </div>
  @endif

  
  
  
</x-layout>--}}



<x-layout>
  @if (!Auth::check())
  {{--  @include('partials._hero')--}}
  @endif
 
  <div class="lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4">
    
    @unless(count($listings) == 0)
    
      @foreach($listings as $listing)
        <x-listing-card :listing="$listing" />
        
      @endforeach
   

    @else
    <p>No note found</p>
    @endunless

  </div>

  <div class="mt-6 p-4">
    {{$listings->links()}}
  </div>
</x-layout>

{{--

@if($listing->user_id == auth()->id())
          <x-listing-card :listing="$listing" />
        @endif

--}}