<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerVhmgMz5\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerVhmgMz5/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerVhmgMz5.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerVhmgMz5\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerVhmgMz5\App_KernelDevDebugContainer([
    'container.build_hash' => 'VhmgMz5',
    'container.build_id' => '1001474c',
    'container.build_time' => 1705878437,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerVhmgMz5');
