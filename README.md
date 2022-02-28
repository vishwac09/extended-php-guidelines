# Extended PHP Guidelines

This PHP library is a type of PHP-CodeSniffer standard and provides with a standard by name EPG to be used with phpcs.
I work mostly on Drupal projects, so normally  use the Drupal Coding standard to sniff the custom code for any violations 
when sniffed against the Drupal Coding standard. 

Also curated few additional standards expected to be followed by developers/reviewers to be followed in every phase 
of the SDLC. Normally applicable mostly to Class/Trait or Interfaces.

## List

1. Order of imports - Group Drupal/Symfony imports and third party libraries added via composer separately.
2. Avoid Switch case - PHP >= 8.0 provides match() {} expression, can be replaced in place of switch() case:.
3. Avoid Static Class references - Cannot be injected.
4. Order of member functions - Order member function in ascending order, improves readability.

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
FOUND 0 ERRORS AND 2 WARNINGS AFFECTING 2 LINES
------------------------------------------------------------------------------------------------------
  1 | WARNING | Group Drupal/Symfony imports and third party libraries added via composer separately.
 22 | WARNING | Do not use static class references.
------------------------------------------------------------------------------------------------------
```