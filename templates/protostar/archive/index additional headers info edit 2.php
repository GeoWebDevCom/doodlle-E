<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// clarky edit 1
if(!defined('DS')){
    define('DS',DIRECTORY_SEPARATOR);
}

require (JPATH_ROOT.DS.'components' .DS.'com_socialpinboard'. DS . 'layouts/socialpinboard.php');

JHtml::_('behavior.framework', true);
//create instance for the class
$thumb = new thumb();
$fthumb = $thumb->fthumb();

//for show request approval
$showRequest= $thumb->showRequest();

if(count($fthumb)!=0){
 if($fthumb[0]->link_type=='youtube' || $fthumb[0]->link_type=='vimeo')
    {     
    $srcPath = $fthumb[0]->pin_image;
    }
    else{
        $srcPath = JURI::base()."images/socialpinboard/pin_original/" . $fthumb[0]->pin_image;
    }
    
}
$pinId = JRequest::getVar('pinid');
$app= JFactory::getApplication();
$doc= JFactory::getDocument();
$templateparams	= $app->getTemplate(true)->params;
$config=JFactory::getConfig();
$site_name = $config->get('sitename');
$logo= $this->params->get('logo');

// clarky edit end 1

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params; 

$app = JFactory::getApplication(); 
$doc = JFactory::getDocument(); 
$this->language = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}


// clarky edit
$jinput = JFactory::getApplication()->input;
$pid = $jinput->get('pid');
// end 

// *************social pinboard won't work with this*************
// Add JavaScript Frameworks 
// JHtml::_('bootstrap.framework');
// $doc->addScript('templates/' .$this->template. '/js/template.js');
// *************social pinboard won't work with this*************

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Add current user information
$user = JFactory::getUser();

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	
	// clarky edit 
	if(isset($pid)) {
		$span = "span12";
	}
	else {
	$span = "span9";
	}
	// end clarky edit
	
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="'. JUri::root() . $this->params->get('logoFile') .'" alt="'. $sitename .'" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="'. $sitename .'">'. htmlspecialchars($this->params->get('sitetitle')) .'</span>';
}
else
{
	$logo = '<span class="site-title" title="'. $sitename .'">'. $sitename .'</span>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	
	<!-- clarky edit 1-->
	<script>
var loading_next_pins="<?php echo JTEXT::_('COM_SOCAILPINBOARD_HEADER_LOADING_NEXT_PINS'); ?>";
</script>

    <?php if(count($fthumb)!=0){ ?>
            <link rel="image_src" href="<?php echo $srcPath; ?>"/>
<link rel="canonical" href="<?php echo JURI::base() .JRoute::_('index.php?option=com_socialpinboard&view=pin&pinid='.$pinId);?>"/>
     <meta property="fb:app_id" content="<?php echo $showRequest;?>"/>
<meta property="og:site_name" content="<?php echo $site_name; ?>"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?php echo JURI::base() .JRoute::_('index.php?option=com_socialpinboard&view=pin&pinid='.$pinId);?>"/>
<meta property="og:title" content="<?php echo $fthumb[0]->pin_description; ?>"/>
<meta property="og:description" content="<?php echo $fthumb[0]->pin_description; ?>"/>
<meta property="og:image" content="<?php echo $srcPath; ?>"/>
     <?php } ?>

 		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/socialpinboard/css/media-queries.css" type="text/css" />
	<!-- clarky edit 1 end-->
	<!-- clarky edit 2-->
	     <jdoc:include type="head" />
	     <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	     <meta name="viewport" content="width=device-width, initial-scale=1.0">
	     <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'/>


		<!--[if IE]>
            <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/socialpinboard/css/ie.css" />
        <!--<![endif]-->

	<!-- clarky edit 2 end-->

	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<?php
	// Use of Google Font
	if ($this->params->get('googleFont'))
	{
	?>
		<link href='//fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName');?>' rel='stylesheet' type='text/css' />
		<style type="text/css">
			h1,h2,h3,h4,h5,h6,.site-title{
				font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFontName'));?>', sans-serif;
			}
		</style>
	<?php
	}
	?>
	<?php
	// Template color
	if ($this->params->get('templateColor'))
	{
	?>
	<style type="text/css">
		body.site
		{
			border-top: 3px solid <?php echo $this->params->get('templateColor');?>;
			background-color: <?php echo $this->params->get('templateBackgroundColor');?>
		}
		a
		{
			color: <?php echo $this->params->get('templateColor');?>;
		}
		.navbar-inner, .nav-list > .active > a, .nav-list > .active > a:hover, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .nav-pills > .active > a, .nav-pills > .active > a:hover,
		.btn-primary
		{
			background: <?php echo $this->params->get('templateColor');?>;
		}
		.navbar-inner
		{
			-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
		}
	</style>
	
	
	<!-- clarky edit 1 -->
	      <?php
	            $headerstuff=$this->getHeadData();
	            reset($headerstuff['scripts']);
	            foreach($headerstuff['scripts'] as $key=>$value){ 

	            if (strstr($key,"/media/system/js/mootools-core.js") || strstr($key,"/media/system/js/mootools-more.js") )
	            {
	            unset($headerstuff['scripts'][$key]);
	            }        }
	            $this->setHeadData($headerstuff);
	        ?>   
	        <?php
	            $files = JHtml::_('stylesheet','templates/socialpinboard/css/template.css',null,false,true);
	            if ($files):
	            if (!is_array($files)):
	            $files = array($files);
	            endif;
	            foreach($files as $file):
	        ?>
	            <link rel="stylesheet" href="<?php echo $file;?>" type="text/css" />
	            <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/socialpinboard/css/reset.css" type="text/css" />
	        <?php
	            endforeach;
	            endif;

	            $document = JFactory::getDocument();
	            $document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
	            $document->addScript( 'templates/socialpinboard/js/socialpinboard.js' );
	            $document->addScript( 'templates/socialpinboard/js/scrolldown.js' );

	?>
	<!-- clarky edit 1 end-->
	
	
	<?php
	}
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo $this->baseurl ?>/media/jui/js/html5.js"></script>
	<![endif]-->
