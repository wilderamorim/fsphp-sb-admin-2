<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-fw fa-user"></i>
            Usuários
        </h1>

        <!-- Search -->
        <form action="<?= url("/admin/users/home"); ?>"
              class="d-none d-sm-inline-block form-inline ml-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="search" name="s" value="<?= $search; ?>"
                       placeholder="Pesquisar usuário..."
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

    <div class="row">
        <?php foreach ($users as $user): ?>
            <div class="col-md-6 col-lg-4 col-xl-3 d-flex">
                <article class="card text-center mb-4 w-100">
                    <div class="card-body">
                        <figure>
                            <?= photo_img($user->photo(), $user->fullName(), 128, 128, CONF_IMAGE_DEFAULT_AVATAR, "rounded-circle mx-auto", "width: 128px"); ?>
                        </figure>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <?php if ($user->level >= 5): ?>
                                <i class="fas fa-user-plus"></i>
                                Admin
                            <?php else: ?>
                                <i class="fas fa-user"></i>
                                Usuário
                            <?php endif; ?>
                        </h6>
                        <h3 class="card-title h5"><?= $user->fullName(); ?></h3>
                        <p class="card-text small text-muted">
                            <i class="fas fa-fw fa-envelope"></i>
                            <?= $user->email; ?>
                        </p>

                        <a href="<?= url("/admin/users/user/{$user->id}"); ?>" class="btn btn-sm btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-cog"></i>
                            </span>
                            <span class="text">Gerenciar</span>
                        </a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            Desde <?= date_fmt($user->created_at, "d.m.y \à\s H\hi"); ?>
                        </small>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>

    <?= $paginator; ?>

</div>