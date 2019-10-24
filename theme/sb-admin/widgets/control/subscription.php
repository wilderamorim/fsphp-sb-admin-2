<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-fw fa-plus-circle"></i>
            Assinatura #<?= str_pad($subscription->id, 3, 0, 0); ?> de <?= $subscription->user()->fullName(); ?>
        </h1>
    </div>

    <form action="<?= url("/admin/control/subscription/{$subscription->id}"); ?>" method="post">
        <!--ACTION SPOOFING-->
        <input type="hidden" name="action" value="update"/>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="plan_id">Plano</label>
                <select name="plan_id" id="plan_id" class="form-control" required>
                    <?php foreach ($plans as $plan):
                        $plan_id = $subscription->plan()->id;
                        $selected = function ($value) use ($plan_id) {
                            return ($plan_id == $value ? "selected" : "");
                        };
                        ?>
                        <option <?= $selected($plan->id); ?> value="<?= $plan->id; ?>"><?= $plan->name; ?> -
                            R$ <?= str_price($plan->price); ?>/<?= $plan->period_str; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="card_id">Cartão</label>
                <select name="card_id" id="card_id" class="form-control" required>
                    <?php if ($cards): ?>
                        <?php foreach ($cards as $card):
                            $card_id = $subscription->creditCard()->id;
                            $selected = function ($value) use ($card_id) {
                                return ($card_id == $value ? "selected" : "");
                            };
                            ?>
                            <option <?= $selected($card->id); ?> value="<?= $card->id; ?>">
                                Cartão final <?= $card->last_digits; ?> (<?= str_title($card->brand); ?>)
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option disabled value="">ERRO: Cliente sem cartão cadastrado</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="status">Status da assinatura</label>
                <select name="status" id="status" class="form-control" required>
                    <?php
                    $status = $subscription->status;
                    $selected = function ($value) use ($status) {
                        return ($status == $value ? "selected" : "");
                    };
                    ?>
                    <option <?= $selected("active"); ?> value="active">Ativa</option>
                    <option <?= $selected("past_due"); ?> value="past_due">Atrasada</option>
                    <option <?= $selected("canceled"); ?> value="canceled">Cancelada
                    </option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="pay_status">Status da recorrência</label>
                <select name="pay_status" id="pay_status" class="form-control" required>
                    <?php
                    $pay_status = $subscription->pay_status;
                    $selected = function ($value) use ($pay_status) {
                        return ($pay_status == $value ? "selected" : "");
                    };
                    ?>
                    <option <?= $selected("active"); ?> value="active">Ativa</option>
                    <option <?= $selected("canceled"); ?> value="canceled">Cancelada</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="due_day">Dia de vencimento</label>
                <select name="due_day" id="due_day" class="form-control" required>
                    <?php for ($day = 1; $day <= 28; $day++):
                        $due_day = $subscription->due_day;
                        $selected = function ($value) use ($due_day) {
                            return ($due_day == $value ? "selected" : "");
                        };
                        ?>
                        <option <?= $selected($day); ?> value="<?= $day; ?>">
                            Todo dia <?= str_pad($day, 2, 0, 0); ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="next_due">Próximo vencimento</label>
                <input type="text" name="next_due" id="next_due" value="<?= date("d/m/Y", strtotime($subscription->next_due)); ?>" class="mask-date form-control" required>
            </div>

            <div class="form-group col-md-6">
                <label for="last_charge">Útima cobrança</label>
                <input type="text" name="last_charge" id="last_charge" value="<?= date("d/m/Y", strtotime($subscription->last_charge)); ?>" class="mask-date form-control" required>
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

</div>

