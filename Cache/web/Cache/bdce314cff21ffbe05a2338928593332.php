<?php if (!defined('THINK_PATH')) exit();?>  
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>清水河县行政权力清单专题</title>
<link rel="stylesheet" href="__ROOT__/Public/css/adminstyle.css" />
<!-- <link rel="stylesheet" href="__ROOT__/Public/css/style.css" /> -->
<SCRIPT type=text/javascript
	src="__ROOT__/Public/js/jquery-1.8.3.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="__ROOT__/Public/js/index.js"></SCRIPT>
<title>清水河县行政权力清单专题</title>
</head>
<body>
	<div class="top_mn">
		<div class="top_content">
			<span class="logo">清水河县人民政府</span><span class="date">今天是：2015年7月25日
				星期六</span> <a href="#"
				onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://www.nmgqsh.gov.cn/');">设为首页</a><a
				href="javascript:window.external.AddFavorite('http://www.nmgqsh.gov.cn/','清水河县人民政府');">加入收藏</a><a
				href="index.html" class="current">返回首页</a>
		</div>
	</div>
<div style="clear: both"></div>

<div class="main_box">
	<div class="box_out">
		<div class="box_out_top"></div>
		<div class="box_out_mid">
			<DIV class="left">

				<DIV class="tab">
					<LI><img src="__ROOT__/Public/img/tab_alb_03.jpg"
						onmouseover="getTypeMenu(this)" onclick="getTypeMenu(this)"
						id="typeMenuClick" border="0"></LI>
					<LI><img onmouseover="getDeptMenu(this)"
						onclick="getDeptMenu(this)" id="deptMenuClick"
						src="__ROOT__/Public/img/tab_alb_04.jpg" border="0"></LI>
					<DIV style="CLEAR: both"></DIV>
				</DIV>
				<DIV style="padding: 10px;">
					<DIV style="WIDTH: 100%; FLOAT: left; HEIGHT: auto;min-height:900px;" id=typeMenu
						class="list">
						<table width="255" border="0" cellpadding="0" cellspacing="0"
							align="center" class="table1">
							<?php if(is_array($departs)): $i = 0; $__LIST__ = $departs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr
								style="background: url(__ROOT__/Public/images/line_bg.jpg) bottom repeat-x;">
								<td style="text-align:left;"><a
									href="<?php echo U('index/index',array('departid'=>$vo['1']['id']));?>"
									class="p14huiwei"><?php echo ($vo[1]["names"]); ?></a></td>
								<td style="text-align:left;"><a
									href="<?php echo U('index/index',array('departid'=>$vo['2']['id']));?>"
									class="p14huiwei"><?php echo ($vo[2]["names"]); ?></a></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</table>
					</DIV>
					<DIV style="HEIGHT: 575px; z-index: 888;" id=deptMenu class="list">
						<table width="255" border="0" cellpadding="0" cellspacing="0"
							align="center" class="table1">
							<?php if(is_array($classes)): $i = 0; $__LIST__ = $classes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr style="background: url(images/line_bg.jpg) bottom repeat-x;">
								<td style="text-align:left;"><a
									href="<?php echo U('index/index',array('classid'=>$vo['1']['id']));?>"
									class="p14huiwei" id="class<?php echo ($vo[1]["id"]); ?>"><?php echo ($vo[1]["names"]); ?></a></td>
								<td style="text-align:left;"><a
									href="<?php echo U('index/index',array('classid'=>$vo['2']['id']));?>"
									class="p14huiwei" id="class<?php echo ($vo[2]["id"]); ?>"><?php echo ($vo[2]["names"]); ?></a></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>

						</table>
					</DIV>
				</DIV>
			</DIV>
			<div class="content_rt" style="position: relative;">
				<form action="<?php echo U('index/index');?>" method="post" id="postform">
					<div class="list_tit" style="height: 50px;">
						<div
							style="height: 40px; margin-top: 12px; width: 260px; float: left; position: relative;"
							id="searchdept">
							<span style="height: 100%; float: left; width: 230px;"
								id="seldept"> 全部 </span>

						</div>
						<div class="ss_tab" style="float: left;">
							<table width="380" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="41" align="left"><img
										src="__ROOT__/Public/images/qdss_icon01.jpg" width="32"
										height="34" onclick="javascript:showdepartlist();" /></td>
									<td width="150"><select name="classid" id="selclass"
										style="height: 26px; width: 140px; text-align: center; color: #333333; border: none; border: 1px solid #ccc;">
											<OPTION value="">请选择</OPTION>
											<?php if(is_array($classes1)): $i = 0; $__LIST__ = $classes1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><OPTION value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["names"]); ?></OPTION><?php endforeach; endif; else: echo "" ;endif; ?>
									</select></td>
									<td width="150"><input type="text" name="projectname" style="border: none; width: 140px; height: 21px; text-align: left; border: 1px solid #ccc;">
									</td>
									<td><img src="__ROOT__/Public/images/qdss_icon02.jpg"
										width="37" height="21" style="padding-top: 5px;" onclick="javascrip:postform();" /></td>
								</tr>
							</table>

						</div>
					</div>
					<input type="hidden" name="departid" id="departid">
				</form>
				<div class="xzflmn_box">
					<?php if(is_array($classes1)): $index = 0; $__LIST__ = $classes1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($index % 2 );++$index;?><a
						href="<?php echo U('index/index',array('classid'=>$vo['id']));?>"
						class="xzfl_mn allclass" id="classi<?php echo ($vo["id"]); ?>"><?php echo ($vo["names"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>

				<div class="news_list">
					<div id="menu_zzjsnet" class="menu_zzjsnet">
						<?php if(is_array($adminrights)): $i = 0; $__LIST__ = $adminrights;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul>
							<span>
								<table width="670" border="0" cellspacing="0" cellpadding="0">
									<tr class="p14hui">
										<td width="89" class="p14hong">[<?php echo ($vo["info"]["departname"]); ?>]</td>
										<td width="456"><?php if(($vo["haschild"]) != "0"): echo ($vo["info"]["projectname"]); endif; ?> <?php if(($vo["haschild"]) == "0"): ?><a href="<?php echo U('index/detail',array('id'=>$vo['id']));?>"
												target="_blank" class="p14hui"> <?php echo ($vo["info"]["projectname"]); ?> </a><?php endif; ?></td>
										<?php if(($vo["info"]["haschild"]) == "0"): ?><td width="71" class="p14hong">[无子项]</td><?php endif; ?>
										<?php if(($vo["info"]["haschild"]) != "0"): ?><td width="71" class="p14hong">[<?php echo ($vo["info"]["haschild"]); ?>子项]</td><?php endif; ?>
									</tr>
								</table>
							</span>
							<?php if(($vo["info"]["haschild"]) != "0"): if(is_array($vo["childs"])): $i = 0; $__LIST__ = $vo["childs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('index/detail',array('id'=>$vo1['id']));?>"
								class="p14hui">
									<ul>
										<span>
											<table width="650" border="0" cellspacing="0" cellpadding="0">
												<tr class="p14hui" style="line-height: 30px;">
													<td width="85" class="p14hong">[<?php echo ($vo1["departname"]); ?>]</td>
													<td width="469"><?php echo ($vo1["projectname"]); ?></td>
													<?php if(($vo1["haschild"]) == "0"): ?><td width="81" class="p14hong">[无子项]</td><?php endif; ?>
													<?php if(($vo1["haschild"]) != "0"): ?><td width="81" class="p14hong">[<?php echo ($vo1["haschild"]); ?>子项]</td><?php endif; ?>


												</tr>
											</table>
										</span>
									</ul>
							</a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</ul><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
				<div class="page" style="position: absolute; bottom: 0px;font-size:13px;width:100%;"><?php echo ($page); ?></div>
			</div>
		</div>
		<div id="departlist"
			style="width: 260px;height:300px;overflow:scroll; position: absolute; top: 28px; display: none; z-index: 799;BACKGROUND-color: #fff; ">
			<table width="210" border="0" cellpadding="0" cellspacing="0"
				align="center" class="table1" style="BACKGROUND-color: #fff;">
				<tbody>
					<?php if(is_array($departs1)): $i = 0; $__LIST__ = $departs1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr
						style="background: url(/adminrightlist/Public/images/line_bg.jpg) bottom repeat-x;">
						<td style="text-align:left;" ><a
							href="javascript:setCurrentDepart('<?php echo ($vo["id"]); ?>','<?php echo ($vo["names"]); ?>');"
							class="p14huiwei"><?php echo ($vo["names"]); ?> </a></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			
		</div>
		<SCRIPT>
			function getTypeMenu(obj) {
				obj.src = "__ROOT__/Public/img/tab_alb_03.jpg";
				$("#deptMenuClick").attr("src",
						"__ROOT__/Public/img/tab_alb_04.jpg");
				$("#typeMenu").show();
				$("#deptMenu").hide();
			}
			function getDeptMenu(obj) {
				obj.src = "__ROOT__/Public/img/tab_lll_04.jpg";
				$("#typeMenuClick").attr("src",
						"__ROOT__/Public/img/tab_lll_03.jpg");
				$("#typeMenu").hide();
				$("#deptMenu").show();
			}
			//function hidedepartlist() {
			//$('#departlist').hide();
			//}
		</SCRIPT>

		<script type="text/javascript">
			$(document).ready(
					function() {
						myMenu = new menu_zzjsnet("menu_zzjsnet", true);
						myMenu.init();
						var hasclassid = '<?php echo ($hasclassid); ?>';
						var hasdepartid = '<?php echo ($hasdepartid); ?>';
						if (hasclassid == '1') {
							getDeptMenu(document
									.getElementById('deptMenuClick'));
							var classid = '<?php echo ($classid); ?>';
							$('#classi' + classid).removeClass('xzfl_mn')
									.addClass('cur_xzfl');
							$('#selclass').val(classid);
						} else {
							$('.allclass:first').removeClass('xzfl_mn')
									.addClass('cur_xzfl');
						}
						if (hasdepartid == '1') {
							getTypeMenu(document
									.getElementById('typeMenuClick'));
						}

					});
		</script>
<div id="bodys"></div>
  <div class="box_out_btm"></div>
		</div>
	</div>
	</body>
</html>