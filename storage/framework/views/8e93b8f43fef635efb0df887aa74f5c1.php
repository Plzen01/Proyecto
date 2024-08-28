<?php $__env->startSection('titulo', 'Publicaciones'); ?>

<?php $__env->startSection('contenido'); ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="flex justify-center text-center mb-3">
        <h1>Todas las publicaciones</h1>
    </div>

    <!-- Filtro de categorías -->
    <div class="flex justify-center mb-4">
        <form action="<?php echo e(route('publicaciones.index')); ?>" method="GET">
            <div class="flex items-center">
                <label for="categoria" class="mr-2">Filtrar por categoría:</label>
                <select name="categoria" id="categoria" class="form-select">
                    <option value="">Todas las categorías</option>
                    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($categoria->id); ?>" <?php echo e($categoria->id == $categoriaSeleccionada ? 'selected' : ''); ?>>
                            <?php echo e($categoria->nombre); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button type="submit" class="btn btn-primary ml-2">Filtrar</button>
            </div>
        </form>
    </div>

    <?php if(auth()->guard()->check()): ?>
        <div class="flex mb-2 justify-end">
            <a href="<?php echo e(route('publicaciones.crear')); ?>" class="btn btn-outline-primary">Crear Nueva Publicacion</a>
            <?php if(auth()->check() && auth()->user()->administrador): ?>
                <a href="<?php echo e(route('categorias.create')); ?>" class="btn btn-outline-secondary">Crear Categoría</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php $__empty_1 = true; $__currentLoopData = $publicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card text-center mb-3 border border-green-500 rounded-lg shadow-sm">
            <div class="card-header bg-gray-100 text-lg font-semibold">
                <?php echo e($publicacion->titulo); ?>

            </div>
            <div class="card-body p-4">
                <p class="card-text"><?php echo e($publicacion->contenido); ?></p>
                <a href="<?php echo e(route('publicacion.show', ['id' => $publicacion->id])); ?>" class="btn btn-primary bg-green-600 hover:bg-green-700">Ver publicación</a>
            </div>
            <div class="card-footer text-gray-500 text-sm">
                Publicado por: <?php echo e($publicacion->usuario->name); ?> | <?php echo e($publicacion->created_at->format('d M Y')); ?>

            </div>
            <!-- Botones de editar y eliminar -->
            <?php if(auth()->check() && (auth()->id() === $publicacion->user_id || auth()->user()->administrador)): ?>
                <div class="card-footer text-right">
                    <a href="<?php echo e(route('publicacion.editar', $publicacion->id)); ?>" class="btn btn-primary">Editar</a>

                    <!-- Botón de eliminar con modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo e($publicacion->id); ?>">
                        Eliminar
                    </button>

                    <!-- Modal de confirmación -->
                    <div class="modal fade" id="modalEliminar<?php echo e($publicacion->id); ?>" tabindex="-1" aria-labelledby="modalEliminarLabel<?php echo e($publicacion->id); ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEliminarLabel<?php echo e($publicacion->id); ?>">Confirmar eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar esta publicación?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="<?php echo e(route('publicacion.destroy', $publicacion->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <h1>No hay publicaciones</h1>
    <?php endif; ?>

    <?php echo e($publicaciones->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ProyectoR\resources\views/publicaciones/index.blade.php ENDPATH**/ ?>