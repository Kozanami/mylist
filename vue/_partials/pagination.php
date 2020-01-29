<div class="library-border bg-info mt-0 p-2">
    <ul class="pagination justify-content-center mb-0">

          <?php

            $pageId = $_SESSION['pageID'];
            $pageName = $_SESSION['pageName'];
            $pageMax = $_SESSION['pageMax'];
            $controller = $_SESSION['controller'];
            unset($_SESSION['pageID']);
            unset($_SESSION['pageMax']);

            if($pageId-1 >= 1)
            {
            ?>
             <li class="page-item">
              <a class="page-link" href="<?= WEBROOT ?><?= $controller ?>/<?= $pageName ?>/<?= $pageId-1 ?>">Previous</a>
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
                <li class="page-item disabled">
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
                        ?> <li class="page-item"><a class="page-link" href="<?= WEBROOT ?><?= $controller ?>/<?= $pageName ?>/<?php echo $i; ?>"><?php echo $i; ?></a></li> <?php
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
        <a class="page-link" href="<?= WEBROOT ?><?= $controller ?>/<?= $pageName ?>/<?= $pageId+1 ?>">Next</a>
        </li>

        <?php
        }
            ?>
    </ul>
  </div>
