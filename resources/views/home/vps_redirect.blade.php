<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to Payment...</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <div class="mb-4">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto"></div>
        </div>
        <h2 class="text-xl font-semibold mb-2">Processing your payment...</h2>
        <p class="text-gray-600 mb-4">Please wait while we redirect you to our secure payment page.</p>
        <p class="text-sm text-gray-500">Order: {{ $paymentForm['orderId'] }}</p>
        <p class="text-sm text-gray-500">Amount: ${{ $paymentForm['amount'] }}</p>
    </div>

    <!-- VPS Payment Form -->
    <form id="vpsPaymentForm" action="{{ $paymentForm['action'] }}" method="POST" style="display: none;">
        <input type="hidden" name="payload" value="{{ $paymentForm['payload'] }}">
        <input type="hidden" name="signature" value="{{ $paymentForm['signature'] }}">
    </form>

    <script>
        // Auto-submit the form after a short delay
        setTimeout(function () {
            document.getElementById('vpsPaymentForm').submit();
        }, 2000);
    </script>

</body>

</html>