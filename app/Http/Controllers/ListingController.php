<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->where('public','like','on')->paginate(100000)
        ]);
    }

    //Show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create Form
    public function create() {
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request) {
       
        $formFields = $request->validate([
            'title' => 'required',
            'tags' =>'nullable',
            'description' => 'required',
            'public'=>'nullable'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
       
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Note created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    

    // Update Listing Data
    public function update(Request $request, Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'tags'=>'nullable',
            'description' => 'required'
        ]);

       

        $listing->update($formFields);

        return back()->with('message', 'Note updated successfully!');
    }

    // Delete Listing
    public function destroy(Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $listing->delete();
        return redirect('/')->with('message', 'Note deleted successfully');
    }

    // Manage Listings
    public function manage() {
       
     // dd(User::query('id'== auth()->id()));
        return view('listings.manage', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->where('user_id','like',auth()->id())->paginate(10000)
        ,'users'=>User::all()]);
        
    }

    //Share Listing
    public function share(Listing $listing) {
        
        return view('listings.share', ['listing' => $listing]);
    }

      // Shared Listings
      public function shared() {
       
        // dd(User::query('id'== auth()->id()));

           //$notes= DB::table('share')->where('user_id','like',auth()->id());
           $notes= DB::table('share')->select('note_id')->where('user_id','=','2')->get();
           // dd($notes);
           $notes2=$notes->toArray();
         // $notes2=$notes->pluck('node_id');
           //dd($notes2[0]);
          // dd([1,2,3]);
         // foreach ($notes2 as $i){
        //    $notes3[$i]=$notes2['note_id'];
        //  }
          //dd($notes3);
           return view('listings.shared', [
               'listings' => Listing::latest()->filter(request(['tag', 'search']))->whereIn('id',[5,6])->paginate(10000)
           ,'users'=>User::all()]);
           
       }

       //Store share
       public function storeShare(Request $request, Listing $listing) {
       
        //dobimo mail komu zelimo shared
        $username=$request->username;
       
        $results2=DB::table('users')->where('email','like',$username )->get();
       
      // if($results2[0]->id == null){
      //  return redirect('/')->with('message', 'Note not shared');
      // }




        //$results = DB::select('SELECT * from users where email like "jerovsek@gmail.com"');
       // $results2=DB::table('users')->where('email','like',$username )->get();
       //dobimo id od userja
       //dd($listing->id);
        //dd($results2[0]->id);
        //DB::insert('insert into users (id, name) values (?, ?)', array(1, 'Dayle'));

        $noteId=$listing->id;
        $userId=$results2[0]->id;

        
        DB::table('share')->insert([
            'user_id' => $userId,
            'note_id' => $noteId
        ]);
        

        //Listing::create($formFields);

        return redirect('/')->with('message', 'Note shared successfully!');
    }
}

