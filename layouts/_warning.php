<?php if($errRaised === false && isset($warningRaised[$warn])){?>
<div class="block-warn">
    <span class="warn-text"><?=$warningRaised[$warn]?></span>
</div>
<?php }?>