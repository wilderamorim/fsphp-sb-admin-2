<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            Controle
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assinantes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= str_pad($stats->subscriptions, 5, 0, 0); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Por 30 dias</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= str_pad($stats->subscriptionsMonth, 5, 0, 0); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Este mês</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?= str_price($stats->recurrenceMonth); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Recorrência</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?= str_price($stats->recurrence); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($subscriptions): ?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Assinaturas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Plano</th>
                            <th>Situação</th>
                            <th>Data</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Nome</th>
                            <th>Plano</th>
                            <th>Situação</th>
                            <th>Data</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($subscriptions as $subscription): ?>
                            <tr>
                                <td><?= $subscription->user()->fullName(); ?></td>
                                <td>
                                    <?= $subscription->plan()->name; ?>
                                    - R$ <?= str_price($subscription->plan()->price) . "/{$subscription->plan()->period_str}"; ?>
                                </td>
                                <td><?= ($subscription->status == "active" ? "Ativa" : "Inativa"); ?></td>
                                <td><?= date_fmt($subscription->created_at, "d.m.y \- H\hm"); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?= alert_info("Ainda não existem assinantes em seu APP, assim que eles começarem a chegar você verá os mais recentes aqui. Esperamos que seja em breve :)", "w-50"); ?>
    <?php endif; ?>

</div>