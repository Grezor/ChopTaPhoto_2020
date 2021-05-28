$(document).ready(function () {
    // on sauvegarde le bot
    const $vote = $('#vote');
    //detecte lorsque l'on clique sur le click
    $('.vote_like', $vote).click(function (e) {
        e.preventDefault();
        // j'envoie mes donner en post
        vote(1)
    });
    $('.vote_dislike', $vote).click(function (e) {
        e.preventDefault();
        // j'envoie mes donner en post
        vote(-1)
    });
    // alert('lol');

    function vote(value)
    {
        $.post('like.php', {
            ref: $vote.data('data'),
            ref_id: $vote.data('ref_id'),
            user_id: $vote.data('user_id'),
            vote : value
        }).done(function (data, textStatus, jqXHR) {
            console.log(data);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
        });
    }
});