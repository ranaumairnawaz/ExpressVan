<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Checkout</title>
    <style>
        /* Basic styling for loader */
        #loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Hide the form initially */
        #submit {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Loader -->
    <div id="loader"></div>

    <!-- Form -->
    <form id="submit" action="<?php echo e(route('frontend.book.order.checkout.stripe',[$trx,$status])); ?>" method="POST">
        <?php echo csrf_field(); ?>
    </form>

    <script>
        // Automatically submit the form after a short delay
        window.onload = function () {
            document.getElementById('submit').submit();
        };
    </script>
</body>
</html><?php /**PATH D:\xampp\htdocs\express-van\@core\resources\views/frontend/pages/book/checkout.blade.php ENDPATH**/ ?>