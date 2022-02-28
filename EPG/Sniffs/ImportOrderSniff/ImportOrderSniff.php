<?php

/**
 * AvoidSwitchCaseSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Avoid using switch case statement, use the new PHP >= 8.0 match expression.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * @link     https://www.php.net/manual/en/control-structures.match.php
 */

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class ImportOrderSniff implements Sniff {
    
    /**
     * @inheritDoc
     */
    public function process(File $phpcsFile, $stackPtr) {
        $tokens = $phpcsFile->getTokens();
    }

    /**
     * @inheritDoc
     */
    public function register(): array {
        return [T_USE];
    }

}