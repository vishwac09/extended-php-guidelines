<?php

/**
 * OrderedMemberFunctionSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Member function of a class must be in ascending order.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * @link     https://www.php.net/manual/en/control-structures.match.php
 */

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class OrderedMemberFunctionSniff implements Sniff {

    /**
     * @inheritDoc
     */
    public function process(File $phpcsFile, $stackPtr) {
        $tokens = $phpcsFile->getTokens();
        $tokenCount = count($tokens);
        $breakCondition = [
            'T_CLASS',
            'T_INTERFACE',
            'T_TRAIT'
        ];
        $defaultFunctionOrder = [];
        // We have the index of the Class/Inerface/Trait.
        for ($i = $stackPtr; $i < $tokenCount; $i++) {
            if ($tokens[$i]['type'] === 'T_FUNCTION') {
                for ($j = $i; $j < $tokenCount; $j++) {
                   if ($tokens[$j]['type'] === 'T_STRING') {
                       // We are only interested in function name.
                       $defaultFunctionOrder[] = $tokens[$j]['content'];
                       break;
                   }
                }
            }            
            if (in_array($tokens[$i]['type'], $breakCondition) && $i != $stackPtr) {
                // Break when we encounter the next structure 
                // Class/Trait/Interace.
                break;
            }
        }
        $sortedFunctionOrder = $defaultFunctionOrder;
        sort($sortedFunctionOrder, SORT_ASC);
        $diff = array_diff_assoc($defaultFunctionOrder, $sortedFunctionOrder);
        if (count($diff) > 0) {
            $warn = 'Member functions of %s must be defined in ascending order';
            $data = [$tokens[$stackPtr]['content']];
            $phpcsFile->addWarning($warn, $stackPtr, 'OrderedFunctions', $data);
        }
    }

    /**
     * @inheritDoc
     */
    public function register(): array {
        return [T_CLASS, T_INTERFACE, T_TRAIT];
    }
}
