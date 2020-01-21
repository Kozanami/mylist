<div class="library-border bg-perso mt-0 p-2">
    <ul class="pagination justify-content-center mb-0">
          <?php
            if($pId-1 >= 1)
            {
            ?>
             <li class="page-item">
              <a class="page-link" href="<?= WEBROOT ?>Library/<?= $type ?>/<?= $pId-1 ?>">Previous</a>
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
        for($i=0; $i <= $pmax; $i++)
        {
            if($i == 0)
            {
            }
            else
            {
                if($pId == $i)
                {
                ?>
                <li class="page-item active">
                <a class="page-link" href="#"><?php echo $pId; ?><span class="sr-only">(current)</span></a>
                </li>
                <?php
                }
                else
                {
                    if($i > $pmax)
                    {

                    }
                    else
                    {
                        ?> <li class="page-item"><a class="page-link" href="<?= WEBROOT ?>Library/<?= $type ?>/<?php echo $i; ?>"><?php echo $i; ?></a></li> <?php
                    }
                }
            }
        }
        if($pId+1 > $pmax)
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
        <a class="page-link" href="<?= WEBROOT ?>Library/<?= $type ?>/<?= $pId+1 ?>">Next</a>
        </li>

        <?php
        }
            ?>
    </ul>
  </div>