<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-fw fa-home"></i>
            Dash
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-6 col-lg-4 d-flex">
            <!-- Control -->
            <div class="card shadow mb-4 w-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-tachometer-alt"></i>
                        Control
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li><b>Assinantes:</b> <?= $control->subscribers; ?></li>
                        <li><b>Planos:</b> <?= $control->plans; ?></li>
                        <li><b>Recorrencia:</b> R$ <?= str_price($control->recurrence); ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 d-flex">
            <!-- Blog -->
            <div class="card shadow mb-4 w-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-blog"></i>
                        Blog
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li><b>Artigos:</b> <?= $blog->posts; ?></li>
                        <li><b>Rascunhos:</b> <?= $blog->drafts; ?></li>
                        <li><b>Categorias:</b> <?= $blog->categories; ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 d-flex">
            <!-- Users -->
            <div class="card shadow mb-4 w-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user"></i>
                        Usuários
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li><b>Usuários:</b> <?= $users->users; ?></li>
                        <li><b>Admins:</b> <?= $users->admins; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Online agora</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span class="app_dash_home_trafic_count"><?= $onlineCount; ?></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-signal fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php if ($online): ?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Navegação dos Usuários</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Duração</th>
                            <th>Páginas</th>
                            <th>URL</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Usuário</th>
                            <th>Duração</th>
                            <th>Páginas</th>
                            <th>URL</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($online as $onlineNow): ?>
                            <tr>
                                <td><?= ($onlineNow->user ? $onlineNow->user()->fullName() : "Guest User"); ?></td>
                                <td><?= date_fmt($onlineNow->created_at, "H\hm"); ?> - <?= date_fmt($onlineNow->updated_at, "H\hm"); ?></td>
                                <td><?= $onlineNow->pages; ?> páginas vistas</td>
                                <td>
                                    <a href="<?= url("/{$onlineNow->url}"); ?>" target="_blank">
                                        <b><?= mb_strtolower(CONF_SITE_NAME); ?></b>
                                        <?= $onlineNow->url; ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?= alert_info("Não existem usuários online navegando no site neste momento.", "w-50"); ?>
    <?php endif; ?>

</div>

<?php $v->start("scripts"); ?>
    <script>
        $(function () {
            setInterval(function () {
                $.post('<?= url("/admin/dash/home");?>', {refresh: true}, function (response) {
                    // count
                    if (response.count) {
                        $(".app_dash_home_trafic_count").text(response.count);
                    } else {
                        $(".app_dash_home_trafic_count").text(0);
                    }

                    //list
                    var list = "";
                    if (response.list) {
                        $.each(response.list, function (item, data) {
                            var url = '<?= url();?>' + data.url;
                            var title = '<?= strtolower(CONF_SITE_NAME);?>';

                            list += "<article>";
                            list += "<h4>[" + data.dates + "] " + data.user + "</h4>";
                            list += "<p>" + data.pages + " páginas vistas</p>";
                            list += "<p class='radius icon-link'>";
                            list += "<a target='_blank' href='" + url + "'><b>" + title + "</b>" + data.url + "</a>";
                            list += "</p>";
                            list += "</article>";
                        });
                    } else {
                        list = "<div class=\"message info icon-info\">\n" +
                            "Não existem usuários online navegando no site neste momento. Quando tiver, você\n" +
                            "poderá monitoriar todos por aqui.\n" +
                            "</div>";
                    }

                    $(".app_dash_home_trafic_list").html(list);
                }, "json");
            }, 1000 * 10);
        });
    </script>
<?php $v->end(); ?>