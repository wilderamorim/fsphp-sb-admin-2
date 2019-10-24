<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <?php if (!$category): ?>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-fw fa-plus-circle"></i>
                Nova Categoria
            </h1>
        </div>

        <form action="<?= url("/admin/blog/category"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="create"/>

            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title"  id="title" placeholder="O nome da categoria" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" rows="3" placeholder="Sobre esta categoria" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="cover">Foto</label>
                <input type="file" name="cover" id="cover" class="form-control-file">
            </div>

            <div class="form-group text-right">
                <button class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Cadastrar</span>
                </button>
            </div>
        </form>
    <?php else: ?>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-fw fa-bookmark"></i>
                <?= $category->title; ?>
            </h1>
        </div>

        <figure class="figure">
            <?= photo_img($category->cover, $category->title, 256, 144, null, "figure-img img-fluid rounded img-thumbnail", "max-width: 256px"); ?>
        </figure>

        <form action="<?= url("/admin/blog/category/{$category->id}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="update"/>

            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title"  id="title" value="<?= $category->title; ?>" placeholder="O nome da categoria" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" rows="3" placeholder="Sobre esta categoria" class="form-control" required><?= $category->description; ?></textarea>
            </div>

            <div class="form-group">
                <label for="cover">Foto</label>
                <input type="file" name="cover" id="cover" class="form-control-file">
            </div>

            <div class="form-group text-right">
                <button class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                    <span class="text">Atualizar</span>
                </button>
            </div>
        </form>
    <?php endif; ?>

</div>

