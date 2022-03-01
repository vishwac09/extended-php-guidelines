<?php

/**
 * \EPG\Sniffs\AvoidSwitchCaseSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace EPG\Sniffs\AvoidSwitchCaseSniff;

/**
 * Avoid using switch case statement, use the new PHP >= 8.0 match expression.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * @link     https://www.php.net/manual/en/control-structures.match.php
 */

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class AvoidSwitchCaseSniff implements Sniff
{

    /**
     * @inheritDoc
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        // This rule must only be applicable when using php-cli >= 8.
        if (intval(phpversion()[0]) >= 8 && $tokens[$stackPtr]['content'] === 'switch') {
            $warn = 'Do not use switch expression. With PHP >= 8.0 use '
                    . 'the new match expression (https://www.php.net/manual/en/control-structures.match.php).';
            $phpcsFile->addWarning($warn, $stackPtr, 'AvoidSwitchCase');
        }
    }

    /**
     * @inheritDoc
     */
    public function register(): array
    {
        return [T_SWITCH];
    }
}
