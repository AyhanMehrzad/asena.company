<?php
session_start();

// Read amount ONLY from session — GET parameters are never trusted
if (empty($_SESSION['pending_order']) || empty($_SESSION['pay_nonce'])) {
    header('Location: cart.php');
    exit;
}

$amount = (int)($_SESSION['pending_order']['total_amount'] ?? 0);
$nonce  = $_SESSION['pay_nonce'];

if ($amount <= 0) {
    header('Location: cart.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درگاه پرداخت آزمایشی</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap');
        body { font-family: 'Vazirmatn', sans-serif; background-color: #f3f4f6; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md text-center">
        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 text-blue-600 text-3xl font-bold">💳</div>
        <h1 class="text-2xl font-bold mb-2">درگاه پرداخت آزمایشی</h1>
        <p class="text-gray-500 mb-8">شبیه‌ساز درگاه بانکی (زرین‌پال)</p>

        <div class="bg-gray-50 p-4 rounded-xl mb-8 border border-gray-100">
            <p class="text-gray-600 mb-1">مبلغ قابل پرداخت:</p>
            <p class="text-3xl font-bold text-gray-800"><?= number_format($amount) ?> <span class="text-sm font-normal">تومان</span></p>
        </div>

        <div class="space-y-4">
            <!-- Success: POST with nonce so complete_payment can verify it -->
            <form action="actions/complete_payment.php" method="POST">
                <input type="hidden" name="pay_nonce" value="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="result" value="success">
                <button type="submit" class="block w-full bg-green-600 text-white py-3 rounded-xl font-bold hover:bg-green-700 transition-colors">
                    پرداخت موفق (شبیه‌سازی موفقیت)
                </button>
            </form>

            <!-- Failure: POST with nonce as well -->
            <form action="actions/complete_payment.php" method="POST">
                <input type="hidden" name="pay_nonce" value="<?= htmlspecialchars($nonce, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="result" value="failed">
                <button type="submit" class="block w-full bg-red-600 text-white py-3 rounded-xl font-bold hover:bg-red-700 transition-colors">
                    انصراف از پرداخت (شبیه‌سازی خطا)
                </button>
            </form>
        </div>
    </div>
</body>
</html>
