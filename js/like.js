



function likeImg(id) {
    var photo_like = document.getElementById(id);//ClassName('photo_list');


   // document.location.assign('/like/' + id);
  //  console.log(photo_like.nextElementSibling);

    ajaxPost('http://localhost:8101/like/' + id,function (data) {
        var status = data.match(/\D+/);//data.substring(0,data.length - 1);
        console.log('status='+status);
        var likes = data.match(/\d+/);
        console.log('likes='+likes);
        if (status.toString().localeCompare("liked".toString()) === 0)
        {
            document.getElementById(id).setAttribute('src',  '../resources/lkd.svg');
        }
        else if (status.toString().localeCompare('unliked') === 0)
        {
            document.getElementById(id).setAttribute('src', '../resources/camalike.svg');
        }
        photo_like.nextElementSibling.innerHTML = likes;
    });
}
function showComments(photoId) {

    
}
function ajaxPost(url, callback) {
    var f = callback || function (data) {};

    var req = new XMLHttpRequest();

    req.onreadystatechange = function () {
        if(req.readyState == 4 && req.status == 200)
        {
            f(req.responseText);
        }
    };

    req.open('POST', url);
    req.send();
}

// function getLikeCount(id) {
//
//     var req = new XMLHttpRequest();
//     console.log('id='+id);
//     req.onreadystatechange = function () {
//         if (req.readyState === 4 && req.status === 200)
//         {
//             console.log("response="+req.responseText);
//             return req.responseText;
//             // if (req.responseText !== 'false')
//             // {
//             //     document.getElementById(id).setAttribute('src',  '../resources/lkd.svg');
//             //     photo_like.nextElementSibling.innerHTML = likes;
//             //     // document.getElementById(id).nextSibling.innerHTML = likes;
//             // }
//             // else if (req.responseText === 'false')
//             // {
//             //     document.getElementById(id).setAttribute('src', '../resources/camalike.svg');
//             //     photo_like.nextElementSibling.innerHTML = likes;
//             //     // document.getElementById(id).nextSibling.innerHTML = likes;
//             // }
//         }
//     };
//
//     req.open('POST', 'http://localhost:8101/showLikes/'+id);
//     req.send();
// }