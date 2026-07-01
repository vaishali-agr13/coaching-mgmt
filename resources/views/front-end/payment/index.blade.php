<div class="container">

<h2>Payment</h2>

<hr>

<p>

Amount :

₹{{ $order->amount }}

</p>

<form action="{{ route('payment.success',$order->id) }}"
      method="POST">

@csrf

<button class="btn btn-success">

Pay Now

</button>

</form>

</div>