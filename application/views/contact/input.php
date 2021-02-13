<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE HTML>
<!--[if IE 6]> <html class="no-js ie6" lang="ja"> <![endif]-->
<!--[if IE 7]> <html class="no-js ie7" lang="ja"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8" lang="ja"> <![endif]-->
<html class="no-js" lang="ja-JP"><!-- InstanceBegin template="/Templates/contact.dwt" codeOutsideHTMLIsLocked="false" --> <!--<![endif]-->
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">

<title>Test</title>
<meta name="keywords" content="test">
<meta name="description" content="">
<link rel="shortcut icon" href="/pfw_view/inc/images/common/ico/favicon.ico">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>form/inc/pfw/css/pfw.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>form/inc/css/contents/form.css">



</head>
<body  id="pfw-form">
<div id="container">
<div id="main">
	
	<h1>Test</h1>

	<div id="contents">
	<?php   echo form_open_multipart(site_url('contact/confirm'));?>
		<div style="display:none">
</div>		
			<div class="section">
				<div class="form_wrap form_error"  data-form-group="name">
					<div class="form_title_wrap">
						<h4 class="typeA">
							<label for="name">Input A</label>
							<span class="ico_must">必須</span>
						</h4>
					</div>
				
					<div class="form_group_wrap">
						<div class="form_group_inner type_postal_code">
							<div class="form_txt type_name long">
								<input type="text" name="name" value="<?php echo @$post['name']; ?>" class="zenkaku" data-ime-mode="active"  />								<span class="example">例：株式会社ALLアセットパートナーズ　</span>
							</div>
						</div>
					</div>
					<!-- /form_wrap --> 
				</div>
				
				<div class="form_wrap form_error"  data-form-group="message">
					<div class="form_title_wrap">
						<h4 class="typeA">
							<label for="message">Input B</label>
							<span class="ico_must">必須</span>
						</h4>
					</div>
			
					<div class="form_group_wrap">
						<div class="form_group_inner">
							<div class="form_txt long">
								<input  type='file' name='csv' id="csv">
						</div>
					</div>
					<!-- /form_wrap --> 
				</div>
			</div>
	
			<div class="btn_area">
				<div class="btn_wrap_next first">
					<button class="btn point" type="submit">Submit</button>
				</div>
		</div>
		</form>	</div>
	</div>
	</div>
	
	

</div>

</body>
</html>
