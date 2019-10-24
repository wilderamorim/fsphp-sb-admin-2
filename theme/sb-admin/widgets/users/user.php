<?php $v->layout("_admin"); ?>

<div class="container-fluid">

    <?php if (!$user): ?>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-fw fa-pen-alt"></i>
                Novo Usuário
            </h1>
        </div>

        <form action="<?= url("/admin/users/user"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="create"/>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">Nome</label>
                    <input type="text" name="first_name"  id="first_name" placeholder="Primeiro nome" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Sobrenome</label>
                    <input type="text" name="last_name" id="last_name" placeholder="Último nome" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="genre">Genero</label>
                <select name="genre" id="genre" class="form-control">
                    <option value="male">Masculino</option>
                    <option value="female">Feminino</option>
                    <option value="other">Outros</option>
                </select>
            </div>

            <div class="form-group">
                <label for="photo">Foto</label>
                <input type="file" name="photo" id="photo" class="form-control-file">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="datebirth">Nascimento</label>
                    <input type="text" name="datebirth"  id="datebirth" placeholder="dd/mm/yyyy" class="mask-date form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="document">Documento</label>
                    <input type="text" name="document" id="document" placeholder="CPF do usuário" class="mask-doc form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">E-mail</label>
                    <input type="email" name="email"  id="email" placeholder="Melhor e-mail" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" placeholder="Senha de acesso" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="level">Level</label>
                    <select name="level" id="level" class="form-control" required>
                        <option value="1">Usuário</option>
                        <option value="5">Admin</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="registered">Registrado</option>
                        <option value="confirmed">Confirmado</option>
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
                <?= $user->fullName(); ?>
            </h1>
        </div>

        <form action="<?= url("/admin/users/user/{$user->id}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="update"/>

            <div class="row">
                <div class="col-lg-4 col-xl-3 order-1">
                    <figure class="figure">
                        <?= photo_img($user->photo(), $user->fullName(), 256, 256, CONF_IMAGE_DEFAULT_AVATAR, "figure-img img-fluid rounded img-thumbnail", "width: 256px"); ?>
                    </figure>
                </div>

                <div class="col-lg-8 col-xl-9 order-2">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">Nome</label>
                            <input type="text" name="first_name"  id="first_name" value="<?= $user->first_name; ?>" placeholder="Primeiro nome" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Sobrenome</label>
                            <input type="text" name="last_name" id="last_name" value="<?= $user->last_name; ?>" placeholder="Último nome" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="genre">Genero</label>
                        <select name="genre" id="genre" class="form-control">
                            <?php
                            $genre = $user->genre;
                            $select = function ($value) use ($genre) {
                                return ($genre == $value ? "selected" : "");
                            };
                            ?>
                            <option <?= $select("male"); ?> value="male">Masculino</option>
                            <option <?= $select("female"); ?> value="female">Feminino</option>
                            <option <?= $select("other"); ?> value="other">Outros</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="photo">Foto</label>
                        <input type="file" name="photo" id="photo" class="form-control-file">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="datebirth">Nascimento</label>
                    <input type="text" name="datebirth"  id="datebirth" value="<?= date_fmt($user->datebirth, "d/m/Y"); ?>" placeholder="dd/mm/yyyy" class="mask-date form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="document">Documento</label>
                    <input type="text" name="document" id="document" value="<?= $user->document; ?>" placeholder="CPF do usuário" class="mask-doc form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">E-mail</label>
                    <input type="email" name="email"  id="email" value="<?= $user->email; ?>" placeholder="Melhor e-mail" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Alterar senha</label>
                    <input type="password" name="password" id="password" placeholder="Senha de acesso" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="level">Level</label>
                    <select name="level" id="level" class="form-control" required>
                        <?php
                        $level = $user->level;
                        $select = function ($value) use ($level) {
                            return ($level == $value ? "selected" : "");
                        };
                        ?>
                        <option <?= $select(1); ?> value="1">Usuário</option>
                        <option <?= $select(5); ?> value="5">Admin</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <?php
                        $status = $user->status;
                        $select = function ($value) use ($status) {
                            return ($status == $value ? "selected" : "");
                        };
                        ?>
                        <option <?= $select("registered"); ?> value="registered">Registrado</option>
                        <option <?= $select("confirmed"); ?> value="confirmed">Confirmado</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <a href="#" class="btn btn-danger btn-icon-split"
                       data-post="<?= url("/admin/users/user/{$user->id}"); ?>"
                       data-action="delete"
                       data-confirm="ATENÇÃO: Tem certeza que deseja excluir o usuário e todos os dados relacionados a ele? Essa ação não pode ser feita!"
                       data-user_id="<?= $user->id; ?>">
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