</head>



<!-- clarky edit 2 -->
    <?php
    $user = JFactory::getUser();
    if($user->id){
        $style = '.banner_box {display: none; height: 0;}';
$document->addStyleDeclaration($style);
        }else{
            $style = '#wrapper {margin: 105px auto !important;}';
$document->addStyleDeclaration($style);
        }
    ?>

    <?php 
flush();
?>
<!-- clarky edit 2 end-->


<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
?>">

	<!-- Body -->
	<div class="body">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : '');?>">
			<!-- Header -->
			<div class="header-shape"></div>
			<header class="header" role="banner">
				<div class="header-inner clearfix">
					<a class="brand pull-left" href="<?php echo $this->baseurl; ?>">
						<?php echo $logo;?> <?php if ($this->params->get('sitedescription')) { echo '<div class="site-description">'. htmlspecialchars($this->params->get('sitedescription')) .'</div>'; } ?>
					</a>
					<div class="header-search pull-right">
						<jdoc:include type="modules" name="position-0" style="none" />
					</div>
				</div>
			</header>
			<?php if ($this->countModules('position-1')) : ?>
			<nav class="navigation" role="navigation">
				<jdoc:include type="modules" name="position-1" style="none" />
			</nav>
			<?php endif; ?>
			<jdoc:include type="modules" name="banner" style="xhtml" />
			<div class="row-fluid">
				<?php if ($this->countModules('position-8')) : ?>
				<!-- Begin Sidebar -->
				
				<!-- clarky edit -->
				<div id="sidebar" class="span3
					<?php 
					if(isset($pid)) {
						echo "hide";
					}?> ">
					<!--  end clarky edit -->
					
					<div class="sidebar-nav">
						<jdoc:include type="modules" name="position-8" style="xhtml" />
					</div>
				</div>
				<!-- End Sidebar -->
				<?php endif; ?>
				<main id="content" role="main" class="<?php echo $span;?>">
					<!-- Begin Content -->
					<jdoc:include type="modules" name="position-3" style="xhtml" />
					<jdoc:include type="message" />
					<jdoc:include type="component" />
					<jdoc:include type="modules" name="position-2" style="none" />
					<!-- End Content -->
				</main>
				<?php if ($this->countModules('position-7')) : ?>
				<div id="aside" class="span3">
					<!-- Begin Right Sidebar -->
					<jdoc:include type="modules" name="position-7" style="well" />
					<!-- End Right Sidebar -->
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : '');?>">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
			<p class="pull-right">
				<a href="#top" id="back-top">
					<?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
				</a>
			</p>
			<p>
				&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
			</p>
		</div>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>

