# A Laravel clone of the Javascript Flatpickr (Date picker) library

[![Latest Version on Packagist](https://img.shields.io/packagist/v/asdh/laravel-flatpickr.svg?style=flat-square)](https://packagist.org/packages/asdh/laravel-flatpickr)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/Laratipsofficial/laravel-flatpickr/run-tests?label=tests)](https://github.com/Laratipsofficial/laravel-flatpickr/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/Laratipsofficial/laravel-flatpickr/Check%20&%20fix%20styling?label=code%20style)](https://github.com/Laratipsofficial/laravel-flatpickr/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/asdh/laravel-flatpickr.svg?style=flat-square)](https://packagist.org/packages/asdh/laravel-flatpickr)

Using this package you can add a beautiful date or datetime picker into your project without touching any javascript with the power or laravel component. It is just a laravel component wrapper for the [Flatpickr](https://flatpickr.js.org/) javascript library.

<p align="center">
    <img src="docs/images/single-picker.png" alt="Laravel Flatpickr" width="300px">
</p>

<p align="center" style="font-size:32px;">Created with ❤️ from Nepal 🇳🇵</p>

## Support

You can support me by subscribing to my [YouTube channel - Laratips](https://www.youtube.com/c/Laratips).

If you want me to continue developing this package and want me to develop other similar packages, then you help me financially by sending few bucks to my [Wise](https://wise.com/invite/ath/ashishd233) account in Nepalese 🇳🇵 currency.

My Wise email: ashish.dhamala2015@gmail.com

If you decide to support me, the please send me your twitter handle in mail so that I can shout-out about you on twitter.

## Installation

You can install the package via composer:

```bash
composer require asdh/laravel-flatpickr
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="flatpickr-config"
```

You can publish the assets with:

```bash
php artisan vendor:publish --tag="flatpickr-assets"
```

This is the contents of the published config file:

```php
return [
    /**
     * The url to be used to serve css file.
     * If null, it will use the one shipped with package.
     */
    'css_url' => env('FLATPICKR_CSS_URL', null),

    /**
     * The url to be used to serve js file.
     * If null, it will use the one shipped with package.
     */
    'js_url' => env('FLATPICKR_JS_URL', null),

    /**
     * Determines if the styles shipped with the package should be used.
     * Setting it to false will remove the styling for the component.
     * The flatpickr css will be untouched.
     */
    'use_style' => env('FLATPICKR_USE_STYLE', true),
];
```

## Usage

You need to include the css and js that ships with the package in your html or blade file.

### Adding Css

Include this style at the head section of your page:

```php
@include('flatpickr::components.style')
```

Or you can use laravel blade component syntax:

```html
<x-flatpickr::style />
```

If you want to use different `url` for the css then you can change it from the .env file:

```env
FLATPICKR_CSS_URL=https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.css
```

You can even change the `url` from the component itself:

```html
<x-flatpickr::style
    url="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.css"
/>
```

The `url` passed form the component will take more priority over the config file.

### Adding Js

Similarly include this script at the bottom of your page:

```php
@include('flatpickr::components.script')
```

Or you can use laravel blade component syntax:

```html
<x-flatpickr::script />
```

If you want to use different `url` for the js then you can change it from the .env file:

```env
FLATPICKR_JS_URL=https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js
```

You can even change the `url` from the component itself:

```html
<x-flatpickr::script
    url="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"
/>
```

The `url` passed form the component will take more priority over the config file.

### Using the component

Add it to your page.

```html
<x-flatpickr />
```

Yes, it's that simple. Now you have a beautiful looking date picker in your page without touching a single javascript at all.

<p align="center">
    <img src="docs/images/single-picker.png" alt="Laravel Flatpickr" width="300px">
</p>

## Component props

I have made different `props` for this component that will be converted into the `config` options of the `flatpickr`. Make sure to look into the [config options](https://flatpickr.js.org/options) of the flatpickr.

Most of the description of the props written here are taken from the flatpickr documentation page.

### id

**Type:** string

Set the id of the component. It will apply id to the underlying `input` tag. If no id is provided, it will use the autogenerated id.

**Example:**

```html
<x-flatpickr id="laravel-flatpickr" />
```

### dateFormat

**Type:** string

A string of characters which are used to define how the date will be displayed in the input box. Please check the [flatpickr documentation](https://flatpickr.js.org/formatting/) page for the supported characters. By default the date format is `Y-m-d` but you can change it to other formats to like `d/m/Y`.

**Example:**

```html
<x-flatpickr date-format="d/m/Y" />
```

### altFormat

**Type:** string

Exactly the same as date format, but for the altInput field. If you want different format to be visible for the user then you can use this. By default it will use the same format as that of `dateFormat`.

**Example:**

```html
<x-flatpickr alt-format="F j, Y" />
```

### minDate

**Type:** string|Carbon

The minimum date that a user can start picking from.

You can pass a `Carbon` instance or a date format in `string` that is supported by `Carbon` or `DateTime`.

**Example:**

```html
<x-flatpickr min-date="2022-02-13" />

OR

<x-flatpickr :min-date="today()" />

OR

<x-flatpickr :min-date="\Carbon\Carbon::parse('2022-02-13')" />
```

### maxDate

**Type:** string|Carbon

The maximum date that a user can pick to.

You can pass a `Carbon` instance or a date format in `string` that is supported by `Carbon` or `DateTime`.

**Example:**

```html
<x-flatpickr max-date="2022-09-18" />

OR

<x-flatpickr :max-date="today()" />

OR

<x-flatpickr :max-date="today()->subDays(20)" />
```

### showTime

**Type:** bool

Shows the time picker.

**Example:**

```html
<x-flatpickr show-time />
```

### timeFormat

**Type:** string

A string of characters which are used to define how the time will be displayed in the input box. Please check the [flatpickr documentation](https://flatpickr.js.org/formatting/) page for the supported characters. By default the time format is `H-i` but you can change it to other formats to like `h:i`.

**Example:**

```html
<x-flatpickr show-time time-format="h:i" />
```

When you use `show-time` prop with `alt-format`, make sure to write both date and time format in the `alt-format` like this:

**Example:**

```html
<x-flatpickr show-time time-format="h:i" alt-format="F j, Y, H:i" />
```

### minTime

**Type:** string

The minimum time that a user can start picking from.

**Example:**

```html
<x-flatpickr show-time min-time="13:25" />
```

### maxTime

**Type:** string

The maximum time that a user can pick to.

**Example:**

```html
<x-flatpickr show-time max-time="23:15" />
```

### time24hr

**Type:** bool

Displays time picker in 24 hour mode without AM/PM selection when enabled. By default it is set to true. To show in 12 hour mode, set it to false.

**Example:**

Displays the time picker in 12 hour mode with am and pm.

```html
<x-flatpickr show-time :time24hr="false" />
```

### firstDayOfWeek

**Type:** int

Sets when the first day of the calendar should start. By default it is 0 (Sunday).

**Example:**

It sets the first day of the week as Monday.

```html
<x-flatpickr :first-day-of-week="1" />
```

### disableWeekend

**Type:** bool

Disable the weekend in the calendar. Saturday and Sunday are disabled.

**Example:**

```html
<x-flatpickr disable-weekend />
```

<p align="center">
    <img src="docs/images/disable-weekend.png" alt="Laravel Flatpickr" width="300px">
</p>

### disable

**Type:** array

Disable the provided dates. It can be array of `date string` or `Carbon`.

**Example:**

```html
<x-flatpickr :disable="['2022-02-13', '2022-02-14']" />

OR

<x-flatpickr :disable="[today(), today()->addDay()]" />
```

### enable

**Type:** array

Only enable the provided dates. It can be array of `date string` or `Carbon`. All the other dates other than provided in the `enable` array will be disabled when used.

**Example:**

```html
<x-flatpickr :enable="['2022-09-18', '2022-02-14']" />

OR

<x-flatpickr :enable="[today(), today()->addDay()]" />
```

### multiple

**Type:** bool

Sets the calendar mode to `multiple`. You will be able to select multiple dates.

**Example:**

```html
<x-flatpickr multiple />
```

<p align="center">
    <img src="docs/images/multiple-picker.png" alt="Laravel Flatpickr" width="300px">
</p>

### range

**Type:** bool

Sets the calendar mode to `range`. You will be able to select range of dates. If you use both `multiple` and `range`, the mode will be set to `range`.

By default 2 months will be visible in the dropdown when the mode is `range`. You can change that using `visibleMonths` prop.

**Example:**

```html
<x-flatpickr range />
```

<p align="center">
    <img src="docs/images/range-picker.png" alt="Laravel Flatpickr" width="500px">
</p>

### visibleMonths

**Type:** int

The number of months to be shown at the same time when displaying the calendar.

**Example:**

```html
<x-flatpickr :visible-months="3" />
```

<p align="center">
    <img src="docs/images/3-visible-months.png" alt="Laravel Flatpickr" width="600px">
</p>

### inline

**Type:** bool

Displays the calendar inline.

**Example:**

```html
<x-flatpickr inline />
```

### showWeekNumbers

**Type:** bool

Shows week numbers in calendar.

**Example:**

```html
<x-flatpickr show-week-numbers />
```

### value

**Type:** string|Carbon|array

Sets the initial selected date(s).

**Example:**

For a single picker, pass normal date string or `Carbon` instance.

```html
<x-flatpickr value="2022-09-18" />

OR

<x-flatpickr :value="\Carbon\Carbon::parse('2022-09-18')" />
```

**Example**

For multiple picker, pass the data as array.

```html
<x-flatpickr :value="['2022-09-18']" multiple />

OR

<x-flatpickr :value="[\Carbon\Carbon::parse('2022-09-18')]" multiple />
```

**Example**

For range picker, pass the 2 dates as string separated by `to` in between. Or pass 2 dates as array and it will select all the dates between and including them.

```html
<x-flatpickr value="2022-09-18 to 2022-10-11" range />

OR

<x-flatpickr :value="['2022-09-18', '2022-10-11']" range />
```

### clearable

**Type:** bool

Shows a clear icon on the right side of the date picker. Clicking on it will clear the selected value.

**Example:**

```html
<x-flatpickr clearable />
```

<p align="center">
    <img src="docs/images/clearable.png" alt="Laravel Flatpickr" width="300px">
</p>

## Event Hooks

You can pass all the event hooks present in the `flatpickr` library like `onChange`, `onOpen`, `onClose`, etc. Please check all the hooks available in their [documentation page](https://flatpickr.js.org/events/#hooks).

**Example:**

```html
<x-flatpickr clearable onChange="handleChange" />

<script>
    function handleChange(selectedDates, dateStr, instance) {
        console.log({ selectedDates, dateStr, instance });
    }
</script>
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Laratips](https://github.com/Laratipsofficial)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
