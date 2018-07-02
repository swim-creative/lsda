<?php

if(get_field('staff_title')) :
  echo '<hr style="margin:8px 0"><strong style="opacity:.7;font-size:16px">'.get_field('staff_title').'</strong>';
endif;
if(get_field('time_in_office')) :
  echo '<em style="font-size:15px">'.get_field('time_in_office').'</em>';
endif;
