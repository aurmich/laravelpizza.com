<?php

<<<<<<< HEAD
declare(strict_types=1);


=======
>>>>>>> f1d4085 (.)
namespace Modules\Xot\Tests\Feature;

use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * Test per verificare il corretto funzionamento dello script fix_structure.sh.
 */
class FixStructureTest extends TestCase
{
    private string $testDir;

    protected function setUp(): void
    {
        parent::setUp();

        // Creiamo una directory temporanea per i test
        $this->testDir = sys_get_temp_dir() . '/fix_structure_test_' . uniqid();
<<<<<<< HEAD
        mkdir($this->testDir, 0o755, true);
=======
        mkdir($this->testDir, 0755, true);
>>>>>>> f1d4085 (.)

        // Impostiamo la directory di lavoro
        chdir($this->testDir);
    }

    protected function tearDown(): void
    {
        // Puliamo la directory di test
        $this->rrmdir($this->testDir);

        parent::tearDown();
    }

    /**
     * Funzione ricorsiva per eliminare una directory con tutti i suoi contenuti.
     */
    private function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
<<<<<<< HEAD
                if ($object !== '.' && $object !== '..') {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $object) && !is_link($dir . '/' . $object)) {
                        $this->rrmdir($dir . DIRECTORY_SEPARATOR . $object);
                    } else {
                        unlink($dir . DIRECTORY_SEPARATOR . $object);
=======
                if ($object != "." && $object != "..") {
                    if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object)) {
                        $this->rrmdir($dir. DIRECTORY_SEPARATOR .$object);
                    } else {
                        unlink($dir. DIRECTORY_SEPARATOR .$object);
>>>>>>> f1d4085 (.)
                    }
                }
            }
            rmdir($dir);
        }
    }

    #[Test]
    public function testMoveToAppFunctionality(): void
    {
        // Creiamo una struttura di directory di test
<<<<<<< HEAD
        mkdir($this->testDir . '/Actions', 0o755, true);
=======
        mkdir($this->testDir . '/Actions', 0755, true);
>>>>>>> f1d4085 (.)
        file_put_contents($this->testDir . '/Actions/test.php', '<?php echo "test";');

        // Copiamo lo script nella directory di test
        $script = base_path('../bashscripts/fix_structure.sh');
        $scriptContent = file_get_contents($script);
        file_put_contents($this->testDir . '/fix_structure.sh', $scriptContent);
<<<<<<< HEAD
        chmod($this->testDir . '/fix_structure.sh', 0o755);
=======
        chmod($this->testDir . '/fix_structure.sh', 0755);
>>>>>>> f1d4085 (.)

        // Eseguiamo lo script
        exec('cd ' . $this->testDir . ' && ./fix_structure.sh');

        // Verifichiamo che la cartella Actions sia stata spostata in app/
<<<<<<< HEAD
        static::assertDirectoryExists($this->testDir . '/app/Actions');
        static::assertFileExists($this->testDir . '/app/Actions/test.php');
        static::assertDirectoryDoesNotExist($this->testDir . '/Actions');
=======
        $this->assertDirectoryExists($this->testDir . '/app/Actions');
        $this->assertFileExists($this->testDir . '/app/Actions/test.php');
        $this->assertDirectoryDoesNotExist($this->testDir . '/Actions');
>>>>>>> f1d4085 (.)
    }

    #[Test]
    public function testRenameToLowerFunctionality(): void
    {
        // Creiamo una struttura di directory di test
<<<<<<< HEAD
        mkdir($this->testDir . '/Config', 0o755, true);
=======
        mkdir($this->testDir . '/Config', 0755, true);
>>>>>>> f1d4085 (.)
        file_put_contents($this->testDir . '/Config/test.php', '<?php echo "test";');

        // Copiamo lo script nella directory di test
        $script = base_path('../bashscripts/fix_structure.sh');
        $scriptContent = file_get_contents($script);
        file_put_contents($this->testDir . '/fix_structure.sh', $scriptContent);
<<<<<<< HEAD
        chmod($this->testDir . '/fix_structure.sh', 0o755);
=======
        chmod($this->testDir . '/fix_structure.sh', 0755);
>>>>>>> f1d4085 (.)

        // Eseguiamo lo script
        exec('cd ' . $this->testDir . ' && ./fix_structure.sh');

        // Verifichiamo che la cartella Config sia stata rinominata in config
<<<<<<< HEAD
        static::assertDirectoryExists($this->testDir . '/config');
        static::assertFileExists($this->testDir . '/config/test.php');
        static::assertDirectoryDoesNotExist($this->testDir . '/Config');
=======
        $this->assertDirectoryExists($this->testDir . '/config');
        $this->assertFileExists($this->testDir . '/config/test.php');
        $this->assertDirectoryDoesNotExist($this->testDir . '/Config');
>>>>>>> f1d4085 (.)
    }

    #[Test]
    public function testMoveConfigFunctionality(): void
    {
        // Creiamo una struttura di directory di test con entrambe le versioni
<<<<<<< HEAD
        mkdir($this->testDir . '/Config', 0o755, true);
        file_put_contents($this->testDir . '/Config/main.php', '<?php echo "main";');

        mkdir($this->testDir . '/config', 0o755, true);
=======
        mkdir($this->testDir . '/Config', 0755, true);
        file_put_contents($this->testDir . '/Config/main.php', '<?php echo "main";');

        mkdir($this->testDir . '/config', 0755, true);
>>>>>>> f1d4085 (.)
        file_put_contents($this->testDir . '/config/secondary.php', '<?php echo "secondary";');

        // Copiamo lo script nella directory di test
        $script = base_path('../bashscripts/fix_structure.sh');
        $scriptContent = file_get_contents($script);
        file_put_contents($this->testDir . '/fix_structure.sh', $scriptContent);
<<<<<<< HEAD
        chmod($this->testDir . '/fix_structure.sh', 0o755);
=======
        chmod($this->testDir . '/fix_structure.sh', 0755);
>>>>>>> f1d4085 (.)

        // Eseguiamo lo script
        exec('cd ' . $this->testDir . ' && ./fix_structure.sh');

        // Verifichiamo che i contenuti siano stati uniti e che la cartella minuscola contenga tutto
<<<<<<< HEAD
        static::assertDirectoryExists($this->testDir . '/config');
        static::assertFileExists($this->testDir . '/config/main.php');
        static::assertFileExists($this->testDir . '/config/secondary.php');
        static::assertDirectoryDoesNotExist($this->testDir . '/Config');
        static::assertDirectoryExists($this->testDir . '/config_old');
=======
        $this->assertDirectoryExists($this->testDir . '/config');
        $this->assertFileExists($this->testDir . '/config/main.php');
        $this->assertFileExists($this->testDir . '/config/secondary.php');
        $this->assertDirectoryDoesNotExist($this->testDir . '/Config');
        $this->assertDirectoryExists($this->testDir . '/config_old');
>>>>>>> f1d4085 (.)
    }
}
