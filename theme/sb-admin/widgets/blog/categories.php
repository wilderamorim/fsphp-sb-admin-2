<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-fw fa-bookmark"></i>
            Categorias
        </h1>

        <div class="form-group text-right">
            <a href="<?= url("/admin/blog/category"); ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                </span>
                <span class="text">Nova Categoria</span>
            </a>
        </div>
    </div>

    <?php if ($categories): ?>
    <div class="row">
        <?php foreach ($categories as $category): ?>
        <div class="col-xl-6">
            <article class="card mb-4">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <?= photo_img($category->cover, $category->title, 426, 426, CONF_IMAGE_NO_AVAILABLE_1BY1, "card-img"); ?>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title h5"><?= $category->title; ?></h3>
                            <p class="card-text"><?= $category->description; ?></p>
                            <a href="<?= url("/admin/blog/category/{$category->id}"); ?>" class="btn btn-sm btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-pen-alt"></i>
                            </span>
                                <span class="text">Editar</span>
                            </a>
                            &nbsp;
                            <a href="#" class="btn btn-sm btn-danger btn-icon-split"
                               data-post="<?= url("/admin/blog/category"); ?>"
                               data-action="delete"
                               data-confirm="Tem certeza que deseja deletar a categoria?"
                               data-category_id="<?= $category->id; ?>">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                                <span class="text">Deletar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <?php endforeach; ?>
    </div>

    <?= $paginator; ?>

    <?php else: ?>
        <?= alert_info("Ainda não existem categorias cadastradas em seu blog", "w-50"); ?>
    <?php endif; ?>

</div>

