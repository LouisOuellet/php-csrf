![GitHub repo logo](/dist/img/logo.png)

# phpCSRF
![License](https://img.shields.io/github/license/LouisOuellet/php-csrf?style=for-the-badge)
![GitHub repo size](https://img.shields.io/github/repo-size/LouisOuellet/php-csrf?style=for-the-badge&logo=github)
![GitHub top language](https://img.shields.io/github/languages/top/LouisOuellet/php-csrf?style=for-the-badge)
![Version](https://img.shields.io/github/v/release/LouisOuellet/php-csrf?label=Version&style=for-the-badge)

## Description
This class is a PHP implementation of a CSRF token generation and validation system. CSRF (Cross-Site Request Forgery) is an attack in which an attacker tricks a user into performing an unwanted action on a website, by sending a forged request on behalf of the user.

## Features
  - Generates a CSRF token using a cryptographically secure random number generator.
  - Uses the default field name 'csrf' for retrieving and validating the token, but allows a custom field name to be set through the constructor.
  - Supports setting the length of the token through the generate method, with a default length of 32 bytes.
  - Logs error messages to a file using the phpLogger class, with IP address information included in the log entries.
  - Configures cookie security settings to help prevent cross-site scripting (XSS) and cross-site request forgery (CSRF) attacks.

## Why you might need it?
This class provides a simple implementation of a CSRF token generator and validator in PHP. It is designed to be easy to use, while still providing adequate security measures to prevent CSRF attacks.

CSRF attacks occur when a malicious user tricks an authenticated user into performing an unintended action on a web application. To prevent these attacks, a CSRF token is generated and added to the form that is being submitted. When the form is submitted, the token is validated to ensure that it matches the expected value. If the token is invalid, the request is rejected.

## Can I use this?
Sure!

## License
This software is distributed under the [GNU General Public License v3.0](https://www.gnu.org/licenses/gpl-3.0.en.html) license. Please read [LICENSE](LICENSE) for information on the software availability and distribution.

## Requirements
* PHP >= 7.0.0

## Security
Please disclose any vulnerabilities found responsibly – report security issues to the maintainers privately.

## Installation
Using Composer:
```sh
composer require laswitchtech/php-csrf
```

## How do I use it?
### Example
#### Initiate CSRF
```php

//Import CSRF class into the global namespace
//These must be at the top of your script, not inside a function
use LaswitchTech\phpCSRF\phpCSRF;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Initiate CSRF
$phpCSRF = new phpCSRF();
```

#### Validate Token
```php

//Import CSRF class into the global namespace
//These must be at the top of your script, not inside a function
use LaswitchTech\phpCSRF\phpCSRF;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Initiate CSRF
$phpCSRF = new phpCSRF();

//Validation
$phpCSRF->validate(); // Returns Boolean
```

#### Retrieve CSRF Token
```php

//Import CSRF class into the global namespace
//These must be at the top of your script, not inside a function
use LaswitchTech\phpCSRF\phpCSRF;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Initiate CSRF
$phpCSRF = new phpCSRF();

//Token
$phpCSRF->token(); // Returns Token
```
