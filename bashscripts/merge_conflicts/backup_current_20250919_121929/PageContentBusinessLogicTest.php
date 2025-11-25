<?php

declare(strict_types=1);

use Illuminate\Database\QueryException;
use Modules\Cms\Models\PageContent;
use Modules\Tenant\Models\Traits\SushiToJsons;
use Spatie\Translatable\HasTranslations;

test('page content model uses required traits', function () {
    $pageContent = new PageContent();

    expect($pageContent)->toBeInstanceOf(SushiToJsons::class);
<<<<<<< HEAD
    expect(in_array(HasTranslations::class, class_uses($pageContent), strict: true))->toBeTrue();
=======
    expect(in_array(HasTranslations::class, class_uses($pageContent)))->toBeTrue();
>>>>>>> 3401a6b (.)
});

test('page content has correct translatable attributes', function () {
    $pageContent = new PageContent();

    $expectedTranslatable = [
        'name',
        'blocks',
    ];

    expect($pageContent->translatable)->toBe($expectedTranslatable);
});

test('page content has correct fillable attributes', function () {
    $pageContent = new PageContent();

    $expectedFillable = [
        'name',
        'slug',
        'blocks',
    ];

    expect($pageContent->getFillable())->toBe($expectedFillable);
});

test('page content has correct schema definition', function () {
    $pageContent = new PageContent();

    $expectedSchema = [
        'id' => 'integer',
        'name' => 'json',
        'slug' => 'string',
        'blocks' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_by' => 'string',
        'updated_by' => 'string',
    ];

    expect($pageContent->schema)->toBe($expectedSchema);
});

test('page content has correct casts', function () {
    $pageContent = new PageContent();

    $expectedCasts = [
        'id' => 'string',
        'uuid' => 'string',
        'name' => 'string',
        'slug' => 'string',
        'blocks' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    expect($pageContent->casts())->toBe($expectedCasts);
});

test('page content can be created with basic data', function () {
    $pageContent = PageContent::factory()->create([
        'slug' => 'test-content',
        'name' => ['en' => 'Test Content', 'it' => 'Contenuto di Test'],
<<<<<<< HEAD
        'blocks' => [['type' => 'text', 'content' => 'Test content']],
=======
        'blocks' => [['type' => 'text', 'content' => 'Test content']]
>>>>>>> 3401a6b (.)
    ]);

    expect($pageContent)
        ->slug->toBe('test-content')
        ->name->toBe(['en' => 'Test Content', 'it' => 'Contenuto di Test'])
        ->blocks->toBe([['type' => 'text', 'content' => 'Test content']]);
});

test('page content blocks support complex structures', function () {
    $blocks = [
        [
            'type' => 'hero',
            'title' => 'Welcome Banner',
            'content' => 'Hero section content',
            'image' => 'hero.jpg',
<<<<<<< HEAD
            'cta' => ['text' => 'Get Started', 'link' => '/start'],
=======
            'cta' => ['text' => 'Get Started', 'link' => '/start']
>>>>>>> 3401a6b (.)
        ],
        [
            'type' => 'features',
            'title' => 'Our Features',
            'items' => [
                ['title' => 'Fast', 'description' => 'Lightning fast performance'],
                ['title' => 'Secure', 'description' => 'Bank-level security'],
<<<<<<< HEAD
                ['title' => 'Reliable', 'description' => '99.9% uptime guarantee'],
            ],
=======
                ['title' => 'Reliable', 'description' => '99.9% uptime guarantee']
            ]
>>>>>>> 3401a6b (.)
        ],
        [
            'type' => 'testimonial',
            'quote' => 'Amazing service!',
            'author' => 'John Doe',
            'company' => 'ABC Corp',
<<<<<<< HEAD
            'image' => 'john.jpg',
        ],
=======
            'image' => 'john.jpg'
        ]
>>>>>>> 3401a6b (.)
    ];

    $pageContent = PageContent::factory()->create(['blocks' => $blocks]);

    expect($pageContent->blocks)
        ->toBeArray()
        ->toHaveCount(3)
        ->sequence(
            fn($block) => $block->type->toBe('hero'),
            fn($block) => $block->type->toBe('features'),
<<<<<<< HEAD
            fn($block) => $block->type->toBe('testimonial'),
=======
            fn($block) => $block->type->toBe('testimonial')
>>>>>>> 3401a6b (.)
        );
});

