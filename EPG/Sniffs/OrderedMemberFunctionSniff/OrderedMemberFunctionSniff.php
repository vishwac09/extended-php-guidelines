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

class OrderedMemberFunctionSniff implements Sniff
{
    
    /**
     * @var string[]
     *   Condition to break when the below tokens are encountered.
     */
    protected $breakCondition = [
        'T_CLASS',
        'T_INTERFACE',
        'T_TRAIT'
    ];

    /**
     * @inheritDoc
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $tokenCount = count($tokens);
        $defaultFunctionOrder = [];
        // We have the index of the Class/Interface/Trait.
        for ($i = $stackPtr; $i < $tokenCount; $i++) {
            if ($tokens[$i]['type'] === 'T_FUNCTION') {
                $j = $i;
                do {
                    // We are only interested in function name.
                    $j++;
                } while ($tokens[$j]['type'] !== 'T_STRING');
                $defaultFunctionOrder[] = $tokens[$j]['content'];
            }
            if (in_array($tokens[$i]['type'], $this->breakCondition) && $i != $stackPtr) {
                // Break when we encounter the next structure Class/Trait/Interface.
                // Cases where single file have 2 classes.
                break;
            }
        }
        // Creating copy to get the diff.
        $sortedFunctionOrder = $defaultFunctionOrder;
        sort($sortedFunctionOrder, SORT_ASC);
        $diff = array_diff_assoc($defaultFunctionOrder, $sortedFunctionOrder);
        if (!empty($diff)) {
            $warn = 'Member functions of %s must be defined in ascending order.';
            $data = [$tokens[$stackPtr]['content']];
            $phpcsFile->addWarning($warn, $stackPtr, 'OrderedFunctions', $data);
        }
    }

    /**
     * @inheritDoc
     */
    public function register(): array
    {
        return [T_CLASS, T_INTERFACE, T_TRAIT];
    }
}
