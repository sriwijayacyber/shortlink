<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Email Verification</title>

        <style>
            *,
            ::before,
            ::after {
               box-sizing: border-box;
               /* 1 */
               border-width: 0;
               /* 2 */
               border-style: solid;
               /* 2 */
               border-color: #e5e7eb;
               /* 2 */
            }
         
            ::before,
            ::after {
               --tw-content: "";
            }
         
            /*
            1. Use a consistent sensible line-height in all browsers.
            2. Prevent adjustments of font size after orientation changes in iOS.
            3. Use a more readable tab size.
            4. Use the user's configured `sans` font-family by default.
            5. Use the user's configured `sans` font-feature-settings by default.
            6. Use the user's configured `sans` font-variation-settings by default.
            */
         
            html {
               line-height: 1.5;
               /* 1 */
               -webkit-text-size-adjust: 100%;
               /* 2 */
               -moz-tab-size: 4;
               /* 3 */
               tab-size: 4;
               /* 3 */
               font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont,
                  "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif,
                  "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol",
                  "Noto Color Emoji";
               /* 4 */
               font-feature-settings: normal;
               /* 5 */
               font-variation-settings: normal;
               /* 6 */
            }
         
            /*
            1. Remove the margin in all browsers.
            2. Inherit line-height from `html` so users can set them as a class directly on the `html` element.
            */
         
            body {
               margin: 0;
               /* 1 */
               line-height: inherit;
               /* 2 */
            }
         
            /*
            1. Add the correct height in Firefox.
            2. Correct the inheritance of border color in Firefox. (https://bugzilla.mozilla.org/show_bug.cgi?id=190655)
            3. Ensure horizontal rules are visible by default.
            */
         
            hr {
               height: 0;
               /* 1 */
               color: inherit;
               /* 2 */
               border-top-width: 1px;
               /* 3 */
            }
         
            /*
            Add the correct text decoration in Chrome, Edge, and Safari.
            */
         
            abbr:where([title]) {
               -webkit-text-decoration: underline dotted;
               text-decoration: underline dotted;
            }
         
            /*
            Remove the default font size and weight for headings.
            */
         
            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
               font-size: inherit;
               font-weight: inherit;
            }
         
            /*
            Reset links to optimize for opt-in styling instead of opt-out.
            */
         
            a {
               color: inherit;
               text-decoration: inherit;
            }
         
            /*
            Add the correct font weight in Edge and Safari.
            */
         
            b,
            strong {
               font-weight: bolder;
            }
         
            /*
            1. Use the user's configured `mono` font family by default.
            2. Correct the odd `em` font sizing in all browsers.
            */
         
            code,
            kbd,
            samp,
            pre {
               font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas,
                  "Liberation Mono", "Courier New", monospace;
               /* 1 */
               font-size: 1em;
               /* 2 */
            }
         
            /*
            Add the correct font size in all browsers.
            */
         
            small {
               font-size: 80%;
            }
         
            /*
            Prevent `sub` and `sup` elements from affecting the line height in all browsers.
            */
         
            sub,
            sup {
               font-size: 75%;
               line-height: 0;
               position: relative;
               vertical-align: baseline;
            }
         
            sub {
               bottom: -0.25em;
            }
         
            sup {
               top: -0.5em;
            }
         
            /*
            1. Remove text indentation from table contents in Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=999088, https://bugs.webkit.org/show_bug.cgi?id=201297)
            2. Correct table border color inheritance in all Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=935729, https://bugs.webkit.org/show_bug.cgi?id=195016)
            3. Remove gaps between table borders by default.
            */
         
            table {
               text-indent: 0;
               /* 1 */
               border-color: inherit;
               /* 2 */
               border-collapse: collapse;
               /* 3 */
            }
         
            /*
            1. Change the font styles in all browsers.
            2. Remove the margin in Firefox and Safari.
            3. Remove default padding in all browsers.
            */
         
            button,
            input,
            optgroup,
            select,
            textarea {
               font-family: inherit;
               /* 1 */
               font-feature-settings: inherit;
               /* 1 */
               font-variation-settings: inherit;
               /* 1 */
               font-size: 100%;
               /* 1 */
               font-weight: inherit;
               /* 1 */
               line-height: inherit;
               /* 1 */
               color: inherit;
               /* 1 */
               margin: 0;
               /* 2 */
               padding: 0;
               /* 3 */
            }
         
            /*
            Remove the inheritance of text transform in Edge and Firefox.
            */
         
            button,
            select {
               text-transform: none;
            }
         
            /*
            1. Correct the inability to style clickable types in iOS and Safari.
            2. Remove default button styles.
            */
         
            button,
            [type="button"],
            [type="reset"],
            [type="submit"] {
               -webkit-appearance: button;
               /* 1 */
               background-color: transparent;
               /* 2 */
               background-image: none;
               /* 2 */
            }
         
            /*
            Use the modern Firefox focus style for all focusable elements.
            */
         
            :-moz-focusring {
               outline: auto;
            }
         
            /*
            Remove the additional `:invalid` styles in Firefox. (https://github.com/mozilla/gecko-dev/blob/2f9eacd9d3d995c937b4251a5557d95d494c9be1/layout/style/res/forms.css#L728-L737)
            */
         
            :-moz-ui-invalid {
               box-shadow: none;
            }
         
            /*
            Add the correct vertical alignment in Chrome and Firefox.
            */
         
            progress {
               vertical-align: baseline;
            }
         
            /*
            Correct the cursor style of increment and decrement buttons in Safari.
            */
         
            ::-webkit-inner-spin-button,
            ::-webkit-outer-spin-button {
               height: auto;
            }
         
            /*
            1. Correct the odd appearance in Chrome and Safari.
            2. Correct the outline style in Safari.
            */
         
            [type="search"] {
               -webkit-appearance: textfield;
               /* 1 */
               outline-offset: -2px;
               /* 2 */
            }
         
            /*
            Remove the inner padding in Chrome and Safari on macOS.
            */
         
            ::-webkit-search-decoration {
               -webkit-appearance: none;
            }
         
            /*
            1. Correct the inability to style clickable types in iOS and Safari.
            2. Change font properties to `inherit` in Safari.
            */
         
            ::-webkit-file-upload-button {
               -webkit-appearance: button;
               /* 1 */
               font: inherit;
               /* 2 */
            }
         
            /*
            Add the correct display in Chrome and Safari.
            */
         
            summary {
               display: list-item;
            }
         
            /*
            Removes the default spacing and border for appropriate elements.
            */
         
            blockquote,
            dl,
            dd,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            hr,
            figure,
            p,
            pre {
               margin: 0;
            }
         
            fieldset {
               margin: 0;
               padding: 0;
            }
         
            legend {
               padding: 0;
            }
         
            ol,
            ul,
            menu {
               list-style: none;
               margin: 0;
               padding: 0;
            }
         
            /*
            Reset default styling for dialogs.
            */
         
            dialog {
               padding: 0;
            }
         
            /*
            Prevent resizing textareas horizontally by default.
            */
         
            textarea {
               resize: vertical;
            }
         
            /*
            1. Reset the default placeholder opacity in Firefox. (https://github.com/tailwindlabs/tailwindcss/issues/3300)
            2. Set the default placeholder color to the user's configured gray 400 color.
            */
         
            input::placeholder,
            textarea::placeholder {
               opacity: 1;
               /* 1 */
               color: #9ca3af;
               /* 2 */
            }
         
            /*
            Set the default cursor for buttons.
            */
         
            button,
            [role="button"] {
               cursor: pointer;
            }
         
            /*
            Make sure disabled buttons don't get the pointer cursor.
            */
         
            :disabled {
               cursor: default;
            }
         
            /*
            1. Make replaced elements `display: block` by default. (https://github.com/mozdevs/cssremedy/issues/14)
            2. Add `vertical-align: middle` to align replaced elements more sensibly by default. (https://github.com/jensimmons/cssremedy/issues/14#issuecomment-634934210)
            This can trigger a poorly considered lint error in some tools but is included by design.
            */
         
            img,
            svg,
            video,
            canvas,
            audio,
            iframe,
            embed,
            object {
               display: block;
               /* 1 */
               vertical-align: middle;
               /* 2 */
            }
         
            /*
            Constrain images and videos to the parent width and preserve their intrinsic aspect ratio. (https://github.com/mozdevs/cssremedy/issues/14)
            */
         
            img,
            video {
               max-width: 100%;
               height: auto;
            }
         
            /* Make elements with the HTML hidden attribute stay hidden by default */
         
            [hidden] {
               display: none;
            }
         
            *,
            ::before,
            ::after {
               --tw-border-spacing-x: 0;
               --tw-border-spacing-y: 0;
               --tw-translate-x: 0;
               --tw-translate-y: 0;
               --tw-rotate: 0;
               --tw-skew-x: 0;
               --tw-skew-y: 0;
               --tw-scale-x: 1;
               --tw-scale-y: 1;
               --tw-pan-x: ;
               --tw-pan-y: ;
               --tw-pinch-zoom: ;
               --tw-scroll-snap-strictness: proximity;
               --tw-gradient-from-position: ;
               --tw-gradient-via-position: ;
               --tw-gradient-to-position: ;
               --tw-ordinal: ;
               --tw-slashed-zero: ;
               --tw-numeric-figure: ;
               --tw-numeric-spacing: ;
               --tw-numeric-fraction: ;
               --tw-ring-inset: ;
               --tw-ring-offset-width: 0px;
               --tw-ring-offset-color: #fff;
               --tw-ring-color: rgb(59 130 246 / 0.5);
               --tw-ring-offset-shadow: 0 0 #0000;
               --tw-ring-shadow: 0 0 #0000;
               --tw-shadow: 0 0 #0000;
               --tw-shadow-colored: 0 0 #0000;
               --tw-blur: ;
               --tw-brightness: ;
               --tw-contrast: ;
               --tw-grayscale: ;
               --tw-hue-rotate: ;
               --tw-invert: ;
               --tw-saturate: ;
               --tw-sepia: ;
               --tw-drop-shadow: ;
               --tw-backdrop-blur: ;
               --tw-backdrop-brightness: ;
               --tw-backdrop-contrast: ;
               --tw-backdrop-grayscale: ;
               --tw-backdrop-hue-rotate: ;
               --tw-backdrop-invert: ;
               --tw-backdrop-opacity: ;
               --tw-backdrop-saturate: ;
               --tw-backdrop-sepia: ;
            }
         
            ::backdrop {
               --tw-border-spacing-x: 0;
               --tw-border-spacing-y: 0;
               --tw-translate-x: 0;
               --tw-translate-y: 0;
               --tw-rotate: 0;
               --tw-skew-x: 0;
               --tw-skew-y: 0;
               --tw-scale-x: 1;
               --tw-scale-y: 1;
               --tw-pan-x: ;
               --tw-pan-y: ;
               --tw-pinch-zoom: ;
               --tw-scroll-snap-strictness: proximity;
               --tw-gradient-from-position: ;
               --tw-gradient-via-position: ;
               --tw-gradient-to-position: ;
               --tw-ordinal: ;
               --tw-slashed-zero: ;
               --tw-numeric-figure: ;
               --tw-numeric-spacing: ;
               --tw-numeric-fraction: ;
               --tw-ring-inset: ;
               --tw-ring-offset-width: 0px;
               --tw-ring-offset-color: #fff;
               --tw-ring-color: rgb(59 130 246 / 0.5);
               --tw-ring-offset-shadow: 0 0 #0000;
               --tw-ring-shadow: 0 0 #0000;
               --tw-shadow: 0 0 #0000;
               --tw-shadow-colored: 0 0 #0000;
               --tw-blur: ;
               --tw-brightness: ;
               --tw-contrast: ;
               --tw-grayscale: ;
               --tw-hue-rotate: ;
               --tw-invert: ;
               --tw-saturate: ;
               --tw-sepia: ;
               --tw-drop-shadow: ;
               --tw-backdrop-blur: ;
               --tw-backdrop-brightness: ;
               --tw-backdrop-contrast: ;
               --tw-backdrop-grayscale: ;
               --tw-backdrop-hue-rotate: ;
               --tw-backdrop-invert: ;
               --tw-backdrop-opacity: ;
               --tw-backdrop-saturate: ;
               --tw-backdrop-sepia: ;
            }
         
            .relative {
               position: relative;
            }
         
            .mx-auto {
               margin-left: auto;
               margin-right: auto;
            }
         
            .my-6 {
               margin-top: 1.5rem;
               margin-bottom: 1.5rem;
            }
         
            .mb-4 {
               margin-bottom: 1rem;
            }
         
            .mb-8 {
               margin-bottom: 2rem;
            }
         
            .mt-2 {
               margin-top: 0.5rem;
            }
         
            .flex {
               display: flex;
            }
         
            .h-20 {
               height: 5rem;
            }
         
            .min-h-screen {
               min-height: 100vh;
            }
         
            .w-20 {
               width: 5rem;
            }
         
            .w-full {
               width: 100%;
            }
         
            .max-w-xl {
               max-width: 36rem;
            }
         
            .flex-col {
               flex-direction: column;
            }
         
            .justify-center {
               justify-content: center;
            }
         
            .rounded-lg {
               border-radius: 0.5rem;
            }
         
            .rounded-md {
               border-radius: 0.375rem;
            }
         
            .border {
               border-width: 1px;
            }
         
            .border-y {
               border-top-width: 1px;
               border-bottom-width: 1px;
            }
         
            .border-gray-200 {
               --tw-border-opacity: 1;
               border-color: rgb(229 231 235 / var(--tw-border-opacity));
            }
         
            .bg-gray-50 {
               --tw-bg-opacity: 1;
               background-color: rgb(249 250 251 / var(--tw-bg-opacity));
            }
         
            .bg-blue-500 {
               --tw-bg-opacity: 1;
               background-color: rgb(33 150 243 / var(--tw-bg-opacity));
            }
         
            .bg-white {
               --tw-bg-opacity: 1;
               background-color: rgb(255 255 255 / var(--tw-bg-opacity));
            }
         
            .px-4 {
               padding-left: 1rem;
               padding-right: 1rem;
            }
         
            .px-6 {
               padding-left: 1.5rem;
               padding-right: 1.5rem;
            }
         
            .py-2 {
               padding-top: 0.5rem;
               padding-bottom: 0.5rem;
            }
         
            .py-2\.5 {
               padding-top: 0.625rem;
               padding-bottom: 0.625rem;
            }
         
            .py-6 {
               padding-top: 1.5rem;
               padding-bottom: 1.5rem;
            }
         
            .py-8 {
               padding-top: 2rem;
               padding-bottom: 2rem;
            }
         
            .pt-6 {
               padding-top: 1.5rem;
            }
         
            .text-center {
               text-align: center;
            }
         
            .text-2xl {
               font-size: 1.5rem;
               line-height: 2rem;
            }
         
            .font-medium {
               font-weight: 500;
            }
         
            .text-gray-600 {
               --tw-text-opacity: 1;
               color: rgb(75 85 99 / var(--tw-text-opacity));
            }
         
            .text-gray-700 {
               --tw-text-opacity: 1;
               color: rgb(55 65 81 / var(--tw-text-opacity));
            }
         
            .text-gray-900 {
               --tw-text-opacity: 1;
               color: rgb(17 24 39 / var(--tw-text-opacity));
            }
         
            .text-white {
               --tw-text-opacity: 1;
               color: rgb(255 255 255 / var(--tw-text-opacity));
            }
         
            .shadow {
               --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
               --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color),
                  0 1px 2px -1px var(--tw-shadow-color);
               box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
                  var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }
         
            .shadow-md {
               --tw-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1),
                  0 2px 4px -2px rgb(0 0 0 / 0.1);
               --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color),
                  0 2px 4px -2px var(--tw-shadow-color);
               box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
                  var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }
         
            .shadow-blue-300 {
               --tw-shadow-color: #64b5f6;
               --tw-shadow: var(--tw-shadow-colored);
            }
         
            .hover\:bg-blue-600\/90:hover {
               background-color: rgb(30 136 229 / 0.9);
            }
                     
            @media (min-width: 640px) {
               .sm\:py-12 {
                  padding-top: 3rem;
                  padding-bottom: 3rem;
               }
            }
         
            @media (min-width: 768px) {
               .md\:px-6 {
                  padding-left: 1.5rem;
                  padding-right: 1.5rem;
               }
         
               .md\:py-10 {
                  padding-top: 2.5rem;
                  padding-bottom: 2.5rem;
               }
            }
        </style>
    </head>

    <body class="relative flex min-h-screen flex-col justify-center bg-gray-50 px-6 py-6 sm:py-12">
        <img 
            src="{{asset($app->logo)}}" 
            class="w-20 h-20 mx-auto mb-8" 
            alt="{{$app->title}}" 
        />
        <div class="relative bg-white px-4 md:px-6 py-8 md:py-10 shadow border border-gray-200 rounded-lg mx-auto max-w-xl w-full">
            <h6 class=" text-2xl font-medium text-center mb-8">
                Verify Email Address
            </h6>
            <div class="py-6 text-gray-700 border-y border-gray-200">
                <p class="text text-gray-900 font-medium mb-4">
                    Hello, {{$user->name}}
                </p>
                <p>
                    Please click the button below to verify your email address.
                </p>
                <div class="flex justify-center my-6">
                    <a 
                        href="{{$url}}" 
                        target="_blank" 
                        class="px-4 py-2.5 bg-blue-500 hover:bg-blue-600/90 text-white roud shadow-md shadow-blue-300 rounded-md"
                    >
                        Verify Email Address
                    </a>
                </div>
                <p>
                    Your email won't be registered or verified if you don't click the confirmation link above. If you received this email by mistake, simply delete it.
                </p>
            </div>
            <div class="pt-6">
                <p class="text-gray-900 font-medium">Regards,</p>
                <p class="text-gray-600 mt-2">{{$app->name}}</p>
            </div>
        </div>
    </body>
</html>
