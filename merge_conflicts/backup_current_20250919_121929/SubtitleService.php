<?php

declare(strict_types=1);

namespace Modules\Media\Services;

use SimpleXMLElement;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;

use function Safe\file_put_contents;
use function Safe\fopen;
use function Safe\realpath;
use function Safe\simplexml_load_string;

/**
 * SubtitleService.
 */
class SubtitleService
{
    public string $disk = 'media';

    // nome che usa storage
    public string $file_path;

    public string $field_name = 'txt';

    public array $subtitles = [];

    public Model $model;

<<<<<<< HEAD
    private static null|self $instance = null;
=======
    private static ?self $instance = null;
>>>>>>> 0a466ed (.)

    /**
     * ---.
     */
    public static function getInstance(): self
    {
<<<<<<< HEAD
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
=======
        if (! self::$instance instanceof self) {
            self::$instance = new self;
>>>>>>> 0a466ed (.)
        }

        return self::$instance;
    }

    /**
     * ---.
     */
    public static function make(): self
    {
        return static::getInstance();
    }

    public function setFilePath(string $file_path): static
    {
        $this->file_path = $file_path;

        return $this;
    }

    public function setModel(Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function upateModel(): static
    {
        $plain = $this->getPlain();
        $up = [$this->field_name => $plain];
        $this->model = tap($this->model)->update($up);

        return $this;
    }

    /**
     * Undocumented function.
     */
    public function getPlain(): string
    {
        $content = $this->getContent();
        $xmlObject = simplexml_load_string($content);
        $txt = '';
        foreach ($xmlObject->annotation->type->sentence as $sentence) {
            foreach ($sentence->item as $item) {
<<<<<<< HEAD
                $txt .= $item->__toString() . ' ';
=======
                $txt .= $item->__toString().' ';
>>>>>>> 0a466ed (.)
            }
        }

        return $txt;
    }

    /**
     * restituisce i sottotitoli, dal file ..
     */
    public function get(): array
    {
        $info = pathinfo($this->file_path);
<<<<<<< HEAD
        if (!isset($info['extension'])) {
            return [];
        }

        $func = 'getFrom' . Str::studly($info['extension']);
=======
        if (! isset($info['extension'])) {
            return [];
        }

        $func = 'getFrom'.Str::studly($info['extension']);
>>>>>>> 0a466ed (.)

        Assert::isArray($res = $this->{$func}());

        return $res;
    }

    /**
     * Undocumented function.
     */
    public function getContent(): string
    {
        $path = realpath($this->file_path);

        return File::get($path);
    }

    /**
     * @return array<int, array<string, float|int|string|mixed>>
     *
     * @psalm-return list{0?: array{sentence_i: int<0, max>, item_i: int<0, max>, start: float|int, end: float|int, time: string, text: mixed},...}
     */
    public function getFromXml(): array
    {
        $this->subtitles = [];
        $content = $this->getContent();
        $xmlObject = simplexml_load_string($content);

        $data = [];
        $sentence_i = 0;
        foreach ($xmlObject->annotation->type->sentence as $sentence) {
            $item_i = 0;
            foreach ($sentence->item as $item) {
                $attributes = $item->attributes();

<<<<<<< HEAD
                if (!($attributes instanceof SimpleXMLElement)) {
                    throw new Exception('[' . __LINE__ . '][' . class_basename($this) . ']');
                }

                // 00:06:35,360
                $start = ((int) $attributes->start->__toString()) / 1000;
                $end = ((int) $attributes->end->__toString()) / 1000;
=======
                if (! $attributes instanceof SimpleXMLElement) {
                    throw new Exception('['.__LINE__.']['.class_basename($this).']');
                }

                // 00:06:35,360
                $start = (int) $attributes->start->__toString() / 1000;
                $end = (int) $attributes->end->__toString() / 1000;
>>>>>>> 0a466ed (.)
                // dddx([$start,$this->secondsToHms($start),$end,$this->secondsToHms($end)]);
                $tmp = [
                    // 'id' => $i++,
                    'sentence_i' => $sentence_i,
                    'item_i' => $item_i,
                    'start' => $start,
                    'end' => $end,
<<<<<<< HEAD
                    'time' => secondsToHms($start) . ',' . secondsToHms($end),
=======
                    'time' => secondsToHms($start).','.secondsToHms($end),
>>>>>>> 0a466ed (.)
                    'text' => $item->__toString(),
                ];
                $data[] = $tmp;
                $item_i++;
            }

            $sentence_i++;
        }

        return $data;
    }

    /**
     * Undocumented function.
     *
     * @param  string $srtFile
     * @param  string $webVttFile
     */
    public function srtToVtt($srtFile, $webVttFile): void
    {
        $fileHandle = fopen(public_path($srtFile), 'r');
        $lines = [];
        if ($fileHandle) {
            // $lines = [];
            while (($line = fgets($fileHandle, 8192)) !== false) {
                $lines[] = $line;
            }

<<<<<<< HEAD
            if (!feof($fileHandle)) {
=======
            if (! feof($fileHandle)) {
>>>>>>> 0a466ed (.)
                exit("Error: unexpected fgets() fail\n");
            }

            // ($fileHandle);
        }

        $length = \count($lines);
        for ($index = 1; $index < $length; $index++) {
            if ($index === 1 || trim($lines[$index - 2]) === '') {
                $lines[$index] = str_replace(',', '.', $lines[$index]);
            }
        }

        $header = "WEBVTT\n\n";

<<<<<<< HEAD
        file_put_contents(public_path($webVttFile), $header . implode('', $lines));
=======
        file_put_contents(public_path($webVttFile), $header.implode('', $lines));
>>>>>>> 0a466ed (.)
    }
}
