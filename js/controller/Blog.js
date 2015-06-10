CRC.ns('CRC.controller.Blog');

var WP_PATH = '/shop/wordpress.php';

CRC.controller.Blog = Class.extend(CRC.util.Observable, {

    initialize: function() {

    },

    loadPosts: function(count) {
        var me = this;
        $.ajax({
            url: "/shop/wordpress.php",
            data: {
                action: 'getPosts',
                count: count
            },
            type: 'post',
            success:function(data){
                me.fireEvent('blogPostsLoaded', [$.parseJSON(data)]);
            }
        });
    },

    insertCommentForm: function() {
        var me = this;
        $.ajax({
            url: "/shop/wordpress.php",
            data: {
                action: 'getCommentForm'
            },
            type: 'post',
            success:function(data){
                $('#commentForm').html(data);
            }
        });
    }
});