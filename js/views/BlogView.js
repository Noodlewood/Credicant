CRC.ns('CRC.views.BlogView');
CRC.views.BlogView = Class.extend(CRC.util.Observable, {

    initialize: function(posts) {
        console.log(posts);
        var siteBlog = $('#site-blog');
        $.each(posts, function(index, postObj) {

            var postTitle = $('<div></div>')
                .text(postObj.post.post_title)
                .css('margin-top', "30px")
                .appendTo(siteBlog);

            var postView = $('<div></div>')
                .text(postObj.post.post_content)
                .css('margin-top', "10px")
                .appendTo(siteBlog);

            $.each(postObj.comments, function(index, comment) {
                $('<div></div>')
                    .text(comment.comment_author)
                    .css('margin-top', "10px")
                    .appendTo(siteBlog);

                $('<div></div>')
                    .text(comment.comment_date)
                    .css('margin-top', "10px")
                    .appendTo(siteBlog);

                $('<div></div>')
                    .text(comment.comment_content)
                    .css('margin-top', "10px")
                    .appendTo(siteBlog);
            });
        });
    }
});