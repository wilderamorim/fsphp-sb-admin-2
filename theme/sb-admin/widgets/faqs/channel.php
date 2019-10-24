<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <?php if (!$channel): ?>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-fw fa-plus-circle"></i>
                Novo Canal
            </h1>
        </div>

        <form action="<?= url("/admin/faq/channel"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="create"/>

            <div class="form-group">
                <label for="channel">Canal</label>
                <input type="text" name="channel"  id="channel" placeholder="Nome do canal" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" rows="3" placeholder="Sobre esse canal" class="form-control" required></textarea>
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
                <i class="fas fa-fw fa-comments"></i>
                <?= $channel->channel; ?>
            </h1>

            <div class="form-group text-right">
                <a href="<?= url("/admin/faq/question/{$channel->id}"); ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                </span>
                    <span class="text">Nova Pergunta</span>
                </a>
            </div>
        </div>

        <form action="<?= url("/admin/faq/channel/{$channel->id}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="update"/>

            <div class="form-group">
                <label for="channel">Canal</label>
                <input type="text" name="channel"  id="channel" value="<?= $channel->channel; ?>" placeholder="Nome do canal" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" rows="3" placeholder="Sobre esse canal" class="form-control" required><?= $channel->description; ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <a href="#" class="btn btn-danger btn-icon-split"
                       data-post="<?= url("/admin/faq/channel/{$channel->id}"); ?>"
                       data-action="delete"
                       data-confirm="Tem certeza que deseja excluir este canal e todas as suas perguntas e respostas?"
                       data-plan_id="<?= $channel->id; ?>">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Excluir</span>
                    </a>
                </div>
                <div class="form-group col-md-6 text-right">
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

