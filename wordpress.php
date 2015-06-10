<?php
/* Short and sweet */
define('WP_USE_THEMES', false);
require('./blog/wp-blog-header.php');

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'getPosts' : getPosts();break;
        case 'getCommentForm' : getCommentForm();break;
    }
}

function getPosts() {
    $result = array();
    $count = $_POST['count'];
    $posts = get_posts('numberposts=' .$count . '&order=ASC&orderby=post_title');

    foreach($posts as $post) {
        $obj = new stdClass();
        $obj->post = $post;
        $obj->comments = get_comments('post_id=' . $post->id);
        array_push($result, $obj);
    }

    echo json_encode($result);
}

function getCommentForm() {
    echo comment_form();
}

?>