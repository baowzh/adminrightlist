<?php if (!defined('THINK_PATH')) exit();?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo C('DEFAULT_CHARSET');?>"/>
    <title><?php echo C('welcome');?></title>
    <script type="text/javascript">
        var _root_ = '__ROOT__';
        var _url_ = '__URL__';
        var _upload_ = '__UPLOAD__';
        var _app_ = '__APP__';
        var _public_ = '__PUBLIC__';
        var _index_ = '__Index__';
    </script>
	
    <script type="text/javascript" src="../Public/js/public.js"></script>
    <link rel="stylesheet" type="text/css" href="../Public/css/style.css"/>
    <script type="text/javascript" src="__ROOT__/Public/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="__ROOT__/Public/Plugins/jquery.artDialog/jquery.artDialog.js?skin=simple"></script>
    <script type="text/javascript" src="__ROOT__/Public/Plugins/jquery.artDialog/iframeTools.js"></script>
    <script type="text/javascript" src="__ROOT__/Public/Plugins/jquery.artDialog/atrDialog.function.js"></script>

    <script type="text/javascript" src="__ROOT__/Public/Plugins/uploadify/jquery.uploadify-3.1.min.js"></script>
    <link rel="stylesheet" href="__ROOT__/Public/Plugins/uploadify/uploadify.css"/>
    <script type="text/javascript" src="__ROOT__/Public/Plugins/uploadify/jquery.jUpload.js"></script>

    <link rel="stylesheet" type="text/css" href="../Public/css/ui-lightness/jquery-ui-1.9.0.custom.min.css" />
    <link rel="stylesheet" type="text/css" href="../Public/css/datepicker.css" />
    <script type="text/javascript" src="../Public/js/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="../Public/js/jquery.ui.datepicker.min.js"></script>
	
    <script src="__ROOT__/Public/js/jquery.cityLink.js"></script>
    <script src="http://api.map.baidu.com/api?key=02b627b5ad5892889e9384d61d91bd08&v=1.1&services=true" type="text/javascript"></script>
    <script src="http://api.map.baidu.com/getscript?v=1.1&ak=&services=true&t=20130716024057" type="text/javascript"></script>
    <script src="__ROOT__/Public/js/baidu.js"></script>

    <script type="text/javascript" src="__ROOT__/Public/Plugins/Validform/Validform_v5.3.2_min.js"></script>
    <script type="text/javascript" src="__ROOT__/Public/Plugins/Validform/Validform_Datatype.js"></script>
    <link rel="stylesheet" href="__ROOT__/Public/Plugins/Validform/validform.css"/>


    <script type="text/javascript" src="__ROOT__/Public/Kindeditor/kindeditor-min.js"></script>
    <link rel="stylesheet" type="text/css" href="__ROOT__/Public/Kindeditor/plugins/code/prettify.css"/>
    <script type="text/javascript" src="__ROOT__/Public/js/jquery.allselect.js?23"></script>

    <script type="text/javascript">
        if (self == top) {
            //window.top.location.href = '<?php echo U("login/index");?>';
        }
        window.kinds = {};
        KindEditor.ready(function (K) {
            KindEditor.options.upImgUrl = "<?php echo U('uploadify/kind');?>";
            KindEditor.options.uploadJson = "<?php echo U('uploadify/kind');?>";
            KindEditor.options.upFlashUrl = "<?php echo U('uploadify/kind');?>";
            KindEditor.options.upMediaUrl = "<?php echo U('uploadify/kind');?>";
            KindEditor.options.minWidth = 750;
            KindEditor.options.minHeight = 280;
			 KindEditor.options.items = ["source","|","undo","redo","|","cut","copy","paste","plainpaste","wordpaste","|","justifyleft","justifycenter","justifyright","justifyfull","insertorderedlist","insertunorderedlist","indent","outdent","subscript","superscript","clearhtml","quickformat","selectall","|","fullscreen","/","formatblock","fontname","fontsize","|","forecolor","hilitecolor","bold","italic","underline","strikethrough","lineheight","removeformat","|","image","flash","media","insertfile","table","hr","emoticons","pagebreak","anchor","link","unlink","|","about"];
            $(".kind-text").each(function (i, n) {
                var id = $(n).attr("id") || "kind_" + i;
                $(n).attr("id", id);
                var width = $(n).css("width");
                var height = $(n).css("height");
                window.kinds[id] = K.create(this, $.extend(KindEditor.options,
                        {
                            editorid: id,
                            width: width,
                            height: height,
                            afterBlur: function () {
                                window.kinds[id].sync();
                                $("#" + id).trigger("blur");
                            },
                            afterFocus: function () {
                                window.kinds[id].sync();
                                $("#" + id).trigger("focus");
                            },
                            afterChange: function () {
                                window.kinds[id].sync();
                                $("#" + id).trigger("change");
                            }
                        }));
            });
        });
        $(function () {
		
            $.fn.extend({
                create_calender: function () {
                    var formats = $(this).attr("format") || "yy-mm-dd";
                    var yearRange = $(this).attr("year") || "c-60:c+20";
                    try {
                        $(this).datepicker({
                            changeMonth: true,
                            changeYear: true,
                            yearRange: yearRange,
                            dateFormat: formats,
                            onSelect: function () {
                                if (window.Validform[this.form.id]) {
                                    window.Validform[this.form.id].check(false,this);
                                }
                            }
                        });
                    } catch (ex) {
                    }
                }})
            $("input.calender,#birthday_picker").create_calender();
        })

        function getRandom(n) {
            return Math.floor(Math.random() * n + 1)
        }
    </script>
