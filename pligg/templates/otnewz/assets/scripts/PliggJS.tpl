{literal}
<script>
/*
 * Pligg JavaScript Functions
 * htpp://www.pligg.com/
 * Creative Commons Attribution 3.0 Unported Copyright
 * http://creativecommons.org/licenses/by/3.0/
*/
var siteURL = '{/literal}{$my_base_url}{literal}';
var siteBase = '{/literal}{$my_pligg_base}{literal}';
var anonymousVote = {/literal}{$anonymous_vote}{literal};
{/literal}{if $anonymous_vote eq "false" && $user_authenticated eq true}{literal}
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
					var unvoteLink = $('#xfolkentryVote-'+htmlid+' .'+(value>0 ? 'xfolkentryBuried' : 'xfolkentryVoted'));
					if (unvoteLink.length)
					unvoteLink.attr('href', unvoteLink.attr('href').replace(/unvote/,'vote')).removeClass(value>0 ? 'xfolkentryBuried' : 'xfolkentryVoted');
					
					var voteLink = $('#xfolkentryVote-'+htmlid+' > li:'+(value>0 ? 'first>a' : 'last>a'));
					voteLink.addClass(value>0 ? 'xfolkentryVoted' : 'xfolkentryBuried').attr('href', voteLink.attr('href').replace(/vote/,'unvote'))

					$('#xfolkentryVoteNum-'+htmlid+'>a').hide().html(voteResult.split('~')[0]).fadeIn('slow');
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
					var unvoteLink = $('#xfolkentryVote-'+htmlid+' > li:'+(value>0 ? 'first>a' : 'last>a'));
					unvoteLink.removeClass(value>0 ? 'xfolkentryVoted' : 'xfolkentryBuried').attr('href', unvoteLink.attr('href').replace(/unvote/,'vote'));
					
					$('#xfolkentryVoteNum-'+htmlid+'>a').hide().html(unvoteResult.split('~')[0]).fadeIn('slow');
				}
			}
		});
	}
}
{/literal}{/if}{literal}
{/literal}{if $user_authenticated eq true && $pagename eq "story"}{literal}
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
					var cUnvoteLink = $('#commentVote-'+htmlid+' .'+(value>0 ? 'commentBuried' : 'commentVoted'));
					if (cUnvoteLink.length)
					cUnvoteLink.attr('href', cUnvoteLink.attr('href').replace(/cunvote/,'cvote')).removeClass(value>0 ? 'commentBuried' : 'commentVoted');
					
					var cvoteLink = $('#commentVote-'+htmlid+' > li:'+(value>0 ? 'first>a' : 'last>a'));
					cvoteLink.addClass(value>0 ? 'commentVoted' : 'commentBuried').attr('href', cvoteLink.attr('href').replace(/cvote/,'cunvote'))
					
					$('#commentVoteNum-'+htmlid).hide().html(cVoteResult.split('~')[0]).fadeIn('slow');
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
					var cUnvoteLink = $('#commentVote-'+htmlid+' > li:'+(value>0 ? 'first>a' : 'last>a'));
					cUnvoteLink.removeClass(value>0 ? 'commentVoted' : 'commentBuried').attr('href', cUnvoteLink.attr('href').replace(/cunvote/,'cvote'));
					
					$('#commentVoteNum-'+htmlid).hide().html(cUnvoteResult.split('~')[0]).fadeIn('slow');
				}
			}
		});
	}
}
{/literal}{/if}{literal}
</script>
{/literal}