<?php 
/**
 * @package     mod_installedextensions
 * @author      Pierre Veelen, www.pvln.nl
 * @copyright   Copyright (C) 2018 Pierre Veelen. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('_JEXEC') or die; ?>

<!-- Get the module class suffix-->
<div class="<?php echo $params->get("moduleclass_sfx");?>">

	<!-- Get the text to be displayd before the module-->
	<div> <?php echo $params->get("pretext");?> </div>

<!-- List the installed extions -->	
<?php
	if (count($list)) 
		{
		if ($params->get("listtype") == "0" )
            /* Show all extensions */
			{
			$extensionslist="";
			
			$extensionslist = $extensionslist."<b>".JText::_('MOD_MYINSTALLEDEXTENSIONS_ALL_EXTENTIONS')."</b></br>";
			foreach ($list as $i => $item) :
				{
                /* manifest_cache is json decoded */ 
				$decode = json_decode($item->manifest_cache);
					
				$extensionslist = $extensionslist."\n"
						."<b>".$item->name."</b> "
						.$item->type." "
						.$decode->version." "
						.$decode->creationDate." "
						.$decode->authorUrl." \n"
						."</br>" ;	
				}		
			endforeach;
						
			/* list text */
			echo $extensionslist;
			}
		elseif ($params->get("listtype") == "1" )
			/* show only the non-joomla.org extensions */ 
			{
			$extensionslist="";
			
			$extensionslist = $extensionslist."<b>".JText::_('MOD_MYINSTALLEDEXTENSIONS_NON_JOOMLA_EXTENTIONS')."</b></br>";
			foreach ($list as $i => $item) :
			    {
                /* manifest_cache is json decoded */ 
				$decode = json_decode($item->manifest_cache);
                
                if ( $decode->authorUrl != "www.joomla.org" ) 				
				   {		
				   $extensionslist = $extensionslist."\n"
						."<b>".$item->name."</b> "
						.$item->type." "
						.$decode->version." "
						.$decode->creationDate." "
						.$decode->authorUrl." \n"
				   	    ."</br>" ;
				   }						
				}		
			endforeach;
						
			/* list text */
			echo $extensionslist;
			}

		}	

	else /* no extensions found */
		{
		echo JText::_('MOD_MYINSTALLEDEXTENSIONS_NO_EXTENSIONS');
		}	
?>
	
	<!-- Get the text to be displayd after the module-->	
	<div><?php echo $params->get("posttext");?></div>

</div>
