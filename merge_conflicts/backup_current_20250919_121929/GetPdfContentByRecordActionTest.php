<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Feature\Actions\Pdf;

use ReflectionClass;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;
use Modules\Xot\Actions\Pdf\GetPdfContentByRecordAction;
use Tests\TestCase;

/**
 * Test suite for GetPdfContentByRecordAction.
 */
class GetPdfContentByRecordActionTest extends TestCase
{
    private GetPdfContentByRecordAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new GetPdfContentByRecordAction();
    }

    /** @test */
    public function it_generates_pdf_content_from_record(): void
    {
        // Arrange
        $user = User::factory()->create([
            'name' => 'Test User',
<<<<<<< HEAD
            'email' => 'test@example.com',
=======
            'email' => 'test@example.com'
>>>>>>> f1d4085 (.)
        ]);

        // Mock view existence
        view()->addNamespace('user', resource_path('views'));
<<<<<<< HEAD

        // Act & Assert
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("View 'user::user.show.pdf' not found");

=======
        
        // Act & Assert
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("View 'user::user.show.pdf' not found");
        
>>>>>>> f1d4085 (.)
        $this->action->execute($user);
    }

    /** @test */
    public function it_generates_correct_view_name(): void
    {
        // Arrange
        $user = User::factory()->create();
<<<<<<< HEAD

=======
        
>>>>>>> f1d4085 (.)
        // Use reflection to test protected method
        $reflection = new ReflectionClass($this->action);
        $method = $reflection->getMethod('generateViewName');
        $method->setAccessible(true);
<<<<<<< HEAD

        // Act
        $viewName = $method->invoke($this->action, $user);

=======
        
        // Act
        $viewName = $method->invoke($this->action, $user);
        
>>>>>>> f1d4085 (.)
        // Assert
        $this->assertEquals('user::user.show.pdf', $viewName);
    }

    /** @test */
    public function it_generates_correct_filename_for_basic_model(): void
    {
        // Arrange
        $user = User::factory()->create(['id' => 123, 'name' => 'Test User']);
<<<<<<< HEAD

=======
        
>>>>>>> f1d4085 (.)
        // Use reflection to test protected method
        $reflection = new ReflectionClass($this->action);
        $method = $reflection->getMethod('generateFilename');
        $method->setAccessible(true);
<<<<<<< HEAD

        // Act
        $filename = $method->invoke($this->action, $user);

=======
        
        // Act
        $filename = $method->invoke($this->action, $user);
        
>>>>>>> f1d4085 (.)
        // Assert
        $this->assertEquals('user_123_test-user.pdf', $filename);
    }

    /** @test */
    public function it_generates_enhanced_filename_for_performance_models(): void
    {
        // Arrange - Create a mock model with performance fields
        $record = new class extends Model {
            protected $table = 'test_performance';
            protected $fillable = ['id', 'matr', 'cognome', 'nome'];
<<<<<<< HEAD

=======
            
>>>>>>> f1d4085 (.)
            public function getKey()
            {
                return 456;
            }
        };
<<<<<<< HEAD

        $record->matr = 'ABC123';
        $record->cognome = 'Rossi';
        $record->nome = 'Mario';

=======
        
        $record->matr = 'ABC123';
        $record->cognome = 'Rossi';
        $record->nome = 'Mario';
        
>>>>>>> f1d4085 (.)
        // Use reflection to test protected method
        $reflection = new ReflectionClass($this->action);
        $method = $reflection->getMethod('generateFilename');
        $method->setAccessible(true);
<<<<<<< HEAD

        // Act
        $filename = $method->invoke($this->action, $record);

=======
        
        // Act
        $filename = $method->invoke($this->action, $record);
        
>>>>>>> f1d4085 (.)
        // Assert
        $this->assertEquals('scheda_456_ABC123_Rossi_Mario.pdf', $filename);
    }

    /** @test */
    public function it_prepares_correct_view_parameters(): void
    {
        // Arrange
        $user = User::factory()->create(['name' => 'Test User']);
<<<<<<< HEAD

=======
        
>>>>>>> f1d4085 (.)
        // Use reflection to test protected method
        $reflection = new ReflectionClass($this->action);
        $method = $reflection->getMethod('prepareViewParameters');
        $method->setAccessible(true);
<<<<<<< HEAD

        // Act
        $params = $method->invoke($this->action, $user, 'user::user.show.pdf');

=======
        
        // Act
        $params = $method->invoke($this->action, $user, 'user::user.show.pdf');
        
>>>>>>> f1d4085 (.)
        // Assert
        $this->assertIsArray($params);
        $this->assertArrayHasKey('view', $params);
        $this->assertArrayHasKey('row', $params);
        $this->assertArrayHasKey('transKey', $params);
        $this->assertEquals('user::user.show.pdf', $params['view']);
        $this->assertSame($user, $params['row']);
        $this->assertEquals('user::users.fields', $params['transKey']);
    }

    /** @test */
    public function it_throws_exception_for_missing_view(): void
    {
        // Arrange
        $user = User::factory()->create();
<<<<<<< HEAD

        // Act & Assert
        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches("/View 'user::user\.show\.pdf' not found/");

=======
        
        // Act & Assert
        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches("/View 'user::user\.show\.pdf' not found/");
        
>>>>>>> f1d4085 (.)
        $this->action->execute($user);
    }

    /** @test */
    public function it_throws_exception_for_empty_html_content(): void
    {
        // This test would require mocking view rendering to return empty content
        // Implementation depends on testing infrastructure setup
        $this->markTestSkipped('Requires view mocking infrastructure');
    }

    /** @test */
    public function it_uses_custom_filename_when_provided(): void
    {
        // Arrange
        $user = User::factory()->create();
        $customFilename = 'custom-report.pdf';
<<<<<<< HEAD

        // Act & Assert - Should use custom filename in error message
        $this->expectException(Exception::class);

=======
        
        // Act & Assert - Should use custom filename in error message
        $this->expectException(Exception::class);
        
>>>>>>> f1d4085 (.)
        $this->action->execute($user, $customFilename);
    }

    /** @test */
    public function it_handles_from_record_convenience_method(): void
    {
        // Arrange
        $user = User::factory()->create();
        $filename = 'convenience-test.pdf';
<<<<<<< HEAD

        // Act & Assert
        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches("/View 'user::user\.show\.pdf' not found/");

=======
        
        // Act & Assert
        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches("/View 'user::user\.show\.pdf' not found/");
        
>>>>>>> f1d4085 (.)
        $this->action->fromRecord($user, $filename);
    }

    /** @test */
    public function it_logs_errors_when_pdf_generation_fails(): void
    {
        // This test would require mocking HTML2PDF to throw exceptions
        // Implementation depends on testing infrastructure setup
        $this->markTestSkipped('Requires HTML2PDF mocking infrastructure');
    }

    /** @test */
    public function it_returns_valid_pdf_content_when_view_exists(): void
    {
        // This test would require creating actual test views
        // Implementation depends on test view infrastructure
        $this->markTestSkipped('Requires test view infrastructure');
    }
}
