<?php

<<<<<<< HEAD
declare(strict_types=1);


return [
    /*
     * |--------------------------------------------------------------------------
     * | Languages
     * |--------------------------------------------------------------------------
     * |
     * | This is the array for the languages
     * |
     */
=======
return [
    /*
    |--------------------------------------------------------------------------
    | Languages
    |--------------------------------------------------------------------------
    |
    | This is the array for the languages
    |
    */
>>>>>>> 727968c (.)
    'languages' => [
        'it' => [
            'name' => 'Italiano',
            'script' => 'Latn',
            'native' => 'Italiano',
<<<<<<< HEAD
            'regional' => 'it_IT',
=======
            'regional' => 'it_IT'
>>>>>>> 727968c (.)
        ],
        'en' => [
            'name' => 'English',
            'script' => 'Latn',
            'native' => 'English',
<<<<<<< HEAD
            'regional' => 'en_GB',
        ],
    ],
    /*
     * |--------------------------------------------------------------------------
     * | Language Detection
     * |--------------------------------------------------------------------------
     * |
     * | This is the configuration for the language detection
     * |
     */
=======
            'regional' => 'en_GB'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Language Detection
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the language detection
    |
    */
>>>>>>> 727968c (.)
    'detectBrowserLanguage' => true,
    'detectBrowserLanguageFromAcceptLanguage' => true,
    'detectBrowserLanguageFromAcceptLanguageHeader' => true,
    'detectBrowserLanguageFromSession' => true,
    'detectBrowserLanguageFromCookie' => true,
    'detectBrowserLanguageFromQueryString' => true,
    'detectBrowserLanguageFromRoute' => true,
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Language Selection
     * |--------------------------------------------------------------------------
     * |
     * | This is the configuration for the language selection
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Language Selection
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the language selection
    |
    */
>>>>>>> 727968c (.)
    'hideDefaultLocaleInURL' => false,
    'useAcceptLanguageHeader' => true,
    'useSessionLocale' => true,
    'useCookieLocale' => true,
    'useQueryStringLocale' => true,
    'useRouteLocale' => true,
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Language Redirect
     * |--------------------------------------------------------------------------
     * |
     * | This is the configuration for the language redirect
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Language Redirect
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the language redirect
    |
    */
>>>>>>> 727968c (.)
    'redirectToDefaultLocale' => true,
    'redirectToDefaultLocaleIfNotSupported' => true,
    'redirectToDefaultLocaleIfNotInSupportedLocales' => true,
    'redirectToDefaultLocaleIfNotInSupportedLocalesAndNotInAcceptLanguage' => true,
    'redirectToDefaultLocaleIfNotInSupportedLocalesAndNotInAcceptLanguageHeader' => true,
    'redirectToDefaultLocaleIfNotInSupportedLocalesAndNotInSession' => true,
    'redirectToDefaultLocaleIfNotInSupportedLocalesAndNotInCookie' => true,
    'redirectToDefaultLocaleIfNotInSupportedLocalesAndNotInQueryString' => true,
    'redirectToDefaultLocaleIfNotInSupportedLocalesAndNotInRoute' => true,
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Language Routes
     * |--------------------------------------------------------------------------
     * |
     * | This is the configuration for the language routes
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Language Routes
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the language routes
    |
    */
>>>>>>> 727968c (.)
    'useLocalizedRoutes' => true,
    'useLocalizedRoutesInMiddleware' => true,
    'useLocalizedRoutesInController' => true,
    'useLocalizedRoutesInView' => true,
    'useLocalizedRoutesInRedirect' => true,
    'useLocalizedRoutesInUrl' => true,
    'useLocalizedRoutesInRoute' => true,
    'useLocalizedRoutesInRouteModelBinding' => true,
    'useLocalizedRoutesInRouteModelBindingWithSlug' => true,
    'useLocalizedRoutesInRouteModelBindingWithSlugAndLocale' => true,
    'useLocalizedRoutesInRouteModelBindingWithSlugAndLocaleAndFallback' => true,
    'useLocalizedRoutesInRouteModelBindingWithSlugAndLocaleAndFallbackAndRedirect' => true,
    'useLocalizedRoutesInRouteModelBindingWithSlugAndLocaleAndFallbackAndRedirectAndSession' => true,
    'useLocalizedRoutesInRouteModelBindingWithSlugAndLocaleAndFallbackAndRedirectAndSessionAndCookie' => true,
    'useLocalizedRoutesInRouteModelBindingWithSlugAndLocaleAndFallbackAndRedirectAndSessionAndCookieAndQueryString' => true,
    'useLocalizedRoutesInRouteModelBindingWithSlugAndLocaleAndFallbackAndRedirectAndSessionAndCookieAndQueryStringAndRoute' => true,
];
