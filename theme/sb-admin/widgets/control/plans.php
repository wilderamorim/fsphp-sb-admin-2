<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-fw fa-dollar-sign"></i>
            Planos
        </h1>

        <div class="form-group text-right">
            <a href="<?= url("/admin/control/plan"); ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                </span>
                <span class="text">Novo Plano</span>
            </a>
        </div>
    </div>

    <?php if ($plans): ?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Planos</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Assinantes</th>
                            <th>Recorrência</th>
                            <th>Período</th>
                            <th>Preço</th>
                            <th>Status</th>
                            <th>Editar</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Nome</th>
                            <th>Assinantes</th>
                            <th>Recorrência</th>
                            <th>Período</th>
                            <th>Preço</th>
                            <th>Status</th>
                            <th>Editar</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($plans as $plan): ?>
                            <tr>
                                <td><?= $plan->name; ?></td>
                                <td><?= str_pad($plan->subscribers()->count(), 3, 0, 0); ?></td>
                                <td>R$ <?= str_price($plan->recurrence()); ?></td>
                                <td><?= str_title($plan->period_str); ?></td>
                                <td>R$ <?= str_price($plan->price); ?></td>
                                <td>
                                    <?php if ($plan->status == "active"): ?>
                                        <span class="text-success">Ativo</span>
                                    <?php else: ?>
                                        <span class="text-danger">Inativo</span>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <a href="<?= url("/admin/control/plan/{$plan->id}"); ?>" class="btn btn-info btn-circle btn-sm">
                                        <i class="fas fa-pen-alt"></i>
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

    <?php else: ?>
        <?= alert_info("Ainda não existem planos cadastrados.", "w-50"); ?>
    <?php endif; ?>

</div>