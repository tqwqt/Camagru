<?php

return array(
    'home/last_(p\d+)' => 'home/index/last_$1',
    'home' => 'home/index',
    'home/deleteImage' => 'home/deleteImage',
    'main/register' => 'main/register',
    'main/confirm(\d|\D)+' => 'main/confirm',
    'main/restore\?email=(\w){4,15}@([a-z]){1,8}.([a-z]){2,5}&token=(\w){20}' => 'main/restore',
    'main/forgotPassword' => 'main/forgotPassword',
    'cabinet' => 'cabinet/cabinet',
    'cabinet/setNS' => 'cabinet/setNS',
    'cabinet/change' => 'cabinet/change',
    'cabinet/changeLogin' => 'cabinet/changeLogin',
    'cabinet/changeEmail' => 'cabinet/changeEmail',
    'logout' => 'main/logout',
    'like/like_([0-9]+)' => 'home/like/like_$1',
    'showComments/comm_([0-9]+)' => 'home/showComments/comm_$1',
    'addComment' => 'home/addComment',
    'removeComment' => 'home/removeComment',
    'photoStudio/savePhoto' => 'photoStudio/savePhoto',
    'photoStudio' => 'photoStudio/ps',
    ''=>'main/login',
    '(\d|\D)+' => 'main/login',
    //call actionINdex in NewsCOntroler
    //'prod' => 'prod/list' //call actonList in ProdControler
);
//'addComment/btnc_([0-9]+)=(\w+|\W+)' => 'home/addComment/btnc_$1=$2',