test('page content supports multilingual name', function () {
    $pageContent = PageContent::factory()->create([
        'name' => [
            'en' => 'Home Content',
            'it' => 'Contenuto Home',
            'es' => 'Contenido Principal',
<<<<<<< HEAD
            'fr' => 'Contenu Principal',
        ],
=======
            'fr' => 'Contenu Principal'
        ]
>>>>>>> 3401a6b (.)
    ]);

    expect($pageContent->name)
        ->toBeArray()
        ->toHaveKey('en', 'Home Content')
        ->toHaveKey('it', 'Contenuto Home')
        ->toHaveKey('es', 'Contenido Principal')
        ->toHaveKey('fr', 'Contenu Principal');
});

test('page content supports multilingual blocks', function () {
    $blocks = [
        'en' => [
<<<<<<< HEAD
            ['type' => 'text', 'content' => 'English content'],
        ],
        'it' => [
            ['type' => 'text', 'content' => 'Contenuto italiano'],
        ],
        'es' => [
            ['type' => 'text', 'content' => 'Contenido español'],
        ],
=======
            ['type' => 'text', 'content' => 'English content']
        ],
        'it' => [
            ['type' => 'text', 'content' => 'Contenuto italiano']
        ],
        'es' => [
            ['type' => 'text', 'content' => 'Contenido español']
        ]
>>>>>>> 3401a6b (.)
    ];

    $pageContent = PageContent::factory()->create(['blocks' => $blocks]);

    expect($pageContent->blocks)
        ->toBeArray()
        ->toHaveKeys(['en', 'it', 'es'])
        ->en->toBeArray()->toHaveCount(1)
        ->it->toBeArray()->toHaveCount(1)
        ->es->toBeArray()->toHaveCount(1);
});

test('page content factory creates valid instances', function () {
    $pageContent = PageContent::factory()->make();

    expect($pageContent)
<<<<<<< HEAD
        ->slug->toBeString()
        ->not->toBeEmpty()
        ->name->toBeArray()
        ->not->toBeEmpty()
=======
        ->slug->toBeString()->not->toBeEmpty()
        ->name->toBeArray()->not->toBeEmpty()
>>>>>>> 3401a6b (.)
        ->blocks->toBeArray();
});

test('page content slug must be unique', function () {
    $pageContent1 = PageContent::factory()->create(['slug' => 'unique-content']);

    expect(fn() => PageContent::factory()->create(['slug' => 'unique-content']))
        ->toThrow(QueryException::class);
});

test('page content blocks validation', function () {
    $pageContent = PageContent::factory()->make(['blocks' => 'invalid-string']);

<<<<<<< HEAD
    expect($pageContent->save(...))->toThrow(QueryException::class);
});

test('page content handles large blocks efficiently', function () {
    $largeBlocks = array_map(
        fn($i) => [
            'type' => 'card',
            'title' => "Card {$i}",
            'content' => "Content for card {$i} with detailed description.",
            'image' => "card{$i}.jpg",
            'metadata' => ['index' => $i, 'category' => 'test'],
        ],
        range(1, 50),
    );

    $pageContent = PageContent::factory()->create(['blocks' => $largeBlocks]);

    expect($pageContent->fresh()->blocks)->toBeArray()->toHaveCount(50);
=======
    expect(fn() => $pageContent->save())->toThrow(QueryException::class);
});

test('page content handles large blocks efficiently', function () {
    $largeBlocks = array_map(fn($i) => [
        'type' => 'card',
        'title' => "Card {$i}",
        'content' => "Content for card {$i} with detailed description.",
        'image' => "card{$i}.jpg",
        'metadata' => ['index' => $i, 'category' => 'test']
    ], range(1, 50));

    $pageContent = PageContent::factory()->create(['blocks' => $largeBlocks]);

    expect($pageContent->fresh()->blocks)
        ->toBeArray()
        ->toHaveCount(50);
>>>>>>> 3401a6b (.)
});

test('page content name validation for multilingual support', function () {
    $pageContent = PageContent::factory()->make(['name' => 'invalid-string']);

<<<<<<< HEAD
    expect($pageContent->save(...))->toThrow(QueryException::class);
=======
    expect(fn() => $pageContent->save())->toThrow(QueryException::class);
>>>>>>> 3401a6b (.)
});

