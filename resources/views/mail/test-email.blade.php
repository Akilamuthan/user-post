<!DOCTYPE html>
<html>
<head>
    <title>Test Email</title>
</head>
<body>
    <h1>Hello!</h1>
    <p>Thank you for " {{$user->name}} " purchase.</p>
    <img src="images{{$name->image}}" alt="error network" width="500" height="500">
    <p>Product Name : {{$name->content}}</p>
    <p>Category     : {{$name->category}}</p>
    Download    : <a href="{{$name->book}}">{{$name->book}}</a>
    
    @if($name->offer=="0")
    <p>Payment      : {{$name->paymen}}</p>
       
    @else
    <p>Payment      : {{$name->payment-$name->offer}}</p>
    @endif
   

    
</body>
</html>
