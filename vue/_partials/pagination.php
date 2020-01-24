<div class="library-border bg-perso mt-0 p-2">
    <ul class="pagination justify-content-center mb-0">

          <?php

            $pageId = $_SESSION['pageID'];
            $pageName = $_SESSION['pageName'];
            $pageMax = $_SESSION['pageMax'];
            unset($_SESSION['pageID']);
            unset($_SESSION['pageName']);

            if($pageId-1 >= 1)
            {
            ?>
             <li class="page-item">
              <a class="page-link" href="<?= WEBROOT ?>Library/<?= $pageName ?>/<?= $pageId-1 ?>">Previous</a>
            </li>
            <?php
            }
            else
            {
            ?>
            <li class="page-item disabled">
                <a class="page-link" href="#">Previous</a>
            </li>
            <?php
            }
            ?>
        <?php
        for($i=0; $i <= $pageMax; $i++)
        {
            if($i == 0)
            {
            }
            else
            {
                if($pageId == $i)
                {
                ?>
                <li class="page-item active">
                <a class="page-link" href="#"><?php echo $pageId; ?><span class="sr-only">(current)</span></a>
                </li>
                <?php
                }
                else
                {
                    if($i > $pageMax)
                    {

                    }
                    else
                    {
                        ?> <li class="page-item"><a class="page-link" href="<?= WEBROOT ?>Library/<?= $pageName ?>/<?php echo $i; ?>"><?php echo $i; ?></a></li> <?php
                    }
                }
            }
        }
        if($pageId+1 > $pageMax)
        {
        ?>
            <li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
            </li>
        <?php
        }
        else
        {
        ?>
        <li class="page-item">
        <a class="page-link" href="<?= WEBROOT ?>Library/<?= $pageName ?>/<?= $pageId+1 ?>">Next</a>
        </li>

        <?php
        }
            ?>
    </ul>
  </div>
