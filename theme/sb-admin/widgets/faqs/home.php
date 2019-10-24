<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-fw fa-comment"></i>
            FAQs
        </h1>

        <div class="form-group text-right">
            <a href="<?= url("/admin/faq/channel"); ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                </span>
                <span class="text">Novo Canal</span>
            </a>
        </div>
    </div>

    <?php if ($channels): foreach ($channels as $channel): ?>
        <div class="card mb-4 p-3 border-left-primary">
            <div class="row no-gutters">
                <div class="col-md-5 align-self-center text-center">
                    <div class="card-body">
                        <h3 class="card-title H5"><?= $channel->channel; ?></h3>
                        <p class="card-text"><?= $channel->description; ?></p>

                        <a href="<?= url("/admin/faq/channel/{$channel->id}"); ?>" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-pen-alt"></i>
                            </span>
                            <span class="text">Editar Canal</span>
                        </a>
                        &nbsp;
                        <a href="<?= url("/admin/faq/question/{$channel->id}"); ?>" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Nova Pergunta</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <?php
                    $channelId = $channel->id;
                    $edit = function ($id) use ($channelId) {
                        $url = url("/admin/faq/question/{$channelId}/{$id}");
                        return "<a href=\"{$url}\" class=\"btn btn-sm btn-info btn-circle\"><i class=\"fas fa-pen-alt\"></i></a>";
                    };
                    ?>

                    <?php if ($channel->questions()->count()): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($channel->questions()->fetch(true) as $question): ?>
                                <li class="list-group-item">
                                    <?= $edit($question->id); ?> - <?= $question->question; ?>
                                    <small class="d-block mt-2 text-black-50">
                                        <?= str_limit_words(strip_tags($question->response), 13, " [...]"); ?>
                                    </small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <?= alert_info("Ainda não existem perguntas"); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?= $paginator; ?>

    <?php else: ?>
        <?= alert_info("Ainda não existem canais de FAQ cadastrados.", "w-50"); ?>
    <?php endif; ?>

</div>