</head>
<body width="100%">
<div id="result" class="result none"></div>
<div class="mainbox">
<script type="text/javascript">
	var root = "__ROOT__", index = "__Index__";
</script>
<link href="../Public/css/qingdan.css" type='text/css' rel='stylesheet' />
<!-- <script type="text/javascript" src="../Public/jquery-treetable/jquery-1.9.1.min.js"></script> -->
<script type="text/javascript"
	src="../Public/jquery-treetable/jquery.treetable-ajax-persist.js"></script>
<script type="text/javascript"
	src="../Public/jquery-treetable/jquery.treetable-3.0.0.js"></script>
<script type="text/javascript"
	src="../Public/jquery-treetable/persist-min.js"></script>
<script type="text/javascript"
	src="../Public/jquery-treetable/jquery-ui.min.js"></script>
<link href="../Public/jquery-treetable/css/jquery-ui.css" media="all"
	rel="stylesheet" type="text/css" />
<link href="../Public/jquery-treetable/css/jquery.treetable.css"
	media="all" rel="stylesheet" type="text/css" />
<link href="../Public/jquery-treetable/css/jquery.treetable.theme.css"
	media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet"
	href="__ROOT__/Public/Plugins/uploadify/uploadify.css" />
<script type="text/javascript"
	src="__ROOT__/Public/Plugins/uploadify/jquery.uploadify-3.1.min.js"></script>
<script type="text/javascript"
	src="__ROOT__/Public/Plugins/uploadify/jquery.jUpload.js"></script>
<script type="text/javascript">
	$(function() {
		$('#show_msg').hide();
		$("#upload1")
				.jUpload(
						{
							trigger_id : "t_upload1",
							uploader : "<?php echo U('uploadify/head_img');?>",
							queueID : "upload1-queue",
							formData : {
								"<?php echo session_name(); ?>" : "<?php echo session_id(); ?>",
								"savePath" : "/Upload/images/articles/",
								"saveRule" : "time",
								"divId" : "img1"
							},
							success : function(data, info) {
								$("#processimg").val(data[0].path);
								art.dialog.alert(info);
							}
						});
	})
	function formcheck() {
		return true;
	}
</script>
<div id="nav" class="mainnav_title">
	<ul>
		<a href="<?php echo U('show_list');?>">权利清单列表</a> |
		<a class="on" href="<?php echo U('add');?>">添加权利清单</a>
	</ul>
