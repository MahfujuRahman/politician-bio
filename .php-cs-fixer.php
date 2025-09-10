<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->exclude([
        'bootstrap',
        'storage',
        'vendor',
        'node_modules',
    ])
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR12' => true,
        '@PhpCsFixer' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
        'not_operator_with_successor_space' => true,
        'trailing_comma_in_multiline' => true,
        'phpdoc_scalar' => true,
        'unary_operator_spaces' => true,
        'binary_operator_spaces' => true,
        'blank_line_before_statement' => [
            'statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try'],
        ],
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_var_without_name' => true,
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
            'keep_multiple_spaces_after_comma' => true,
        ],
        'single_trait_insert_per_statement' => true,
        'no_extra_blank_lines' => [
            'tokens' => [
                'extra',
                'throw',
                'use',
                'use_trait',
            ],
        ],
        'concat_space' => ['spacing' => 'one'],
        'no_multiline_whitespace_around_double_arrow' => true,
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        'single_quote' => true,
        'no_empty_statement' => true,
        'no_whitespace_in_blank_line' => true,
        'standardize_not_equals' => true,
        'ternary_operator_spaces' => true,
        'visibility_required' => true,
        'encoding' => true,
        'full_opening_tag' => true,
        'function_declaration' => true,
        'no_closing_tag' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'single_blank_line_at_eof' => true,
        'single_class_element_per_statement' => ['elements' => ['property']],
        'single_line_after_imports' => true,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'lowercase_keywords' => true,
        'braces' => [
            'allow_single_line_closure' => true,
        ],
        'cast_spaces' => true,
        'class_attributes_separation' => [
            'elements' => [
                'method' => 'one',
            ],
        ],
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'object_operator_without_whitespace' => true,
        'phpdoc_indent' => true,
        'general_phpdoc_tag_rename' => true,
        'phpdoc_inline_tag_normalizer' => true,
        'phpdoc_tag_type' => true,
        'phpdoc_no_empty_return' => true,
        'phpdoc_return_self_reference' => true,
        'phpdoc_var_annotation_correct_order' => true,
        'phpdoc_align' => true,
        'operator_linebreak' => ['only_booleans' => true],
        'echo_tag_syntax' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'semicolon_after_instruction' => true,
        'space_after_semicolon' => true,
        'yoda_style' => true,
        'no_alias_functions' => true,
        'no_mixed_echo_print' => ['use' => 'echo'],
        'pow_to_exponentiation' => true,
        'set_type_to_cast' => true,
        'modernize_strpos' => true,
        'logical_operators' => true,
        'clean_namespace' => true,
        'no_leading_namespace_whitespace' => true,
        'no_unneeded_import_alias' => true,
        'single_import_per_statement' => true,
        'group_import' => false,
        'fully_qualified_strict_types' => true,
        'global_namespace_import' => [
            'import_constants' => false,
            'import_functions' => false,
            'import_classes' => true,
        ],
    ])
    ->setFinder($finder)
    ->setUsingCache(true)
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache');
