<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "{{ env('RAZORPAY_KEY') }}",
    "amount": "{{ $order->amount }}",
    "currency": "INR",
    "name": "My Store",
    "order_id": "{{ $order->id }}",
    "handler": function (response){
        alert('Payment Successful. Payment ID: ' + response.razorpay_payment_id);
    }
};
var rzp = new Razorpay(options);
rzp.open();
</script>
