## About Providnyk

PROVODNYK addresses the problem of the quality of life of Ukrainians with limited mobility by allowing its users add and evaluate the accessibility of infrastructure objects already in 5 cities. It also helps consolidate the efforts of the civil society, state, business and public in building an inclusive society in Ukraine.

Users can plan the accessible route and create point-to-point directions, add objects (locations) with and without inclusive infrastructure on the city maps, and review the objects, adding photos and texts. When an object gets certain number of negative reviews, the system automatically sends a request (complaint) to the relevant authorities.

The main users of the application are people with special needs in commuting, like people with disabilities or temporary mobility limitations, parents with strollers and elderly people, and activists working on the rights of people with disabilities, urban development, etc. PROVODNYK also engages socially responsible businesses, government agencies, CSOs working on e-Democracy and public administration reform, and other civic tech initiatives.

## Installation

This is a typical Laravel 6 application. Please, google for best installation and set up approaches.

## Database

Run migrations with "php artisan migrate"

## Parameters

A sample of settings file "env_sample.txt" is included. Rename it to ".env" and fill with your data for DB connection and application key. Also remember to "php artisan config:cache" after deployment completed at production environment.

## 3rd part integration

Some external tools are used and you need API and/or access keys for using them.

- Google Maps
- Recaptcha. We recommend version 3 for better user experience. However version 2 is also supported.
- Google Tag for analytics

## Contributing

You are more than welcome to contribute with code update via a pull request. Bug reports are also accepted with pleasure. GitHub is the core for all such activity.

## Security Vulnerabilities

If you discover a security vulnerability within Providnyk, please send an e-mail to Max Dmitriev via [maksimdzmitryeu+providnyk@gmail.com](mailto:maksimdzmitryeu+providnyk@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Providnyk project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
