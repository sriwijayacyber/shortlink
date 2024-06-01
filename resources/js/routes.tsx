const routes = [
   {
      slug: "user_panel",
      title: "User Panel",
      role: "USER",
      pages: [
         {
            slug: "dashboard",
            icon: "Dashboard",
            name: "Dashboard",
            path: "/dashboard",
         },
         {
            slug: "bio_links",
            icon: "BioLink",
            name: "Bio Links",
            path: "/bio-links",
         },
         {
            slug: "short_links",
            icon: "ShortLink",
            name: "Short Links",
            path: "/short-links",
         },
         {
            slug: "projects",
            icon: "Projects",
            name: "Projects",
            path: "/projects",
         },
         {
            slug: "qr_codes",
            icon: "QRcode",
            name: "QR Codes",
            path: "/qrcodes",
         },
         {
            slug: "current_plan",
            icon: "Pricing",
            name: "Current Plan",
            path: "/current-plan",
         },
         {
            slug: "settings",
            icon: "Setting",
            name: "Settings",
            path: "/settings",
         },
         {
            slug: "log_out",
            icon: "LogOut",
            name: "Log Out",
            path: "/logout",
         },
      ],
   },
   {
      slug: "admin_panel",
      title: "Admin Panel",
      role: "SUPER-ADMIN",
      pages: [
         {
            slug: "users",
            icon: "Users",
            name: "Users",
            path: "/admin/users",
         },
         {
            slug: "subscriptions",
            icon: "IdCard",
            name: "Subscriptions",
            path: "/admin/subscriptions",
         },
         {
            slug: "pricing_plans",
            icon: "Calendar",
            name: "Pricing Plans",
            path: "/admin/pricing-plans",
         },
         {
            slug: "testimonials",
            icon: "Chat",
            name: "Testimonials",
            path: "/admin/testimonials",
         },
         {
            slug: "manage_themes",
            icon: "Palette",
            name: "Manage Themes",
            path: "/admin/manage-themes",
         },
         {
            slug: "payments_setup",
            icon: "PaymentSettings",
            name: "Payments Setup",
            path: "/admin/payments-setup",
         },
         {
            slug: "custom_page",
            icon: "Page",
            name: "Custom Page",
            path: "/admin/custom-page",
         },
         {
            slug: "app_settings",
            icon: "Setting",
            name: "App Settings",
            path: "/admin/app-settings",
         },
         {
            slug: "translation",
            icon: "Globe",
            name: "Translation",
            path: "/admin/translation",
         },
         {
            slug: "app_control",
            icon: "Control",
            name: "App Control",
            path: "/admin/app-control",
         },
      ],
   },
];

export default routes;
