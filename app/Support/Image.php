<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;

class Image
{
    public static function make(mixed $source): ImageProxy
    {
        if ($source instanceof UploadedFile) {
            $source = $source->getRealPath();
        }

        return new ImageProxy((new ImageManager(GdDriver::class))->decode($source));
    }
}

class ImageProxy
{
    public function __construct(private ImageInterface $image)
    {
    }

    public function orientate(): self
    {
        $this->image->orient();

        return $this;
    }

    public function resize(?int $width, ?int $height, ?callable $callback = null): self
    {
        $keepRatio = false;

        if ($callback) {
            $constraint = new class
            {
                public bool $aspectRatio = false;

                public function aspectRatio(): void
                {
                    $this->aspectRatio = true;
                }

                public function upsize(): void
                {
                    // Intentionally unused; retained for Intervention v2 callback compatibility.
                }
            };

            $callback($constraint);
            $keepRatio = $constraint->aspectRatio;
        }

        if ($keepRatio) {
            if ($width && ! $height) {
                $this->image->scale(width: $width);
            } elseif ($height && ! $width) {
                $this->image->scale(height: $height);
            } else {
                $this->image->scale(width: $width, height: $height);
            }
        } else {
            $this->image->resize($width, $height);
        }

        return $this;
    }

    public function rotate(float $angle): self
    {
        $this->image->rotate($angle);

        return $this;
    }

    public function stream(): string
    {
        return (string) $this->image->encode();
    }
}
