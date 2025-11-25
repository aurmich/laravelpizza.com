<?php

declare(strict_types=1);

<<<<<<< HEAD
=======
namespace Modules\UI\Tests\Unit\Enums\TableLayoutEnumTest;

>>>>>>> 727968c (.)
namespace Modules\UI\Tests\Unit\Enums;

use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Modules\UI\Enums\TableLayoutEnum;
<<<<<<< HEAD
use Tests\TestCase;
=======
>>>>>>> 727968c (.)

class TableLayoutEnumTest extends TestCase
{
    /**
     * Test enum values.
     */
    public function test_enum_values(): void
    {
<<<<<<< HEAD
        static::assertSame('list', TableLayoutEnum::LIST->value);
        static::assertSame('grid', TableLayoutEnum::GRID->value);
=======
        $this->assertEquals('list', TableLayoutEnum::LIST->value);
        $this->assertEquals('grid', TableLayoutEnum::GRID->value);
>>>>>>> 727968c (.)
    }

    /**
     * Test default layout.
     */
    public function test_default_layout(): void
    {
        $default = TableLayoutEnum::init();
<<<<<<< HEAD
        static::assertSame(TableLayoutEnum::LIST, $default);
=======
        $this->assertEquals(TableLayoutEnum::LIST, $default);
>>>>>>> 727968c (.)
    }

    /**
     * Test toggle functionality.
     */
    public function test_toggle_functionality(): void
    {
        $list = TableLayoutEnum::LIST;
        $grid = TableLayoutEnum::GRID;

<<<<<<< HEAD
        static::assertSame($grid, $list->toggle());
        static::assertSame($list, $grid->toggle());
=======
        $this->assertEquals($grid, $list->toggle());
        $this->assertEquals($list, $grid->toggle());
>>>>>>> 727968c (.)
    }

    /**
     * Test layout type checks.
     */
    public function test_layout_type_checks(): void
    {
        $list = TableLayoutEnum::LIST;
        $grid = TableLayoutEnum::GRID;

<<<<<<< HEAD
        static::assertTrue($list->isListLayout());
        static::assertFalse($list->isGridLayout());

        static::assertTrue($grid->isGridLayout());
        static::assertFalse($grid->isListLayout());
=======
        $this->assertTrue($list->isListLayout());
        $this->assertFalse($list->isGridLayout());

        $this->assertTrue($grid->isGridLayout());
        $this->assertFalse($grid->isListLayout());
>>>>>>> 727968c (.)
    }

    /**
     * Test grid configuration.
     */
    public function test_grid_configuration(): void
    {
        $grid = TableLayoutEnum::GRID;
        $config = $grid->getTableContentGrid();

<<<<<<< HEAD
        static::assertIsArray($config);
        static::assertArrayHasKey('sm', $config);
        static::assertArrayHasKey('md', $config);
        static::assertArrayHasKey('lg', $config);
        static::assertArrayHasKey('xl', $config);
        static::assertArrayHasKey('2xl', $config);
=======
        $this->assertIsArray($config);
        $this->assertArrayHasKey('sm', $config);
        $this->assertArrayHasKey('md', $config);
        $this->assertArrayHasKey('lg', $config);
        $this->assertArrayHasKey('xl', $config);
        $this->assertArrayHasKey('2xl', $config);
>>>>>>> 727968c (.)
    }

    /**
     * Test table columns method.
     */
    public function test_table_columns_method(): void
    {
        $list = TableLayoutEnum::LIST;
        $grid = TableLayoutEnum::GRID;

        $listColumns = [
            TextColumn::make('name'),
            TextColumn::make('email'),
        ];

        $gridColumns = [
            Stack::make([
                TextColumn::make('name'),
                TextColumn::make('email'),
            ]),
        ];

        // Test list layout
        $result = $list->getTableColumns($listColumns, $gridColumns);
<<<<<<< HEAD
        static::assertSame($listColumns, $result);

        // Test grid layout
        $result = $grid->getTableColumns($listColumns, $gridColumns);
        static::assertSame($gridColumns, $result);
=======
        $this->assertEquals($listColumns, $result);

        // Test grid layout
        $result = $grid->getTableColumns($listColumns, $gridColumns);
        $this->assertEquals($gridColumns, $result);
>>>>>>> 727968c (.)
    }

