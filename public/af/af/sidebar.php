<?php

return [
    [
        'title' => 'User Panel',
        'role' => 'USER',
        'pages' => [
            [
                'icon' => 'Dashboard',
                'name' => 'Dashboard',
                'path' => '/dashboard',
            ],
            [
                'icon' => 'BioLink',
                'name' => 'Bio Links',
                'path' => '/bio-links',
            ],
            [
                'icon' => 'ShortLink',
                'name' => 'Short Links',
                'path' => '/short-links',
            ],
            [
                'icon' => 'Projects',
                'name' => 'Projects',
                'path' => '/projects',
            ],
            [
                'icon' => 'QRcode',
                'name' => 'QR Codes',
                'path' => '/qrcodes',
            ],
            [
                'icon' => 'Pricing',
                'name' => 'Current Plan',
                'path' => '/current-plan',
            ],
            [
                'icon' => 'Setting',
                'name' => 'Settings',
                'path' => '/settings',
            ],
            [
                'icon' => 'LogOut',
                'name' => 'Log Out',
                'path' => '/logout',
            ],
        ],
    ],
    [
        'title' => 'Admin Panel',
        'role' => 'SUPER-ADMIN',
        'pages' => [
            [
                'icon' => 'Users',
                'name' => 'Users',
                'path' => '/admin/users',
            ],
            [
                'icon' => 'IdCard',
                'name' => 'Subscriptions',
                'path' => '/admin/subscriptions',
            ],
            [
                'icon' => 'Calendar',
                'name' => 'Pricing Plans',
                'path' => '/admin/pricing-plans',
            ],
            [
                'icon' => 'Chat',
                'name' => 'Testimonials',
                'path' => '/admin/testimonials',
            ],
            [
                'icon' => 'Palette',
                'name' => 'Manage Themes',
                'path' => '/admin/manage-themes',
            ],
            [
                'icon' => 'PaymentSettings',
                'name' => 'Payments Setup',
                'path' => '/admin/payments-setup',
            ],
            [
                'icon' => 'Page',
                'name' => 'Custom Page',
                'path' => '/admin/custom-page',
            ],
            [
                'icon' => 'Setting',
                'name' => 'App Settings',
                'path' => '/admin/app-settings',
            ],
            [
                'icon' => 'Control',
                'name' => 'App Control',
                'path' => '/admin/app-control',
            ],
        ],
    ],
];
