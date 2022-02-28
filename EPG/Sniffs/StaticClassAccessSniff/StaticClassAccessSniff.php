<?php


/**
 * StaticClassAccessSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Avoid including static Class references.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * @link     https://www.php.net/manual/en/control-structures.match.php
 */

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class StaticClassAccessSniff implements Sniff
{
    
    /**
     * @inheritDoc
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        // Accesses via these identifiers allowed as they happen via same class.
        $ignoreWhen = [
            'static',
            'parent',
            'self'
        ];
        
        if (!in_array($tokens[$stackPtr - 1]['content'], $ignoreWhen)) {
            $warn = 'Do not use static class references.';
            $phpcsFile->addWarning($warn, $stackPtr, 'StaticClassAccess');
        }
        
    }
    
    /**
     * @inheritDoc
     */
    public function register(): array
    {
        return [T_DOUBLE_COLON];
    }
    
}