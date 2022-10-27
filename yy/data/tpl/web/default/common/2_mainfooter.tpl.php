<?php defined('IN_IA') or exit('Access Denied');?>			</div>
		</div>
	</div>
	<div class="foot" id="footer">
		<ul class="links ft">
            <li class="links_item"><div class="copyright"><?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>Powered by <a href="http://www.we7.cc"><b>微擎</b></a> v<?php echo IMS_VERSION;?> © 2014-2015 <a href="http://www.we7.cc">www.we7.cc</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerleft'];?><?php  } ?></div></li>
		</ul>
	</div>

	</body>
</html>

