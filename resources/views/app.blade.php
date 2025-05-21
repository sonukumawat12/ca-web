<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="canonical" href="{{ url()->current() }}" />

        {{-- Primary Meta Tags --}}
        <title>Best CA Services in India | Tax, GST & Company Registration | Trusted CA Solutions</title>
        <meta name="title" content="Best CA Services in India | Tax, GST & Company Registration | Trusted CA Solutions">
        <meta name="description" content="Expert Chartered Accountancy services in India. Specializing in Income Tax Filing, GST Registration & Returns, Company Registration, Auditing, and Business Advisory. Get professional CA assistance today!">
        <meta name="keywords" content="CA services, chartered accountant, tax filing, GST registration, company registration, business advisory, tax consultant, ITR filing, GST return, company incorporation, accounting services, auditing services, financial consulting, tax planning, business registration, startup registration, income tax return, business compliance, corporate tax, tax advisory">
        <meta name="author" content="Sonu Kumawat">
        <meta name="robots" content="index, follow">
        <meta name="language" content="English">

        {{-- Open Graph / Facebook --}}
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="Professional CA Services | Tax, GST & Company Registration">
        <meta property="og:description" content="Expert Chartered Accountancy services including Income Tax Filing, GST Registration, Company Formation, Auditing & Business Advisory. Professional CA assistance across India.">
        <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
        <meta property="og:site_name" content="Trusted CA Solutions">
        <meta property="og:locale" content="en_IN">

        {{-- Twitter --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="{{ url()->current() }}">
        <meta name="twitter:title" content="Professional CA Services | Tax, GST & Company Registration">
        <meta name="twitter:description" content="Expert Chartered Accountancy services including Income Tax Filing, GST Registration, Company Formation, Auditing & Business Advisory. Professional CA assistance across India.">
        <meta name="twitter:image" content="{{ asset('images/og-image.jpg') }}">

        {{-- Favicon --}}
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#2563eb">
        <meta name="msapplication-TileColor" content="#2563eb">
        <meta name="theme-color" content="#ffffff">

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

        {{-- Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        {{-- Structured Data for Local Business --}}
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "ProfessionalService",
            "name": "Trusted CA Solutions",
            "image": "{{ asset('images/og-image.jpg') }}",
            "description": "Professional Chartered Accountancy services including Income Tax Filing, GST Registration, Company Formation, and Business Advisory.",
            "@id": "{{ url('/') }}",
            "url": "{{ url('/') }}",
            "telephone": "+91-XXXXXXXXXX",
            "priceRange": "₹₹",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Your Street Address",
                "addressLocality": "Your City",
                "postalCode": "XXXXXX",
                "addressCountry": "IN"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": YOUR_LATITUDE,
                "longitude": YOUR_LONGITUDE
            },
            "openingHoursSpecification": {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": [
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday"
                ],
                "opens": "09:00",
                "closes": "18:00"
            },
            "sameAs": [
                "https://www.facebook.com/your-profile",
                "https://www.linkedin.com/your-profile",
                "https://twitter.com/your-profile"
            ],
            "serviceType": [
                "Income Tax Filing",
                "GST Registration & Returns",
                "Company Registration",
                "Business Advisory",
                "Auditing Services",
                "Tax Planning",
                "Financial Consulting"
            ]
        }
        </script>

        {{-- Structured Data for Service --}}
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Service",
            "serviceType": "Chartered Accountancy Services",
            "provider": {
                "@type": "ProfessionalService",
                "name": "Trusted CA Solutions"
            },
            "areaServed": {
                "@type": "Country",
                "name": "India"
            },
            "hasOfferCatalog": {
                "@type": "OfferCatalog",
                "name": "CA Services",
                "itemListElement": [
                    {
                        "@type": "Offer",
                        "itemOffered": {
                            "@type": "Service",
                            "name": "Income Tax Filing",
                            "description": "Professional ITR filing services for individuals and businesses"
                        }
                    },
                    {
                        "@type": "Offer",
                        "itemOffered": {
                            "@type": "Service",
                            "name": "GST Services",
                            "description": "GST registration, returns filing, and compliance"
                        }
                    },
                    {
                        "@type": "Offer",
                        "itemOffered": {
                            "@type": "Service",
                            "name": "Company Registration",
                            "description": "Company incorporation and registration services"
                        }
                    }
                ]
            }
        }
        </script>

        {{-- Dark Mode Script --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';
                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Theme Styles --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }
            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        @routes
        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        <noscript>
            <div class="noscript-warning">
                For the best experience, please enable JavaScript in your browser.
            </div>
        </noscript>
        @inertia
    </body>
</html>
