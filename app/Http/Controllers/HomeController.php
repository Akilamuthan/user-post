<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\prodectmodel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestEmail;
use App\Models\User;
use App\Models\Report;
use App\Http\Resources\UserCollection;
use App\Models\name;
use App\Models\phone;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $prodect=prodectmodel::all();
        log::info($prodect);
        return view('home',compact('prodect'));
    }
    public function content(){
        log::info("content page access");
        return view('content');
    }
    
    public function prodect(Request $request,$id)
    {
        $productitem=prodectmodel::find($id);
        log::info($productitem);
        return view('prodect',compact('productitem'));
    }


    public function listproduct(){
        $collection=prodectmodel::all();
        return view("listofproduct",compact('collection'));
    }
    public function setting(){
         return view('setting');
    }
    public function paymentDetail(Request $request, $id) {

        $product = prodectmodel::find($id);
        return view('productpayment',compact('product'));
 
       
       
    }
    public function productPayment(Request $request, $id) {

        $userId = $request->id;
        $user = User::find($userId);
    
        // Log user info
        Log::info($user);
    
        // Get email from the request
        $emailId = $request->email;
        Log::info("Attempting to send email to: $emailId");
    
       
    
        // Find the product by ID
        $product = prodectmodel::find($id);
        if (!$product) {
            return redirect()->back()->with('message', 'Product not found.');
        }
        $name=$product;
        // Log the product name for debugging
        Log::info("Sending email for product: $name");
    
        // Send the email
        Mail::to($emailId)->send(new MyTestEmail($name, $user));
    
        // Update product list
        $product->list -= 1;
        $product->save();
        if($name->offer=="0"){
            $payment=$name->payment;
        }else{
            $offer=$name->payment;
            $payments=$name->offer;
            $payment = $offer - $payments;
        }
        Log::info("Product updated: ", [$product]);
        Report::create([
            "user"=>$user->name,
            "prodect"=>$name->content,
            "payment"=>$payment,
        ]);
        // Check if product is sold out
        if ($product->list == 0) {
            $product->delete();
            return redirect('home')->with('message', 'Product sold out, returned to home.');
        } else {
            return redirect()->back()->with('message', 'Successfully purchased.');
        }
    }
    public function report(){
         $report=Report::all();
         log::info($report);
         return view('Report',compact('report'));
    }
    
    public function order(){
        $report=Report::all();
        log::info($report);
        return view('order',compact('report'));
    }

    public function resource()
{
    $phoneId = 1; // Make this dynamic as needed
    $phone = name::find($phoneId); // Fetching the Phone model

    Log::info('Fetched Phone: ', ['phone' => $phone]); // Logging the fetched phone

    if ($phone) {
        $name = $phone->phone; // Fetch associated name
        Log::info('Fetched Name: ', ['name' => $name]); // Logging name details

        return response()->json($name ?: [], 200); // Return name or empty array
    }

    return response()->json(['message' => 'Phone not found'], 404);
}

    
public function search(Request $request) {
    // Validate the input
    $request->validate([
        'content' => 'required|string|max:255',
    ]);

    // Get the content input
    $content = $request->input('content');

    // Query for products with matching content
    $productItems = prodectmodel::where('content', 'LIKE', "%$content%")->get();

    // Check if any products were found
    if ($productItems->isEmpty()) {
        return back();
    }

    // Log the IDs for debugging
    $ids = $productItems->pluck('id'); // Get an array of IDs
    Log::info($ids);

    // Assuming you want to redirect to the first product's route
    return redirect()->route('product', ['id' => $ids->first()]); // Adjust route name as needed
}

  public function categroy(Request $request){
    $categroy=$request->name;
    log::info($request);
    $products = prodectmodel::where('category', 'LIKE', "%$categroy%")->get();


    
    log::info($products);

    return view('categroy', ['prodect' => $products]);

  }   




}