</div>
<form action="<?php echo U('add');?>" enctype="multipart/form-data" method="post">
	<table border="0" cellspacing="0" cellpadding="0" class="table_form"
		width="100%">
		<tr>
			<th width="120"><span class="red">*</span>项目名称：</th>
			<td colspan="2"><span class="f_left"><input type="text" name="projectname" id="projectname" class="txt" datatype="*" nullmsg="请填写项目名称" errmsg="请填写项目名称" sucmsg=" "></td>
		</tr>
		<tr>
			<th><span class="red">*</span>实时主体：</th>
			<td colspan="2"><select id="departid" name="departid"
				class="txt" nullmsg="请选择所实时主体" errmsg="请选择实时主体" sucmsg=" ">
					<option value="0">请选择</option>
					<?php if(is_array($departs)): $i = 0; $__LIST__ = $departs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["names"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select></td>
		</tr>
		<tr>
			<th><span class="red">*</span>类别：</th>
			<td colspan="2"><select id="classcode" name="classcode"
				class="txt" nullmsg="请选择类别" errmsg="请选择类别" sucmsg=" ">
					<option value="0">请选择</option>
					<?php if(is_array($classes)): $i = 0; $__LIST__ = $classes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["names"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select></td>
		</tr>
		<tr>
			<th width="120"><span class="red">*</span>上级项目：</th>
			<td colspan="2">
				<div class="f_left" style="position: relative;">
					<input type="text" name="parentname" id="parentname" class="txt" readonly="true" datatype="*" ignore="ignore" nullmsg="请填写上级项目名称" errmsg="请填写上级项目名称" sucmsg=" "> <a
						href="javascript:seleparent();">选择</a> <a
						href="javascript:clearparent();">清除</a>
				</div>
			</td>
			<input type="hidden" id="parentid" name="parentid">
		</tr>
		<tr>
			<th>设定依据：</th>
			<td><textarea name="evidence" cols="70" rows="6"
					style="width: 100%" id="evidence"></textarea></td>
			<td width="150"></td>
		</tr>
		<tr>
			<th width="120"><span class="red">*</span>收费标准：</th>
			<td colspan="2"><span class="f_left"><input type="text" name="standard" id="standard" class="txt" datatype="*" nullmsg="请填写收费标准" errmsg="请填写收费标准" sucmsg=" "></td>
		</tr>
		<tr>
			<th width="120"><span class="red">*</span>收费依据：</th>
			<td colspan="2"><span class="f_left"><input type="text" name="taxevidence" id="taxevidence" class="txt" datatype="*" nullmsg="请填写收费依据" errmsg="请填写收费依据" sucmsg=" "></td>
		</tr>
		<tr>
			<th>审批要件：</th>
			<td><textarea name="checkelement" cols="100" rows="12"
					class="kind-text" style="width: 100%" id="checkelement"></textarea></td>
			<td width="150"></td>
		</tr>
		<tr>
			<th width="120"><span class="red">*</span>办理时限：</th>
			<td colspan="2"><span class="f_left"><input type="text" name="timelimit" id="timelimit" class="txt" datatype="*" nullmsg="请填写办理时限" errmsg="请填写办理时限" sucmsg=" "></td>
		</tr>
		<tr>
			<th width="120"><span class="red">*</span>承办机构：</th>
			<td colspan="2"><span class="f_left"><input type="text" name="holddepart" id="holddepart" class="txt" datatype="*" nullmsg="请填写承办机构" errmsg="请填写承办机构" sucmsg=" "></td>
		</tr>
		<tr>
			<th width="120"><span class="red">*</span>联系方式：</th>
			<td colspan="2"><span class="f_left"><input type="text" name="tel" id="tel" class="txt" datatype="*" nullmsg="请填写联系方式" errmsg="请填写联系方式" sucmsg=" "></td>
		</tr>
		<tr>
			<th width="120"><span class="red">*</span>备注：</th>
			<td colspan="2"><span class="f_left"><input type="text" name="comm" id="comm" class="txt" datatype="*" nullmsg="请填写备注" errmsg="请填写备注" sucmsg=" "></td>
		</tr>
		<tr>
			<th>流程图：</th>
			<td colspan="2"><div id="img1"></div>
				<div id="upload1-queue" style="margin-top: 6px;"></div> <input class="isFile" type="hidden" id="processimg" name="processimg"> <input data-msg-isfile="请上传图片" class="isFile" id="upload1" name="file_upload1" type="file">
				<div class="f_left" style="margin: 12px 0 0 6px;">
					<a class="upload_bt" href="javascript:void(0);" id="t_upload1"
						onclick="$('#show_msg').hide();">点击上传</a>
				</div> <span class="Validform_checktip f_left Validform_wrong"
				id="show_msg">请先上传图片再提交</span></td>
		</tr>
		<tr>
			<td height="50"></td>
		</tr>
	</table>
	<div id="btnbox" class="btn">
		<INPUT TYPE="submit" name="submit" value=" 保 存 " class="button">
		<input TYPE="reset" value=" 重 置 " class="button">
	</div>
</form>
<div id="seletable" style="display: none;" class="table-list"
	style="width:100%;">
	<iframe id="myIframe" src="" width="98%" height="98%"></iframe>  
	<!--  
	<table id="treetable" width="400px;">
		<thead>
			<th>项目名称</th>
			<th>实时主体</th>
			<th>选择</th>
		</thead>
		<tbody id="tbody1">

			<?php if(is_array($adminrights)): $i = 0; $__LIST__ = $adminrights;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-tt-id="<?php echo ($vo["id"]); ?>" data-tt-parent-id="<?php echo ($vo["parentid"]); ?>"
				class="ulbc">
				<td style="text-align: left;"><?php if(($vo["haschild"]) != "0"): ?><span class="folder ui-draggable"><?php echo ($vo["projectname"]); ?></span><?php endif; ?> <?php if(($vo["haschild"]) == "0"): ?><span
						class="file ui-draggable"><?php echo ($vo["projectname"]); ?></span><?php endif; ?></td>
				<td><?php echo ($vo["departid"]); ?></td>
				<td><a
					href="javascript:setparentid('<?php echo ($vo["id"]); ?>','<?php echo ($vo["projectname"]); ?>');">选择</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>

		</tbody>
	</table>
	-->
</div>
<script type="text/javascript">
	
	$(document).ready(function() {
			$("#treetable").agikiTreeTable({persist: true, persistStoreName: "files"});
	});
	var seleparent = function() {
		var departidi=$('#departid').val();
		if(departidi==null||departidi=='0'){
			alert('请选择部门。');
			return ;
		}
		$("#seletable").dialog({
			height : 430,
			width : 600,
			resizable : true,
			modal : true,
			open: function(ev, ui){  
	             $('#myIframe').attr('src',"<?php echo U('getProjects');?>/departid/"+$('#departid').val()+"/classcode/"+$('#classcode').val() );  
	          } 
		});
	}
	var setparentid = function(parentid, parentname) {
		$('#parentid').val(parentid);
		$('#parentname').val(parentname);
		$("#seletable").dialog("close");
	}
	var clearparent = function() {
		$('#parentid').val('');
		$('#parentname').val('');
	}
	
</script>
</div>
</body>
</html>
</div>
</body>
</html>