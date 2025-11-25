<?php

declare(strict_types=1);

namespace Modules\UI\Actions\Icon;

use ReflectionClass;
use Exception;
use BladeUI\Icons\Factory as IconFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Spatie\QueueableAction\QueueableAction;

class GetAllIconsAction
{
    use QueueableAction;

    /**
     * @return array
     */
<<<<<<< HEAD
    public function execute(string $_context = 'form')
    {
        $iconsFactory = App::make(IconFactory::class);

=======
    public function execute(string $context = 'form')
    {
        $iconsFactory = App::make(IconFactory::class);
        
>>>>>>> 727968c (.)
        // Uso reflection per accedere alle icone in modo sicuro
        try {
            $reflection = new ReflectionClass($iconsFactory);
            $property = $reflection->getProperty('iconSets');
            $property->setAccessible(true);
            $icons = $property->getValue($iconsFactory);
        } catch (Exception $e) {
            // Fallback: restituisci array vuoto se non riesci ad accedere
            return [];
        }

        // Verifica che $icons sia un array prima di usare Arr::map()
        if (!is_array($icons)) {
            return [];
        }

        $icons = Arr::map($icons, function (array $set, array|string $name) {
            $set['name'] = $name;
            $icons = [];

            foreach ($set['paths'] as $path) {
                foreach (File::allFiles($path) as $file) {
                    // Simply ignore files that aren't SVGs
                    if ('svg' !== $file->getExtension()) {
                        continue;
                    }

                    // $iconName = $this->getIconName($file, parentPath: $path, prefix: $prefix);
                    $iconName = str($file->getPathname())
<<<<<<< HEAD
                        ->after($path . DIRECTORY_SEPARATOR)
=======
                        ->after($path.DIRECTORY_SEPARATOR)
>>>>>>> 727968c (.)
                        ->replace(DIRECTORY_SEPARATOR, '.')
                        ->basename('.svg')
                        ->toString();

<<<<<<< HEAD
                    $icons[] = $set['prefix'] . '-' . $iconName;
=======
                    $icons[] = $set['prefix'].'-'.$iconName;
>>>>>>> 727968c (.)
                }
            }
            $set['icons'] = $icons;

            return $set;
        });

        return $icons;
    }
}
