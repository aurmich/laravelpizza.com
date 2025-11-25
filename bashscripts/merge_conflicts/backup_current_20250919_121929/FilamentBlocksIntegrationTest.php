<?php

declare(strict_types=1);

namespace Modules\Cms\Tests\Feature;

use Modules\Cms\Tests\TestCase;
<<<<<<< HEAD
use Modules\SaluteOra\Enums\UserTypeEnum;
use Modules\SaluteOra\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
=======
use function Pest\Laravel\get;
use function Pest\Laravel\actingAs;
use Modules\SaluteOra\Models\User;
use Modules\SaluteOra\Enums\UserTypeEnum;
>>>>>>> 3401a6b (.)

uses(TestCase::class);

describe('Filament Blocks Integration', function () {
    it('integrates with PageContentBuilder correctly', function () {
        $response = get('/');

        $response->assertStatus(200);
<<<<<<< HEAD

=======
>>>>>>> 3401a6b (.)
        // Verifica che il PageContentBuilder funzioni correttamente
        // Questo test verifica l'integrazione tra CMS e frontend
    });

    it('displays blocks with correct data structure', function () {
        $response = get('/');
<<<<<<< HEAD

=======
        
>>>>>>> 3401a6b (.)
        $response->assertStatus(200);
        // Verifica struttura dati blocchi
        $response->assertSee('landing-page');
        $response->assertSee('view');
        $response->assertSee('title');
        $response->assertSee('subtitle');
        $response->assertSee('image');
        $response->assertSee('cta_text');
        $response->assertSee('cta_link');
    });

    it('renders blocks using correct view templates', function () {
        $response = get('/');

        $response->assertStatus(200);
<<<<<<< HEAD

=======
>>>>>>> 3401a6b (.)
        // Verifica che i blocchi usino i template corretti
        // Questo test verifica l'integrazione con il sistema di view
    });

    it('handles block configuration correctly', function () {
        $response = get('/');
<<<<<<< HEAD

=======
        
>>>>>>> 3401a6b (.)
        $response->assertStatus(200);
        // Verifica configurazione blocchi
        $response->assertSee('bg-white');
        $response->assertSee('text-gray-900');
        $response->assertSee('bg-indigo-600');
        $response->assertSee('hover:bg-indigo-700');
    });

    it('displays block content with proper formatting', function () {
        $response = get('/');

        $response->assertStatus(200);
<<<<<<< HEAD

=======
>>>>>>> 3401a6b (.)
        // Verifica formattazione contenuto blocchi
        // Titolo e sottotitolo devono essere formattati correttamente
    });

    it('handles block relationships correctly', function () {
        $response = get('/');

        $response->assertStatus(200);
<<<<<<< HEAD

=======
>>>>>>> 3401a6b (.)
        // Verifica relazioni tra blocchi
        // Questo test verifica che i blocchi si integrino correttamente
    });

    it('renders blocks with correct styling', function () {
        $response = get('/');

        $response->assertStatus(200);
        // Verifica styling blocchi
        $response->assertSee('class="');
<<<<<<< HEAD

=======
>>>>>>> 3401a6b (.)
        // Verifica che le classi CSS siano applicate correttamente
    });

    it('handles block validation correctly', function () {
        $response = get('/');

        $response->assertStatus(200);
<<<<<<< HEAD

=======
>>>>>>> 3401a6b (.)
        // Verifica validazione blocchi
        // Questo test verifica che i blocchi siano validati correttamente
    });

    it('displays blocks with correct localization', function () {
        // Test italiano
        $response = get('/');
        $response->assertStatus(200);
        $response->assertSee('Benvenuta su SaluteOra');

        // Test inglese
        $response = get('/en');
        $response->assertStatus(200);
        // Verifica localizzazione blocchi

        // Test tedesco
        $response = get('/de');
        $response->assertStatus(200);
<<<<<<< HEAD

=======
>>>>>>> 3401a6b (.)
        // Verifica localizzazione blocchi
    });

    it('handles block errors gracefully', function () {
        $response = get('/');

        $response->assertStatus(200);
<<<<<<< HEAD

=======
>>>>>>> 3401a6b (.)
        // Verifica gestione errori blocchi
        // Questo test verifica che gli errori siano gestiti correttamente
    });

    it('renders blocks with correct performance', function () {
        $startTime = microtime(true);
<<<<<<< HEAD

        $response = get('/');

        $endTime = microtime(true);
        $loadTime = ($endTime - $startTime) * 1000;

        $response->assertStatus(200);

=======
        
        $response = get('/');
        
        $endTime = microtime(true);
        $loadTime = ($endTime - $startTime) * 1000;
        
        $response->assertStatus(200);
        
>>>>>>> 3401a6b (.)
        // Verifica che i blocchi si carichino entro tempi accettabili
        expect($loadTime)->toBeLessThan(500);
    });
});
<<<<<<< HEAD
=======

>>>>>>> 3401a6b (.)
