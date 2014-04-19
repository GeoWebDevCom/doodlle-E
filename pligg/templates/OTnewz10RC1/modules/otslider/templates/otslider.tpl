		<section id="otSlider">
			<h2 class="otSliderHeader hidden">Featured Articles and Stories</h2>
			<ul id="otSliderEntries">
				{section name=otSlides loop=$slidesList}
				<li>
					<a href="{$slidesList[otSlides].otslider_link}" target="{$slidesList[otSlides].otslider_link_target}">
						<h3 class="otSliderTitle">{$slidesList[otSlides].otslider_title}</h3>
						<img src="{$otsliderPath}data/uploads/{$slidesList[otSlides].otslider_image}" alt="{$slidesList[otSlides].otslider_image_alt}" />
					</a>
				</li>
				{/section}
			</ul>
		</section>