    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\prodectmodel;
use App\Notifications\SmsNotification;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class prodect extends Controller
{
    public function prodect(Request $request)
{
    log::info($request);

   $valitator=Validator::make($request->all(),[
    'image' => 'required' ,
    'content' =>'required' ,
    'list' =>  'required',
    'category' =>  'required',
    'payment' =>  'required',
    'book' =>  'required',
    'offer'=> 'required'
   ]);
   
    $fileName = null;
    $book = null;

    if ($request->hasFile('image')) {
        $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $fileName);
    }

    if ($request->hasFile('book')) {
        $book = time() . '_' . $request->file('book')->getClientOriginalName();
        $request->file('book')->move(public_path('download'), $book);
    }

    // Log the request data for debugging
    Log::info($request->all());

    $data = prodectmodel::create([
        'image' => $fileName,
        'content' => $request->input('content'),
        'list' => $request->input('list'),
        'category' => $request->input('category'),
        'payment' => $request->input('payment'),
        'book' => $book,
        'offer'=>$request->input('offer')
    ]);

    return response()->json($data);
}


public function payment(Request $request ,$id){
    $prodect=prodectmodel::find($id);
    return view('payment',compact('prodect'));
}
public function notification(){
    $name="aaa";
    $mobile_number="1234567890";
    Contact::create([
        'name' => $name,
        'mobile_number' => $mobile_number,
    ]);

    return redirect()->back()->with('success', 'Mobile number saved successfully!');
}
}

