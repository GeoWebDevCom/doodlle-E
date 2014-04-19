			{include file=$the_template"/user_header.tpl"}
				{if $user_view eq "profile"}
					{include file=$the_template"/user_profile.tpl"}
				{/if}
				{if isset($user_page)}
					{$user_page}
					{if $user_page eq ""}
						<div class="jumbotron" style="padding:15px 25px;"><p style="padding:0;margin:0;font-size:1.1em;">{#PLIGG_User_Profile_No_Content#}</p></div>
					{/if}
				{/if}
				{if isset($user_pagination) && $user_page neq ""}
					{checkActionsTpl location="tpl_pligg_pagination_start"}
					{$user_pagination}
					{checkActionsTpl location="tpl_pligg_pagination_end"}
				{/if}
				{checkActionsTpl location="tpl_pligg_profile_end"}
			</div>