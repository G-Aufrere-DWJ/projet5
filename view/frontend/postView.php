<?php ob_start(); ?>

        <div id="article_seul">
            <h3>
                <?php echo $post->title; ?>
                <em>le <?= $post->creation_date ?></em>
            </h3>
            <div class="container bg-white col-12">
                <div class="row">
                        <div id="whole_chapter" class="col-lg-6">
                            <p>
                                <?= ($post->content) ?>
                            </p>
                        </div>
                </div>
            </div>
        </div>

            <div id="posts_comments">
                <div class="container bg-white col-12">
                    <div class="row">
                        <div id="display_comments" class="col-lg-6">
                        <h2 class="text-center mt-4 mb-5 text-black">Commentaires</h2>
                            <hr>
                            <?php
                            while ($comment = $comments->fetch())
                                {
                                ?>
                            <p id="whose_comment" class="text-capitalize"><strong><?= htmlspecialchars($comment['pseudo']) ?></strong> le <?= $comment['creation_date'] ?></p>
                            <p id="content_comment"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>

                            <?php if (!empty($_SESSION['id']) && ($_SESSION['role'] > 0 )) { ?>
                                <a href="index.php?action=signalComment&id=<?= ($comment['id'])?>&post_id=<?= $_GET['id']?>" id="red_btn_comments" class="btn btn-danger offset-lg-8" role="button">Signaler le commentaire</a>
                            <?php } ?>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        <section id="leave_comment">
            <div class="container bg-white col-12">
                <div class="row">
                    <div id="form_comments" class="text-center col-lg-6 mb-5 mt-5">
                <?php if (isset($_SESSION['id'])) {
                    if (!empty($_SESSION['id']) && ($_SESSION['role'] > 0 )) { ?>
                            <form action="index.php?action=addComment&id=<?= $post->id ?>" method="post">
                        <div class="text-center col-12">
                            <label class="text-center mt-4 mb-5 text-black" for="comment">Laisser un commentaire</label><br />
                            <textarea id="comment" class="form-control" name="comment"></textarea>
                        </div>
                        <div class="text-center col-12">
                            <input type="submit" class="btn btn-primary mt-4" />
                        </div>
                            </form> 
                                    <?php } ?>
                                    <?php } ?>
                        </div>
                    </div>
            </div>
        </section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>