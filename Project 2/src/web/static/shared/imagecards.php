<?php

        pictures($model);
        
        if (!empty($model['pictures'])): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <=  $model['pagesNumber']; $i++){
                echo "<a href='gallery2?page= $i'> $i </a>&nbsp ";
            }
            ?>
        </br>
        </div>
        <?php foreach ($model['pictures'] as $picture): ?>
            <?php if (!$picture['private'] || (isset($_SESSION['user_id']) && $_SESSION['user_id']->__toString() === $picture['user_id']->__toString())): ?>
        <div class="gallery-item">
            <a href="/images/2/<?= $picture['fileName'] ?>"></br>
            <img src="/images/3/<?= $picture['fileName'] ?>" alt="miniatura">
            </a><br>
        </div>
        <div class="picture-info">
            <p>Author: <?= $picture['author'] ?></p>
            <p>Title: <?= $picture['title'] ?></p>
            <?php if ($picture['private']): ?>
                <span>(Private)</span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>

        </div>
        <?php else: ?>
            <p>No photos uploaded</p>
        <?php endif; ?>