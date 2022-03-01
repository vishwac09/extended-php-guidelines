# Extended PHP Guidelines

Apart from the [PSR-1](https://www.php-fig.org/psr/psr-1/), [PSR-2](https://www.php-fig.org/psr/psr-2/), [PSR-12](https://www.php-fig.org/psr/psr-12/)
and the [Drupal](https://www.drupal.org/docs/develop/standards) standard's, we follow few [more](#List) to achieve consistency of code project wide.

I work mostly on Drupal projects, so normally use the Drupal Coding standard to sniff the custom code for any violations.
This PHP library is a type of PHP-CodeSniffer standard which checks PHP code against the below list.

## List

1. Order of imports - `Group Drupal/Symfony imports and third party libraries added via composer separately.`
2. Avoid Switch case - `PHP >= 8.0 provides match() {} expression, can be replaced in place of switch() case:.`
3. Avoid Static Class references - `Cannot be injected.`
4. Order of member functions - `Order member function in ascending order, improves readability.`

## Usage

Create a project, and add this packages as __DEV__ dependancy.

#### Installation
Add via composer as local dependencies
```
composer require --dev dealerdirect/phpcodesniffer-composer-installer
composer require --dev vishwac09/extended-php-guidelines
```

__OR__

Add via composer as global dependencies
```
composer require global --dev dealerdirect/phpcodesniffer-composer-installer
composer require global --dev vishwac09/extended-php-guidelines
```

Add via GIT
```
git clone git@github.com:vishwac09/extended-php-guidelines.git
```

add the standard to phpcs

```
phpcs --config-set installed_paths /path/to/extended-php-guidelines/EPG
```
### Run

Check if the new stanadard is configures with phpcs.

```
phpcs -i
```

Sniff code for the above violation.

```
phpcs --standard=EPG --colors file1.php, file2.inc
```

### Example

```
FILE: /Users/hp/Documents/temp.php
------------------------------------------------------------------------------------------------------
FOUND 0 ERRORS AND 5 WARNINGS AFFECTING 5 LINES
------------------------------------------------------------------------------------------------------
  1 | WARNING | Group Drupal/Symfony imports and third party libraries added via composer separately.
 26 | WARNING | Member functions of class must be defined in ascending order
 28 | WARNING | Do not use static class references.
 40 | WARNING | Member functions of interface must be defined in ascending order
 50 | WARNING | Do not use switch expression. With PHP >= 8.0 use the new match expression
    |         | (https://www.php.net/manual/en/control-structures.match.php).
------------------------------------------------------------------------------------------------------
```