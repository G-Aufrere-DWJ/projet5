<?php ob_start(); ?>


        <div id="comments_moderation">
            <h2 class="text-white text-center">COMMENTAIRES A MODERER</h2>
                <div class="container bg-white col-12 pb-5">
                    <div class="row">
                        <div id="signal_comments" class="col-6">
                        <?php
                            while ($comment = $comments->fetch())
                        {
                        ?>
                            <p class="text-black"><strong><?= htmlspecialchars($comment['pseudo']) ?></strong> le <?= $comment['creation_date'] ?></p>
                            <p class="text-black"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>

                            <?php if (!empty($_SESSION['id']) && ($_SESSION['role'] == 0 )) { ?>
                                <a href="index.php?action=deleteComment&id=<?= ($comment['id'])?>&post_id=<?= $comment['post_id']?>" class="btn btn-danger">Supprimer le commentaire</a>
                            <?php } ?>
                            <a href="index.php?action=takeOffComment&id=<?= ($comment['id'])?>&post_id=<?= $comment['post_id']?>" class="btn btn-success">Retirer le signalement</a>
                        <?php } ?>
                        </div>
                    </div>
                </div>
        </div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>