test('page content getRows method returns sushi rows', function () {
    $pageContent = new PageContent();

    $rows = $pageContent->getRows();

    expect($rows)->toBeArray();
});

test('page content sluggable configuration', function () {
    $pageContent = new PageContent();

    $sluggable = $pageContent->sluggable();

<<<<<<< HEAD
    expect($sluggable)->toBeArray()->toHaveKey('slug')->slug->toBeArray()->toHaveKey('source', 'title');
=======
    expect($sluggable)
        ->toBeArray()
        ->toHaveKey('slug')
        ->slug->toBeArray()->toHaveKey('source', 'title');
>>>>>>> 3401a6b (.)
});

test('page content with complex nested block structures', function () {
    $complexBlocks = [
        [
            'type' => 'accordion',
            'title' => 'FAQ Section',
<<<<<<< HEAD
            'items' => array_map(
                fn($i) => [
                    'question' => "Question {$i}",
                    'answer' => "Answer to question {$i} with detailed explanation.",
                    'expanded' => $i === 0,
                ],
                range(1, 20),
            ),
=======
            'items' => array_map(fn($i) => [
                'question' => "Question {$i}",
                'answer' => "Answer to question {$i} with detailed explanation.",
                'expanded' => $i === 0
            ], range(1, 20))
>>>>>>> 3401a6b (.)
        ],
        [
            'type' => 'gallery',
            'title' => 'Image Gallery',
<<<<<<< HEAD
            'images' => array_map(
                fn($i) => [
                    'src' => "gallery/image{$i}.jpg",
                    'alt' => "Image {$i}",
                    'caption' => "Caption for image {$i}",
                    'thumbnail' => "gallery/thumb{$i}.jpg",
                ],
                range(1, 15),
            ),
=======
            'images' => array_map(fn($i) => [
                'src' => "gallery/image{$i}.jpg",
                'alt' => "Image {$i}",
                'caption' => "Caption for image {$i}",
                'thumbnail' => "gallery/thumb{$i}.jpg"
            ], range(1, 15))
>>>>>>> 3401a6b (.)
        ],
        [
            'type' => 'pricing',
            'title' => 'Pricing Plans',
            'plans' => [
                [
                    'name' => 'Basic',
                    'price' => '$9.99',
                    'features' => ['Feature 1', 'Feature 2', 'Feature 3'],
<<<<<<< HEAD
                    'button' => ['text' => 'Get Basic', 'link' => '/buy/basic'],
=======
                    'button' => ['text' => 'Get Basic', 'link' => '/buy/basic']
>>>>>>> 3401a6b (.)
                ],
                [
                    'name' => 'Pro',
                    'price' => '$19.99',
                    'features' => ['All Basic features', 'Priority Support', 'Advanced Analytics'],
<<<<<<< HEAD
                    'button' => ['text' => 'Get Pro', 'link' => '/buy/pro'],
=======
                    'button' => ['text' => 'Get Pro', 'link' => '/buy/pro']
>>>>>>> 3401a6b (.)
                ],
                [
                    'name' => 'Enterprise',
                    'price' => '$49.99',
                    'features' => ['All Pro features', 'Dedicated Account Manager', 'Custom Solutions'],
<<<<<<< HEAD
                    'button' => ['text' => 'Contact Sales', 'link' => '/contact'],
                ],
            ],
        ],
=======
                    'button' => ['text' => 'Contact Sales', 'link' => '/contact']
                ]
            ]
        ]
>>>>>>> 3401a6b (.)
    ];

    $pageContent = PageContent::factory()->create(['blocks' => $complexBlocks]);

    expect($pageContent->fresh()->blocks)
        ->toBeArray()
        ->toHaveCount(3)
        ->sequence(
            fn($block) => $block->type->toBe('accordion')->items->toHaveCount(20),
            fn($block) => $block->type->toBe('gallery')->images->toHaveCount(15),
<<<<<<< HEAD
            fn($block) => $block->type->toBe('pricing')->plans->toHaveCount(3),
=======
            fn($block) => $block->type->toBe('pricing')->plans->toHaveCount(3)
>>>>>>> 3401a6b (.)
        );
});
