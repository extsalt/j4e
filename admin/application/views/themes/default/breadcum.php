<nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('dashboard');?>" style="text-decoration: none;">Home</a></li>
        
        <?php if(isset($title1)){?>
          <li class="breadcrumb-item <?=$titlelinkstatus1;?>" <?php if($titlelinkstatus1 == 'active'){?>aria-current="page"<?php } ?> >
              <?php if($titlelinkstatus1 == 'active'){
                        echo $title1;
              } else{?>
                 <a href="<?=$titlelink1;?>"  style="text-decoration: none;"><?=$title1;?></a>
              <?php } ?>
              
          </li>
        <?php }?>
        
        <?php if(isset($title2)){?>
          <li class="breadcrumb-item <?=$titlelinkstatus2;?>" <?php if($titlelinkstatus2 == 'active'){?>aria-current="page"<?php } ?> >
              <?php if($titlelinkstatus2 == 'active'){
                        echo $title2;
              } else{?>
                 <a href="<?$titlelink2;?>"  style="text-decoration: none;"><?=$title2;?></a>
              <?php } ?>
              
          </li>
        <?php }?>
        
        <?php if(isset($title3) && $title3 != ''){?>
          <li class="breadcrumb-item <?=$titlelinkstatus3;?>" <?php if($titlelinkstatus3 == 'active'){?>aria-current="page"<?php } ?> >
              <?php if($titlelinkstatus3 == 'active'){
                        echo $title3;
              } else{?>
                 <a href="<?=$titlelink3;?>"  style="text-decoration: none;"><?=$title3;?></a>
              <?php } ?>
              
          </li>
        <?php }?>
        
        <?php if(isset($title4)){?>
          <li class="breadcrumb-item <?=$titlelinkstatus4;?>" <?php if($titlelinkstatus4 == 'active'){?>aria-current="page"<?php } ?> >
              <?php if($titlelinkstatus4 == 'active'){
                        echo $title4;
              } else{?>
                 <a href="<?=$titlelink4;?>"  style="text-decoration: none;"><?=$title4;?></a>
              <?php } ?>
              
          </li>
        <?php }?>
        
      </ol>
    </nav>