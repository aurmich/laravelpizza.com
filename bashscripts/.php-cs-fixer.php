<?php

>>>>>>> 164b8363 (Squashed 'laravel/Modules/Rating/' content from commit e5c84117)
$finder = PhpCsFixer\Finder::create()
    ->notPath('bootstrap/cache')
    ->notPath('storage')
    ->notPath('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
>>>>>>> 59bc4fe7 (first)

$config = new PhpCsFixer\Config();

$config
    ->setRules([
        '@Symfony' => true,
        'array_indentation' => true,
>>>>>>> 164b8363 (Squashed 'laravel/Modules/Rating/' content from commit e5c84117)
        'function_typehint_space' => true,
        'declare_equal_normalize' => true,
        'declare_strict_types' => true,
        'combine_consecutive_unsets' => true,
        //'binary_operator_spaces' => ['align_double_arrow' => false],
>>>>>>> 164b8363 (Squashed 'laravel/Modules/Rating/' content from commit e5c84117)
        'array_syntax' => ['syntax' => 'short'],
        'linebreak_after_opening_tag' => true,
        'not_operator_with_successor_space' => true,
        'ordered_imports' => true,
        'phpdoc_order' => true,
>>>>>>> 164b8363 (Squashed 'laravel/Modules/Rating/' content from commit e5c84117)
        'php_unit_construct' => false,
        'braces' => [
            'position_after_functions_and_oop_constructs' => 'same',
        ],
        'function_declaration' => true,
        'blank_line_after_namespace' => true,
        'class_definition' => true,
        'elseif' => true,
>>>>>>> f3c337b1 (.)
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_order' => true,
        'phpdoc_trim' => true,
        'phpdoc_summary' => false,
>>>>>>> 164b8363 (Squashed 'laravel/Modules/Rating/' content from commit e5c84117)
    ])
    ->setFinder($finder)
;

return $config;
>>>>>>> 164b8363 (Squashed 'laravel/Modules/Rating/' content from commit e5c84117)
    ])
    ->setFinder($finder)

return $config;
    ])
    ->setFinder($finder)

return $config;
>>>>>>> a8f30311 (first)
