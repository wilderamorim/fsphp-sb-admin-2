<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?= $head; ?>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
    <link rel="stylesheet" href="<?= theme("/assets/style.min.css", CONF_VIEW_ADMIN); ?>"/>

</head>

<body class="bg-gradient-primary">
<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <?= $v->section("content"); ?>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
<script src="<?= url("/shared/scripts/tinymce/tinymce.min.js"); ?>"></script>
<script src="<?= theme("/assets/script.min.js", CONF_VIEW_ADMIN); ?>"></script>
<script>
    $(function () {
        $("form").submit(function (e) {
            e.preventDefault();

            var form = $(this);
            var load = $(".ajax_load");

            load.fadeIn(200).css("display", "flex");

            $.ajax({
                url: form.attr("action"),
                type: "POST",
                data: form.serialize(),
                dataType: "json",
                success: function (response) {
                    //redirect
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        load.fadeOut(200);
                    }

                    //Error
                    if (response.message) {
                        $(".ajax_response").html(response.message).effect("bounce");
                    }
                },
                error: function (response) {
                    load.fadeOut(200);
                }
            });
        });
    });
</script>
</body>

</html>
