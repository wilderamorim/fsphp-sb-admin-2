<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-fw fa-blog"></i>
            Blog
        </h1>

        <!-- Search -->
        <form action="<?= url("/admin/blog/home"); ?>"
              class="d-none d-sm-inline-block form-inline ml-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="search" name="s" value="<?= $search; ?>"
                       placeholder="Pesquisar artigo..."
                       aria-label="Search" aria-describedby="basic-addon2"
                       class="form-control bg-white border-0 small">
                <div class="input-group-append">
                    <button class="btn btn-primary">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <?php if ($posts): ?>
    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-6 col-lg-4 col-xl-3 d-flex">
                <article class="card text-center mb-4 w-100">
                    <?= photo_img($post->cover, $post->title, 426, 240, null, "card-img-top"); ?>
                    <small class="p-2 d-flex justify-content-between">
                        <a href="<?= url("/admin/blog/category/{$post->category()->id}"); ?>" class="text-decoration-none text-gray-500">
                            <i class="fas fa-fw fa-bookmark"></i>
                            <?= $post->category()->title; ?></a>
                        <a href="<?= url("/admin/users/user/{$post->author()->id}"); ?>" class="text-decoration-none text-gray-500">
                            <?= $post->author()->first_name; ?>
                            <i class="fas fa-fw fa-user"></i>
                        </a>
                    </small>
                    <div class="card-body">
                        <h3 class="card-title h6">
                            <a href="<?= url("/blog/{$post->uri}"); ?>" target="_blank" class="text-decoration-none">
                                <?= $post->title; ?>
                            </a>
                        </h3>
                        <p class="card-text small text-muted">
                            <i class="fas fa-fw fa-eye"></i>
                            <?= $post->views; ?>
                            &nbsp;
                            <?php if ($post->status == "post"): ?>
                                <span class="text-success">
                                    <i class="fas fa-fw fa-check"></i>
                                    Publicado
                                </span>
                            <?php elseif ($post->status == "draft"): ?>
                                <span class="text-warning">
                                    <i class="fas fa-fw fa-pen-alt"></i>
                                    Rascunho
                                </span>
                            <?php elseif ($post->status == "trash"): ?>
                                <span class="text-danger">
                                    <i class="fas fa-fw fa-trash"></i>
                                    Excluído
                                </span>
                            <?php endif; ?>
                        </p>

                        <a href="<?= url("/admin/blog/post/{$post->id}"); ?>" class="btn btn-sm btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-pen-alt"></i>
                            </span>
                            <span class="text">Editar</span>
                        </a>
                        &nbsp;
                        <a href="#" class="btn btn-sm btn-danger btn-icon-split"
                           data-post="<?= url("/admin/blog/post"); ?>"
                           data-action="delete"
                           data-confirm="Tem certeza que deseja deletar esse post?"
                           data-post_id="<?= $post->id; ?>">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Deletar</span>
                        </a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <?php if ($post->post_at > date("Y-m-d H:i:s")): ?>
                                <span class="text-info">
                                    <i class="fas fa-clock"></i>
                                    Agendado para <?= date_fmt($post->post_at, "d/m \à\s H\hi"); ?>
                                </span>
                            <?php else: ?>
                                <i class="fas fa-check"></i>
                                Publicado em <?= date_fmt($post->post_at, "d/m \à\s H\hi"); ?>
                            <?php endif; ?>
                        </small>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>

    <?= $paginator; ?>

    <?php else: ?>
        <?= alert_info("Ainda não existem artigos cadastrados no blog.", "w-50"); ?>
    <?php endif; ?>

</div>

