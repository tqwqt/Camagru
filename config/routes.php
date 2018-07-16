<?php

return array(
    'home' => 'home/index',
    'main' => 'main/login',
    'main/register' => 'main/register',
    'main/confirm+' => 'main/confirm',
    'cabinet' => 'cabinet/cabinet',
    'logout' => 'main/logout',
    'like/like_([0-9]+)' => 'home/like/like_$1',
    'showLikes/like_([0-9]+)' => 'home/showLikes/like_$1',
    'showComments/comm_([0-9]+)' => 'home/showComments/comm_$1',
    'addComment' => 'home/addComment',
    //call actionINdex in NewsCOntroler
    //'prod' => 'prod/list' //call actonList in ProdControler
);
//'addComment/btnc_([0-9]+)=(\w+|\W+)' => 'home/addComment/btnc_$1=$2',