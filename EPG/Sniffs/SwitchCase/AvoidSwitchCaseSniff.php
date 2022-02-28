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

class AvoidSwitchCaseSniff implements Sniff {
    
    /**
     * @inheritDoc
     */
    public function process(File $phpcsFile, $stackPtr) {
        $tokens = $phpcsFile->getTokens();
        $phpVersion = phpversion();
        // This rule mus t only be applicable if using php-cli >= 8.
        if (intval($phpVersion[0]) >= 8) {
            if ($tokens[$stackPtr]['content'] === 'switch') {
                $error = 'Do not use switch expression. With PHP >= 8.0 use '
                        . 'the new match expression (https://www.php.net/manual/en/control-structures.match.php).';
                $phpcsFile->addWarning($error, $stackPtr, 'AvoidSwitchCase');
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function register(): array {
        return [T_SWITCH];
    }

}