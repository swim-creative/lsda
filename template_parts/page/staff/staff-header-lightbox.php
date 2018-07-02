<?php

if(get_field('staff_title')) :
  echo '<strong style="opacity:.7;font-size:16px">'.get_field('staff_title').'</strong>';
endif;
if(get_field('time_in_office')) :
  echo '&nbsp;&nbsp;|&nbsp;&nbsp;<em style="font-size:15px">'.get_field('time_in_office').'</em><hr style="margin:16px 0">';
endif;

if(!get_field('time_in_office')) :
  echo '<hr>';
endif;
