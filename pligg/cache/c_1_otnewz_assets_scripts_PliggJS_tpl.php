<?php /* V2.20 Template Lite, 8 March 2008. (c) Mark Dickenson, Jon Langevin. GNU LGPL. 2014-04-19 16:06:23 UTC */ ?>

<?php echo '
<script>
/*
 * Pligg JavaScript Functions
 * htpp://www.pligg.com/
 * Creative Commons Attribution 3.0 Unported Copyright
 * http://creativecommons.org/licenses/by/3.0/
*/
var siteURL = \'';  echo $this->_vars['my_base_url'];  echo '\';
var siteBase = \'';  echo $this->_vars['my_pligg_base'];  echo '\';
var anonymousVote = ';  echo $this->_vars['anonymous_vote'];  echo ';
';  if ($this->_vars['anonymous_vote'] == "false" && $this->_vars['user_authenticated'] == true):  echo '
function vote(user, id, htmlid, md5, value) {
	var voteURL = siteBase + "/vote_total.php";
    var voteAction = "id=" + id + "&user=" + user + "&md5=" + md5 + "&value=" + value;
	
    if (!anonymousVote && user=="") {
		window.location= siteURL + siteBase + "/login.php?return="+location.href;
	}
	else {
		$.ajax({
			type: "POST",
			url: voteURL,
			data: voteAction,
			success: function(voteResult) {
				if (voteResult.match (new RegExp ("^ERROR:"))) {
					alert(voteResult);
   				}
				else {
					var unvoteLink = $(\'#xfolkentryVote-\'+htmlid+\' .\'+(value>0 ? \'xfolkentryBuried\' : \'xfolkentryVoted\'));
					if (unvoteLink.length)
					unvoteLink.attr(\'href\', unvoteLink.attr(\'href\').replace(/unvote/,\'vote\')).removeClass(value>0 ? \'xfolkentryBuried\' : \'xfolkentryVoted\');
					
					var voteLink = $(\'#xfolkentryVote-\'+htmlid+\' > li:\'+(value>0 ? \'first>a\' : \'last>a\'));
					voteLink.addClass(value>0 ? \'xfolkentryVoted\' : \'xfolkentryBuried\').attr(\'href\', voteLink.attr(\'href\').replace(/vote/,\'unvote\'))

					$(\'#xfolkentryVoteNum-\'+htmlid+\'>a\').hide().html(voteResult.split(\'~\')[0]).fadeIn(\'slow\');
				}
			}
		});
	}
}
function unvote(user, id, htmlid, md5, value) {
	var unvoteURL = siteBase + "/vote_total.php";
    var unvoteAction = "unvote=true&id=" + id + "&user=" + user + "&md5=" + md5 + "&value=" + value;
	
    if (!anonymousVote && user=="") {
		window.location= siteURL + siteBase + "/login.php?return="+location.href;
	}
	else {
		$.ajax({
			type: "POST",
			url: unvoteURL,
			data: unvoteAction,
			success: function(unvoteResult) {
				if (unvoteResult.match (new RegExp ("^ERROR:"))) {
					alert(unvoteResult);
   				}
				else {
					var unvoteLink = $(\'#xfolkentryVote-\'+htmlid+\' > li:\'+(value>0 ? \'first>a\' : \'last>a\'));
					unvoteLink.removeClass(value>0 ? \'xfolkentryVoted\' : \'xfolkentryBuried\').attr(\'href\', unvoteLink.attr(\'href\').replace(/unvote/,\'vote\'));
					
					$(\'#xfolkentryVoteNum-\'+htmlid+\'>a\').hide().html(unvoteResult.split(\'~\')[0]).fadeIn(\'slow\');
				}
			}
		});
	}
}
';  endif;  echo '
';  if ($this->_vars['user_authenticated'] == true && $this->_vars['pagename'] == "story"):  echo '
function cvote (user, id, htmlid, md5, value) {
    var cVoteURL = siteBase + "/cvote.php";
	var cVoteAction = "id=" + id + "&user=" + user + "&md5=" + md5 + "&value=" + value;
	
	if (!anonymousVote && user==0) {
		window.location= siteURL + siteBase + "/login.php?return="+location.href;
	}
	else {
		$.ajax({
			type: "POST",
			url: cVoteURL,
			data: cVoteAction,
			success: function(cVoteResult) {
				if (cVoteResult.match (new RegExp ("^ERROR:"))) {
					alert(cVoteResult);
   				}
				else {
					var cUnvoteLink = $(\'#commentVote-\'+htmlid+\' .\'+(value>0 ? \'commentBuried\' : \'commentVoted\'));
					if (cUnvoteLink.length)
					cUnvoteLink.attr(\'href\', cUnvoteLink.attr(\'href\').replace(/cunvote/,\'cvote\')).removeClass(value>0 ? \'commentBuried\' : \'commentVoted\');
					
					var cvoteLink = $(\'#commentVote-\'+htmlid+\' > li:\'+(value>0 ? \'first>a\' : \'last>a\'));
					cvoteLink.addClass(value>0 ? \'commentVoted\' : \'commentBuried\').attr(\'href\', cvoteLink.attr(\'href\').replace(/cvote/,\'cunvote\'))
					
					$(\'#commentVoteNum-\'+htmlid).hide().html(cVoteResult.split(\'~\')[0]).fadeIn(\'slow\');
				}
			}
		});
	}
}
function cunvote(user, id, htmlid, md5, value) {
	var cUnvoteURL = siteBase + "/cvote.php";
	var cUnvoteAction = "unvote=true&id=" + id + "&user=" + user + "&md5=" + md5 + "&value=" + value;
	
	if (!anonymousVote && user==0) {
		window.location = siteURL + siteBase + "/login.php?return="+location.href;
	}
	else {
		$.ajax({
			type: "POST",
			url: cUnvoteURL,
			data: cUnvoteAction,
			success: function(cUnvoteResult) {
				if (cUnvoteResult.match (new RegExp ("^ERROR:"))) {
					alert(cUnvoteResult);
   				}
				else {
					var cUnvoteLink = $(\'#commentVote-\'+htmlid+\' > li:\'+(value>0 ? \'first>a\' : \'last>a\'));
					cUnvoteLink.removeClass(value>0 ? \'commentVoted\' : \'commentBuried\').attr(\'href\', cUnvoteLink.attr(\'href\').replace(/cunvote/,\'cvote\'));
					
					$(\'#commentVoteNum-\'+htmlid).hide().html(cUnvoteResult.split(\'~\')[0]).fadeIn(\'slow\');
				}
			}
		});
	}
}
';  endif;  echo '
</script>
'; ?>
