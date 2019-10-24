<?php $v->layout("_login"); ?>

<div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('<?= theme("/assets/images/bg-login-image.jpg", CONF_VIEW_ADMIN); ?>');"></div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem-vindo de volta!</h1>
                </div>
                <div class="ajax_response"><?= flash(); ?></div>
                <form action="<?= url("/admin/login"); ?>" method="post" class="user">
                    <div class="form-group">
                        <input type="email" name="email" id="email" aria-describedby="emailHelp" placeholder="Insira o endereço de e-mail..." class="form-control form-control-user" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="Digite a senha" class="form-control form-control-user" required>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                        Entrar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>