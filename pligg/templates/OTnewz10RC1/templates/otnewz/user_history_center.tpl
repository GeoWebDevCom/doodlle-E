			{include file=$the_template"/user_header.tpl"}
				{if $user_view eq "profile"}
					profile page
				{/if}
				{if isset($user_page)}
					<section id="xFolkEntries">
						{$user_page}
						{if $user_page eq ""}
							<div class="jumbotron" style="padding:15px 20px;">{#PLIGG_User_Profile_No_Content#}</div>
						{/if}
					</section>
				{/if}
			</div>
			{if isset($user_pagination) && $user_page neq ""}
				{checkActionsTpl location="tpl_pligg_pagination_start"}
				{$user_pagination}
				{checkActionsTpl location="tpl_pligg_pagination_end"}
			{/if}
			{checkActionsTpl location="tpl_pligg_profile_end"}
			