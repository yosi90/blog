<div class="col-12 bg-dark-light">
    <div class="row card-header d-flex flex-fill bg-transparent border-bottom-0 text-white mx-3">
        <button class="btn btn-outline-light rosa" data-bs-toggle="collapse" data-bs-target="#coment<?php echo ($i + 1) ?>">
            <i class="fas fa-comment-dots fa-lg"></i>&nbsp;Responder</button>
    </div>
    <div id="coment<?php echo ($i + 1) ?>" class="collapse card-body bg-dark-light rounded mx-4 mb-4">
        <form method="POST" action="#">
            <textarea id="editor<?php echo ($i + 1) ?>" name="editor<?php echo ($i + 1) ?>"></textarea>
        </form>
        <script>
            CKEDITOR.replace('editor<?php echo ($i + 1) ?>');
        </script>
    </div>
</div>