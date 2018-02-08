<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="/enterprise/Public/H+/ico/favicon.ico"> 
    <link rel="stylesheet" type="text/css" href="/enterprise/Public/H+/css/bootstrap.min.css?v=3.3.6" />
    <link rel="stylesheet" type="text/css" href="/enterprise/Public/H+/css/font-awesome.min.css?v=4.4.0" />
    <link rel="stylesheet" type="text/css" href="/enterprise/Public/H+/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="/enterprise/Public/H+/css/style.css?v=4.1.0" />
    <link rel="stylesheet" type="text/css" href="/enterprise/Public/H+/css/plugins/iCheck/custom.css" />
    <title>规则添加</title>

</head>
<body>
	<div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>规则添加 <small></small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="form_basic.html#">选项1</a>
                                </li>
                                <li><a href="form_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <!-- id：主键， title:用户组中文名称， rules：用户组拥有的规则id， 多个规则","隔开，status 状态：为1正常，为0禁用 -->
                    <div class="ibox-content">
                        <form method="POST" class="form-horizontal" action="<?php echo U('Rule/insert');?>">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标题</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="title"  >
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                           <div class="form-group">
                                <label class="col-sm-3 control-label">名称</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name='name'>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                         
                         	<div class="form-group">
                                <label class="col-sm-3 control-label">是否启用</label>
                                <div class="col-sm-6">
				                    <div class="switch">
			                            <div class="onoffswitch">
			                                <input type="checkbox" checked="1" class="onoffswitch-checkbox" name='status' id="example1">
			                                <label class="onoffswitch-label" for="example1">
			                                    <span class="onoffswitch-inner" ></span>
			                                    <span class="onoffswitch-switch" ></span>
			                                </label>
			                            </div>
			                        </div>       
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">级别</label>
                                <div class="col-sm-6">
									<select class="form-control m-b" name="pid">
                                        <option value='0'>顶级</option>
					                        <?php if(is_array($tree)): $i = 0; $__LIST__ = $tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>">
					                            <?php if($vo["level"] == 0): echo ($vo["title"]); ?>
					                            <?php else: ?>
					                                |-<?php echo (str_repeat('-',$vo["level"])); echo ($vo["title"]); endif; ?>
					                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                    
                                </div>
                                
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-5">
                                    <button class="btn btn-primary" type="submit">保存内容</button>
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>

    <!-- 全局js -->

    <script type="text/javascript" src="/enterprise/Public/H+/js/jquery.min.js"></script>
    <script type="text/javascript" src="/enterprise/Public/H+/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="/enterprise/Public/H+/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script type="text/javascript" src="/enterprise/Public/H+/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="/enterprise/Public/H+/js/plugins/layer/layer.min.js"></script>
    <!-- 自定义js -->
    <script type="text/javascript" src="/enterprise/Public/H+/js/hplus.js"></script>
    <script type="text/javascript" src="/enterprise/Public/H+/js/contabs.js"></script>
    <!-- 第三方插件 -->
   
    <!-- <script type="text/javascript" src="/enterprise/Public/H+/Js/Common.js"></script> -->


<script type="text/javascript" src="/enterprise/Public/H+/js/plugins/iCheck/icheck.min.js"></script>

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

	function func()
	{
		alert(1);
	}

</script>

</html>