<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <?php if (!$plan): ?>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-fw fa-plus-circle"></i>
                Novo Plano
            </h1>
        </div>

        <form action="<?= url("/admin/control/plan"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="create"/>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Plano</label>
                    <input type="text" name="name"  id="name" placeholder="Nome do plano" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="price">Preço</label>
                    <input type="text" name="price"  id="price" class="mask-money form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="period">Período</label>
                    <select name="period" id="period" class="form-control" required>
                        <option value="1month">Mensal</option>
                        <option value="1year">Anual</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="period_str">Inf. de período</label>
                    <select name="period_str" id="period_str" class="form-control" required>
                        <option value="mês">Mês</option>
                        <option value="ano">Ano</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="active">Ativa</option>
                        <option value="inactive">Inativa</option>
                    </select>
                </div>
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
                <i class="fas fa-fw fa-pen-alt"></i>
                Editar Plano
            </h1>
        </div>

        <form action="<?= url("/admin/control/plan/{$plan->id}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="update"/>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Plano</label>
                    <input type="text" name="name" id="name" value="<?= $plan->name; ?>" placeholder="Nome do plano" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="price">Preço</label>
                    <input type="text" name="price" id="price" value="<?= str_price($plan->price); ?>" class="mask-money form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="period">Período</label>
                    <select name="period" id="period" class="form-control" required>
                        <?php
                        $period = $plan->period;
                        $selected = function ($value) use ($period) {
                            return ($period == $value ? "selected" : "");
                        };
                        ?>
                        <option <?= $selected("1month"); ?> value="1month">Mensal</option>
                        <option <?= $selected("1year"); ?> value="1year">Anual</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="period_str">Inf. de período</label>
                    <select name="period_str" id="period_str" class="form-control" required>
                        <?php
                        $period = $plan->period_str;
                        $selected = function ($value) use ($period) {
                            return ($period == $value ? "selected" : "");
                        };
                        ?>
                        <option <?= $selected("mês"); ?> value="mês">Mês</option>
                        <option <?= $selected("ano"); ?> value="ano">Ano</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <?php
                        $status = $plan->status;
                        $selected = function ($value) use ($status) {
                            return ($status == $value ? "selected" : "");
                        };
                        ?>
                        <option <?= $selected("active"); ?> value="active">Ativo</option>
                        <option <?= $selected("inactive"); ?> value="inactive">Inativo</option>
                    </select>
                </div>
            </div>

            <div <?= (!$subscribers ? 'class="form-row"' : null); ?>>
                <?php if (!$subscribers): ?>
                <div class="form-group col-md-6">
                    <a href="#" class="btn btn-danger btn-icon-split"
                       data-post="<?= url("/admin/control/plan"); ?>"
                       data-action="delete"
                       data-confirm="Tem certeza que deseja excluir este plano?"
                       data-plan_id="<?= $plan->id; ?>">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Excluir</span>
                    </a>
                </div>
                <?php endif; ?>
                <div class="form-group <?= (!$subscribers ? "col-md-6" : null); ?> text-right">
                    <button class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Atualizar</span>
                    </button>
                </div>
            </div>
        </form>
    <?php endif; ?>

</div>

