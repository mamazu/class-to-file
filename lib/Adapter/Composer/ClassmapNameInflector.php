<?php

namespace DTL\ClassFileConverter\Adapter\Composer;

use DTL\ClassFileConverter\Domain\ClassName;
use DTL\ClassFileConverter\Domain\FilePath;

final class ClassmapNameInflector implements NameInflector
{
    public function inflectToRelativePath(string $prefix, ClassName $className, string $mappedPath): FilePath
    {
        return FilePath::fromString($mappedPath);
    }

    public function inflectToClassName(FilePath $filePath, string $pathPrefix, string $classPrefix): ClassName
    {
        $className = substr($filePath, strlen($pathPrefix) + 1);
        $className = str_replace('/', '\\', $className);
        $className = preg_replace('{\.(.+)$}', '', $className);

        return ClassName::fromString($className);
    }
}
