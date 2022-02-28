<?php
/**
 * \EPS\Sniffs\OrderedMemberFunctionSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace EPG\Sniffs\OrderedMemberFunctionSniff;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

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
                // The loop is added to avoid spaces between function keyword and its name.
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
                // Class/Trait/Interface.
                break;
            }
        }
        $sortedFunctionOrder = $defaultFunctionOrder;
        sort($sortedFunctionOrder, SORT_ASC);
        $diff = array_diff_assoc($defaultFunctionOrder, $sortedFunctionOrder);
        if (!empty($diff)) {
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
