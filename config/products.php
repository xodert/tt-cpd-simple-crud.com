<?php

return [
    'role' => env('PRODUCT_ROLE', 'user'),
    'email' => env('PRODUCT_NOTIFICATION_EMAIL', 'admin@example.com'),
    'webhook' => env('PRODUCT_WEBHOOK_URL', 'http://webhook.site/your-url'),
];
