<?php $v->layout("_admin"); ?>

<div class="mce_upload" style="z-index: 997">
    <div class="mce_upload_box">
        <form class="app_form" action="<?= url("/admin/blog/post"); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="upload" value="true"/>
            <label>
                <label class="legend">Selecione uma imagem JPG ou PNG:</label>
                <input accept="image/*" type="file" name="image" required/>
            </label>
            <button class="btn btn-info icon-upload">Enviar Imagem</button>
        </form>
    </div>
</div>

<div class="container-fluid">

    <?php if (!$post): ?>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-fw fa-plus-circle"></i>
                Novo Artigo
            </h1>
        </div>

        <form action="<?= url("/admin/blog/post"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="create"/>

            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title"  id="title" placeholder="A manchete do seu artigo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="subtitle">Subtítulo</label>
                <textarea name="subtitle" id="subtitle" rows="2" placeholder="O texto de apoio da manchete" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="cover">Capa: (1920x1080px)</label>
                <input type="file" name="cover" id="cover" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="video">Vídeo</label>
                <input type="text" name="video"  id="video" placeholder="O ID de um vídeo do YouTube" class="form-control">
            </div>

            <fieldset class="form-group d-none">
                <legend class="col-form-label">Categorias</legend>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" name="category" id="category1" class="custom-control-input">
                    <label class="custom-control-label" for="category1">Categoria 1</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" name="category" id="category2" class="custom-control-input">
                    <label class="custom-control-label" for="category2">Categoria 2</label>
                </div>
            </fieldset>

            <div class="form-group">
                <label for="content" class="required">Conteúdo</label>
                <textarea name="content" id="content" class="mce"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="category">Categoria</label>
                    <select name="category" id="category" class="form-control" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id; ?>"><?= $category->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="author">Autor</label>
                    <select name="author" id="author" class="form-control" required>
                        <?php foreach ($authors as $author): ?>
                            <option value="<?= $author->id; ?>"><?= $author->fullName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="post">Publicar</option>
                        <option value="draft">Rascunho</option>
                        <option value="trash">Lixo</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="post_at">Data de publicação</label>
                    <input type="text" name="post_at"  id="post_at" value="<?= date("d/m/Y H:i"); ?>" class="mask-datetime form-control" required>
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
                Editar post #<?= $post->id; ?>
            </h1>

            <div class="form-group text-right">
                <a href="<?= url("/blog/{$post->uri}"); ?>" target="_blank" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-eye"></i>
                </span>
                    <span class="text">Ver no site</span>
                </a>
            </div>
        </div>

        <figure class="figure">
            <?= photo_img($post->cover, $post->title, 256, 144, null, "figure-img img-fluid rounded img-thumbnail", "max-width: 256px"); ?>
        </figure>

        <form action="<?= url("/admin/blog/post/{$post->id}"); ?>" method="post">
            <!--ACTION SPOOFING-->
            <input type="hidden" name="action" value="update"/>

            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title"  id="title" value="<?= $post->title; ?>" placeholder="A manchete do seu artigo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="subtitle">Subtítulo</label>
                <textarea name="subtitle" id="subtitle" rows="2" placeholder="O texto de apoio da manchete" class="form-control" required><?= $post->subtitle; ?></textarea>
            </div>

            <div class="form-group">
                <label for="cover">Capa: (1920x1080px)</label>
                <input type="file" name="cover" id="cover" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="video">Vídeo</label>
                <input type="text" name="video"  id="video" value="<?= $post->video; ?>" placeholder="O ID de um vídeo do YouTube" class="form-control">
            </div>

            <div class="form-group">
                <label for="content" class="required">Conteúdo</label>
                <textarea name="content" id="content" class="mce"><?= $post->content; ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="category">Categoria</label>
                    <select name="category" id="category" class="form-control" required>
                        <?php foreach ($categories as $category):
                            $categoryId = $post->category;
                            $select = function ($value) use ($categoryId) {
                                return ($categoryId == $value ? "selected" : "");
                            };
                            ?>
                            <option <?= $select($category->id); ?>
                                    value="<?= $category->id; ?>"><?= $category->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="author">Autor</label>
                    <select name="author" id="author" class="form-control" required>
                        <?php foreach ($authors as $author):
                            $authorId = $post->author;
                            $select = function ($value) use ($authorId) {
                                return ($authorId == $value ? "selected" : "");
                            };
                            ?>
                            <option <?= $select($author->id); ?>
                                    value="<?= $author->id; ?>"><?= $author->fullName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <?php
                        $status = $post->status;
                        $select = function ($value) use ($status) {
                            return ($status == $value ? "selected" : "");
                        };
                        ?>
                        <option <?= $select("post"); ?> value="post">Publicar</option>
                        <option <?= $select("draft"); ?> value="draft">Rascunho</option>
                        <option <?= $select("trash"); ?> value="trash">Lixo</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="post_at">Data de publicação</label>
                    <input type="text" name="post_at"  id="post_at" value="<?= date_fmt($post->post_at, "d/m/Y H:i"); ?>" class="mask-datetime form-control" required>
                </div>
            </div>

            <div class="form-group text-right">
                <button class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Atualizar</span>
                </button>
            </div>
        </form>
    <?php endif; ?>

</div>

