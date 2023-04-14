<p>Главаная страница</p>
<?php

foreach ($news as $one_news):
    ?>
    <h3><?php echo $one_news['title']?></h3>
    <h3><?php echo $one_news['text']?></h3>
    <?php
endforeach;