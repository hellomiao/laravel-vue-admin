<?php 

	/**
	 * sharelike
	 */

?>

<div class="post-like">
			<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="specsZan <?php if(isset($_COOKIE['specs_zan_'.$post->ID])) echo 'done';?>">
				<i class="iconfont">&#xe612;</i> <span class="count">
					<?php if( get_post_meta($post->ID,'specs_zan',true) ){
								echo get_post_meta($post->ID,'specs_zan',true);
							} else {
								echo '0';
							}?></span>
				</a>
			</div>
			
<div class="post-share">
    <ul class="sharehidden">
		<li><a href="http://www.jiathis.com/send/?webid=weixin&url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'renren-share', 'width=490,height=700');return false;" class="s-weixin"><img src="<?php bloginfo('template_url'); ?>/images/wechat.png"/></a></li>
		<li><a href="http://www.jiathis.com/send/?webid=qzone&url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'weibo-share', 'width=730,height=500');return false;" class="s-qq"><img src="<?php bloginfo('template_url'); ?>/images/qzone.png"/></a></li>
		<li><a href="http://www.jiathis.com/send/?webid=tsina&url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'weibo-share', 'width=550,height=235');return false;" class="s-sina"><img src="<?php bloginfo('template_url'); ?>/images/sina.png"/></a></li>
		<li><a href="http://www.jiathis.com/send/?webid=douban&url=<?php the_permalink(); ?>&title=<?php the_title(''); ?>" onclick="window.open(this.href, 'renren-share', 'width=490,height=600');return false;" class="s-douban"><img src="<?php bloginfo('template_url'); ?>/images/douban.png"/></a></li>
		</ul>
		
		<i class="iconfont show-share">&#xe60c;</i>

	</div>