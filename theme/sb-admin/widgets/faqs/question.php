<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <?php if (!$question): ?>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-fw fa-plus-circle"></i>
                Nova Pergunta
            </h1>
        </div>

        <form action="<?= url("/admin/faq/question/{$channel->id}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="create"/>

            <div class="form-group">
                <label for="question">Pergunta</label>
                <input type="text" name="question"  id="question" placeholder="Pergunta frequente" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="response" class="required">Resposta</label>
                <textarea name="response" id="response" class="mce"></textarea>
            </div>

            <div class="form-group">
                <label for="order_by">Ordem</label>
                <input type="number" name="order_by"  id="order_by" class="form-control" required>
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
                Editar Pergunta
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

        <form action="<?= url("/admin/faq/question/{$channel->id}/{$question->id}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="update"/>

            <div class="form-group">
                <label for="question">Pergunta</label>
                <input type="text" name="question"  id="question" value="<?= $question->question; ?>" placeholder="Pergunta frequente" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="response" class="required">Resposta</label>
                <textarea name="response" id="response" class="mce"><?= $question->response; ?></textarea>
            </div>

            <div class="form-group">
                <label for="order_by">Ordem</label>
                <input type="number" name="order_by"  id="order_by" value="<?= $question->order_by; ?>" class="form-control" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <a href="#" class="btn btn-danger btn-icon-split"
                       data-post="<?= url("/admin/faq/question/{$channel->id}/{$question->id}"); ?>"
                       data-action="delete"
                       data-confirm="Tem certeza que deseja excluir a perguntas e a respostas?"
                       data-question_id="<?= $question->id; ?>">
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

