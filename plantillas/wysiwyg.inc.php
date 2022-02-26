
<div class="row">
    <div class="col-md-12" style="margin-bottom: 2em">
        <div class="row">
            <div class="col-md-10">
            </div>
            <div class="col-md-2">
                <button class="btn form-control" data-toggle="collapse" data-target="#coment<?php echo $i ?>">
                    <i class="fas fa-comment-dots fa-lg"></i>
                    Responder 
                </button>
            </div>
        </div>
        <br>
        <div id="coment<?php echo $i ?>" class="collapse">
            <form action="" method="post" enctype="multipart/form-data">
                <textarea class="ckeditor" name="editor"></textarea>
            </form>
        </div>
    </div>
</div>