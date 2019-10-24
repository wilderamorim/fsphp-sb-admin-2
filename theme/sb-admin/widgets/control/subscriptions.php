<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-fw fa-star"></i>
            Assinaturas
        </h1>

        <!-- Search -->
        <form action="<?= url("/admin/control/subscriptions"); ?>"
              class="d-none d-sm-inline-block form-inline ml-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="search" name="s" value="<?= $search; ?>"
                       placeholder="Pesquisar assinante..."
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

    <?php if (!$subscriptions): ?>
        <?php if (empty($search)): ?>
            <?= alert_info("Ainda não existem assinantes em seu APP, assim que eles começarem a chegar você verá os mais recentes aqui. Esperamos que seja em breve :)", "w-50"); ?>
        <?php else: ?>
            <?= alert_warning("Não foram encontrados assinantes com NOME, SOBRENOME ou EMAIL igual a <b>$search</b>. Você pode tentar outros termos...", "w-50"); ?>
        <?php endif; ?>
    <?php else: ?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Assinantes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Plano</th>
                            <th>Desde</th>
                            <th>Gerenciar</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Usuário</th>
                            <th>Plano</th>
                            <th>Desde</th>
                            <th>Gerenciar</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($subscriptions as $subscription): ?>
                            <tr>
                                <td><?= $subscription->user()->fullName(); ?></td>
                                <td>
                                    <?= $subscription->plan()->name; ?>
                                    - R$ <?= str_price($subscription->plan()->price) . " /{$subscription->plan()->period_str}"; ?>
                                </td>
                                <td><?= date_fmt($subscription->started, "d.m.y"); ?></td>
                                <td>
                                    <a href="<?= url("/admin/control/subscription/{$subscription->id}"); ?>" class="btn btn-info btn-circle btn-sm">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?= $paginator; ?>

    <?php endif; ?>

</div>