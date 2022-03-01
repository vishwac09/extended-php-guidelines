<?php
/**
 * \EPG\Sniffs\ImportOrderSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace EPG\Sniffs\ImportOrderSniff;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ImportOrderSniff implements Sniff
{

    /**
     * @inheritDoc
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $imports = [];
        foreach ($tokens as $key => $value) {
            if ($value['type'] === 'T_USE') {
                // The loop is added to avoid spaces between use keyword and the first namespace.
                // e.g. use Drupal\Core\Url;
                $i = $key;
                do {
                    $i++;
                } while ($tokens[$i]['type'] !== 'T_STRING');
                $imports[] = $tokens[$i]['content'];
            }
        }

        $flag = 0;
        foreach ($imports as $value) {
            if (in_array($value, ['Drupal', 'Symfony'])) {
                if ($flag == 1) {
                    $warn = 'Group Drupal/Symfony imports and third party libraries added via composer separately.';
                    $phpcsFile->addWarning($warn, $stackPtr, 'ImportOrder');
                    break;
                }
            } else {
                $flag = 1;
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function register(): array
    {
        return [T_OPEN_TAG];
    }
}