    /**
     * Test options method.
     */
    public function test_options_method(): void
    {
        $options = TableLayoutEnum::getOptions();

<<<<<<< HEAD
        static::assertIsArray($options);
        static::assertArrayHasKey('list', $options);
        static::assertArrayHasKey('grid', $options);
        static::assertSame(TableLayoutEnum::LIST, $options['list']);
        static::assertSame(TableLayoutEnum::GRID, $options['grid']);
=======
        $this->assertIsArray($options);
        $this->assertArrayHasKey('list', $options);
        $this->assertArrayHasKey('grid', $options);
        $this->assertEquals(TableLayoutEnum::LIST, $options['list']);
        $this->assertEquals(TableLayoutEnum::GRID, $options['grid']);
>>>>>>> 727968c (.)
    }

    /**
     * Test container classes.
     */
    public function test_container_classes(): void
    {
        $list = TableLayoutEnum::LIST;
        $grid = TableLayoutEnum::GRID;

        $listClasses = $list->getContainerClasses();
        $gridClasses = $grid->getContainerClasses();

<<<<<<< HEAD
        static::assertIsString($listClasses);
        static::assertIsString($gridClasses);
        static::assertNotEmpty($listClasses);
        static::assertNotEmpty($gridClasses);
=======
        $this->assertIsString($listClasses);
        $this->assertIsString($gridClasses);
        $this->assertNotEmpty($listClasses);
        $this->assertNotEmpty($gridClasses);
>>>>>>> 727968c (.)
    }

    /**
     * Test translation support.
     */
    public function test_translation_support(): void
    {
        $list = TableLayoutEnum::LIST;
        $grid = TableLayoutEnum::GRID;

        // Test that labels are translatable
        $listLabel = $list->getLabel();
        $gridLabel = $grid->getLabel();

<<<<<<< HEAD
        static::assertIsString($listLabel);
        static::assertIsString($gridLabel);
        static::assertNotEmpty($listLabel);
        static::assertNotEmpty($gridLabel);
=======
        $this->assertIsString($listLabel);
        $this->assertIsString($gridLabel);
        $this->assertNotEmpty($listLabel);
        $this->assertNotEmpty($gridLabel);
>>>>>>> 727968c (.)
    }

    /**
     * Test color and icon methods.
     */
    public function test_color_and_icon_methods(): void
    {
        $list = TableLayoutEnum::LIST;
        $grid = TableLayoutEnum::GRID;

        // Test colors
        $listColor = $list->getColor();
        $gridColor = $grid->getColor();

<<<<<<< HEAD
        static::assertIsString($listColor);
        static::assertIsString($gridColor);
        static::assertNotEmpty($listColor);
        static::assertNotEmpty($gridColor);
=======
        $this->assertIsString($listColor);
        $this->assertIsString($gridColor);
        $this->assertNotEmpty($listColor);
        $this->assertNotEmpty($gridColor);
>>>>>>> 727968c (.)

        // Test icons
        $listIcon = $list->getIcon();
        $gridIcon = $grid->getIcon();

<<<<<<< HEAD
        static::assertIsString($listIcon);
        static::assertIsString($gridIcon);
        static::assertNotEmpty($listIcon);
        static::assertNotEmpty($gridIcon);
=======
        $this->assertIsString($listIcon);
        $this->assertIsString($gridIcon);
        $this->assertNotEmpty($listIcon);
        $this->assertNotEmpty($gridIcon);
>>>>>>> 727968c (.)
    }
}
