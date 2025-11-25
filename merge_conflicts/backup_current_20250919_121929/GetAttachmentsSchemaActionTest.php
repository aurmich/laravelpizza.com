<?php

declare(strict_types=1);

namespace Modules\Media\Tests\Unit\Actions;

use Filament\Forms\Components\FileUpload;
use Modules\Media\Actions\GetAttachmentsSchemaAction;
<<<<<<< HEAD
use Tests\TestCase;
=======
>>>>>>> 0a466ed (.)

class GetAttachmentsSchemaActionTest extends TestCase
{
    public function test_returns_attachment_schema(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice', 'contract', 'receipt'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
<<<<<<< HEAD
        static::assertIsArray($schema);
        static::assertCount(3, $schema);

        // Verifica che ogni attachment abbia un FileUpload component
        foreach ($schema as $component) {
            static::assertInstanceOf(FileUpload::class, $component);
=======
        $this->assertIsArray($schema);
        $this->assertCount(3, $schema);

        // Verifica che ogni attachment abbia un FileUpload component
        foreach ($schema as $component) {
            $this->assertInstanceOf(FileUpload::class, $component);
>>>>>>> 0a466ed (.)
        }
    }

    public function test_schema_has_correct_names(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice', 'contract'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
<<<<<<< HEAD
        static::assertSame('invoice', $schema[0]->getName());
        static::assertSame('contract', $schema[1]->getName());
=======
        $this->assertEquals('invoice', $schema[0]->getName());
        $this->assertEquals('contract', $schema[1]->getName());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_labels(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
<<<<<<< HEAD
        static::assertSame('Invoice', $schema[0]->getLabel());
=======
        $this->assertEquals('Invoice', $schema[0]->getLabel());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_validation(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertTrue($component->isRequired());
        static::assertContains('pdf', $component->getAcceptedFileTypes());
        static::assertContains('doc', $component->getAcceptedFileTypes());
        static::assertContains('docx', $component->getAcceptedFileTypes());
=======
        $this->assertTrue($component->isRequired());
        $this->assertContains('pdf', $component->getAcceptedFileTypes());
        $this->assertContains('doc', $component->getAcceptedFileTypes());
        $this->assertContains('docx', $component->getAcceptedFileTypes());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_storage(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertSame('attachments', $component->getDiskName());
=======
        $this->assertEquals('attachments', $component->getDiskName());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_directory(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertSame('temp', $component->getDirectory());
=======
        $this->assertEquals('temp', $component->getDirectory());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_visibility(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertSame('public', $component->getVisibility());
=======
        $this->assertEquals('public', $component->getVisibility());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_max_size(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertSame(10 * 1024 * 1024, $component->getMaxSize()); // 10MB
=======
        $this->assertEquals(10 * 1024 * 1024, $component->getMaxSize()); // 10MB
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_multiple(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertFalse($component->isMultiple());
=======
        $this->assertFalse($component->isMultiple());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_preview(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertTrue($component->isPreviewable());
=======
        $this->assertTrue($component->isPreviewable());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_download(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertTrue($component->isDownloadable());
=======
        $this->assertTrue($component->isDownloadable());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_remove(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertTrue($component->isRemovable());
=======
        $this->assertTrue($component->isRemovable());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_reorder(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertFalse($component->isReorderable());
=======
        $this->assertFalse($component->isReorderable());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_append(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertFalse($component->isAppendable());
=======
        $this->assertFalse($component->isAppendable());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_panel(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertSame('Attachments', $component->getPanel());
=======
        $this->assertEquals('Attachments', $component->getPanel());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_help_text(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertStringContainsString('Upload invoice file', $component->getHelperText());
=======
        $this->assertStringContainsString('Upload invoice file', $component->getHelperText());
>>>>>>> 0a466ed (.)
    }

    public function test_schema_has_correct_placeholder(): void
    {
        // Arrange
<<<<<<< HEAD
        $action = new GetAttachmentsSchemaAction();
=======
        $action = new GetAttachmentsSchemaAction;
>>>>>>> 0a466ed (.)
        $attachments = ['invoice'];

        // Act
        $schema = $action->execute($attachments);

        // Assert
        $component = $schema[0];
<<<<<<< HEAD
        static::assertStringContainsString('Select invoice file', $component->getPlaceholder());
=======
        $this->assertStringContainsString('Select invoice file', $component->getPlaceholder());
>>>>>>> 0a466ed (.)
    }
}
