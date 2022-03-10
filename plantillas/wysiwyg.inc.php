<div class="row">
    <div class="col-md-12">
        <div class="row card-header d-flex flex-fill bg-transparent border-bottom-0 text-white mx-3">
            <button class="btn btn-outline-light rosa" data-bs-toggle="collapse" data-bs-target="#coment<?php echo $i ?>">
                <i class="fas fa-comment-dots fa-lg"></i>&nbsp;Responder</button>
        </div>
        <div id="coment<?php echo $i ?>" class="collapse card-body bg-dark-light rounded mx-4 mb-4">
            <form action="" method="post" action="#">
                <script>
                    CKEDITOR.replace('comentario');
                </script>
                <textarea id="comentario" name="comentario"></textarea>
            </form>
        </div>
    </div>
</div>