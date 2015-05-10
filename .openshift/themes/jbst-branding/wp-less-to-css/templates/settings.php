<?php
include('Bfoxwell/ImagePalette/ImagePalette.php');
include('Bfoxwell/ImagePalette/Color.php');
use  Bfoxwell\ImagePalette\ImagePalette;
if (isset($_POST['SaveCBESettings']) || !empty($_FILES)) {
		
		/* upload the file first */
					
		if(!empty($_FILES))
		{
		
					if(!empty($_FILES['myfile']))
					{
					/* save image */
					if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
					$uploadedfile = $_FILES['myfile'];
					$upload_overrides = array( 'test_form' => false );
					$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
					if(!empty($movefile['error'])) { echo '<div id="message" class="error"><p><strong>'.$movefile['error'].'</strong></p></div>'; }
					else
					{
						    $wp_filetype = $movefile['type'];
							$filename = $movefile['file'];
							$wp_upload_dir = wp_upload_dir();
							$attachment = array(
								'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
								'post_mime_type' => $wp_filetype,
								'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
								'post_content' => '',
								'post_status' => 'inherit'
							);
							$attach_id = wp_insert_attachment( $attachment, $filename);
							
							// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
							require_once( ABSPATH . 'wp-admin/includes/image.php' );

							// Generate the metadata for the attachment, and update the database record.
							$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );

							wp_update_attachment_metadata( $attach_id, $attach_data );
							
							if(!wp_attachment_is_image( $attach_id ))
							{
								wp_delete_attachment($attach_id );
								echo '<div id="message" class="error"><p><strong>Please upload an image (The accepted file extensions/mime types are: .jpg, .jpeg, .gif, .png. )</strong></p></div>';
							}	
							else
							{
							if($brandimageid = get_theme_mod('brandimageid'))
							{
								wp_delete_attachment($brandimageid);
							}		
							$this->save_options($attach_id);
							echo '<div id="message" class="updated"><p><strong>Image saved with id('.$attach_id.').</strong></p></div>';
						    }							
					}
					
					
					
					
				    }
					else
					{
						echo '<div id="message" class="error"><p><strong>Please select an image</strong></p></div>';
					}	
					unset($_POST,$_FILE);
					
					
	    }	
		
		if (!empty($_POST) && check_admin_referer( 'cbe-nonce') ) 
		{
			
			    $SaveCBESettings = 1;
				$in = true;
				$url = wp_nonce_url('themes.php?page=wp-less-to-css','cbe-nonce');
				if (false === ($creds = request_filesystem_credentials($url, '', false, false, array('SaveCBESettings','myfile')) ) ) {
					$in = false;
				}
				if ($in && ! WP_Filesystem($creds) ) {
					// our credentials were no good, ask the user for them again
					request_filesystem_credentials($url, '', true, false,array('SaveCBESettings','myfile'));
					$in = false;
				}
				if($in)
				{
					$attach_id = get_theme_mod('brandimageid',null);
		
					if($attach_id)
					{
						
					//include_once( 'colorsofimage.class.php' );
					//$colors_of_image = new ColorsOfImage(get_attached_file( $attach_id ) );
					//$tmpcolors = cf_sort_hex_colors($colors_of_image->getProminentColors());
					$colors_of_image = new ImagePalette(get_attached_file( $attach_id ) );
					$tmpcolors = cf_sort_hex_colors($colors_of_image->colors);
					$colors = array();
					foreach ($tmpcolors as $color)
					{
							$colors[]=$color;
					}	
					$this->customlesscode = '';

						$this->customlesscode .= '@body-bg:               '.$colors[4].';';
						$this->customlesscode .= '@text-color:            contrast(@body-bg,'.$colors[0].',#fff);';
						$this->customlesscode .= '@link-color:               '.$colors[2].';';
						
						$this->customlesscode .= '@headings-color:         '.$colors[1].';';
						
						$this->customlesscode .= '@navbar-default-color:             '.$colors[3].';';
						$this->customlesscode .= '@navbar-default-bg:                '.$colors[1].';';
						//$this->customlesscode .= '@navbar-default-border:            darken(@navbar-default-bg, 6.5%);

						// Navbar links
						$this->customlesscode .= '@navbar-default-link-color:                '.$colors[3].';';
						//$this->customlesscode .= '@navbar-default-link-hover-color:          #333;
						//$this->customlesscode .= '@navbar-default-link-hover-bg:             transparent;
						$this->customlesscode .= '@navbar-default-link-active-color:        '.$colors[0].';';
						//$this->customlesscode .= '@navbar-default-link-active-bg:            darken(@navbar-default-bg, 6.5%);
						//$this->customlesscode .= '@navbar-default-link-disabled-color:       #ccc;
						//$this->customlesscode .= '@navbar-default-link-disabled-bg:          transparent;
						
						
						$this->customlesscode .= '@footer-bg-color:               '.$colors[0].';';
						$this->customlesscode .= '@footer-text-color:            contrast(@footer-bg-color,#000,'.$colors[4].');';
						$this->customlesscode .= '@footer-link-color:               '.$colors[2].';';
						
		
					
					$this->customlesscode .= 'footer#colophon {h1, h2, h3, h4, h5, h6,
					.h1, .h2, .h3, .h4, .h5, .h6 { color: @footer-text-color}} ';
					
					$this->save_options();
				    $this->wpless2csssavecss($creds);
					set_theme_mod('logo_image',wp_get_attachment_url( $attach_id));
					set_theme_mod('logo_image_position','outside-nav');
					
					echo '<div id="message" class="updated"><p><strong>Settings have been saved.</strong></p></div>';

					}
					else
					{
						echo '<div id="message" class="error"><p><strong>No image found!</strong></p></div>';
					}	
					unset($_POST);
				}
			
			
			
			


	    }
}
if(empty($_POST))
{
	

echo '<div class="wrap">'."\n";
?><h2><?php echo __('Branding','jbstbranding');?></h2><?php 
		
		
		$attach_id = get_theme_mod('brandimageid',null);
		
		
		if(!empty($attach_id) && wp_attachment_is_image($attach_id))
		{
			
			$imageurl = wp_get_attachment_url( $attach_id);
			$imagepath = get_attached_file( $attach_id );
			if(!empty($imageurl) && !empty($imagepath))
			{
			?>
				<img src="<?php echo wp_get_attachment_url( $attach_id);?>" style="max-height:100px;max-width:400px;" /><br> 
			<?php
					
				
					
					
					$colors_of_image = new ImagePalette(get_attached_file( $attach_id ) );
					$colors = $colors_of_image->colors;
					?>

					Colors of the image:<br>
					<?php display_colors( cf_sort_hex_colors($colors) ); 
			}		
		
		}	
		
		// http://cube3x.com/upload-files-to-wordpress-media-library-using-php/
		?>
		<div class="metabox-holder">
		<form id="FeaturedBanners" method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
        <?php wp_nonce_field('cbe-nonce'); ?>
        <div class="postbox" id="image">
        	<h3>Upload your logo here</h3>
            <div class="inside">

				<label for="file">Filename:</label>
				<input type="file" name="myfile" id="myfile">
				<input type="submit" name="submit" value="Submit">

             </div>
        </div><!-- postbox -->
        
              
        </form>
        </div><!-- metabox holder -->
		<div class="metabox-holder">
		<form id="FeaturedBanners" method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
        <?php wp_nonce_field('cbe-nonce'); ?>
        <div class="postbox" id="image">
        	
            <div class="inside">
               <p class="submit"><input type="submit" name="SaveCBESettings" value="Recompile LESS code" class="button-primary" /></p>
            </div>
        </div><!-- postbox -->
        
              
        </form>
        </div><!-- metabox holder -->



        <?php
		echo '</div><!-- wrap -->'."\n";
}

function display_colors( $colors ) {
	?>
	<div style="overflow: hidden">
		<?php foreach ( $colors as $color ) : ?>
			<?php display_color( $color ) ?>
		<?php endforeach; ?>
	</div>
	<?php
}

function display_color( $color ) {
	?>
	<div style="background-color:<?php print $color?>;display:inline-block;width:50px;height:50px;"><?=$color?></div>
	<?php
}
//http://www.logobee.com/blog/categories/logo-design/post/free-logos
//https://gist.github.com/alexkingorg/2158428
function cf_sort_hex_colors($colors) {
	$map = array(
		'0' => 0,
		'1' => 1,
		'2' => 2,
		'3' => 3,
		'4' => 4,
		'5' => 5,
		'6' => 6,
		'7' => 7,
		'8' => 8,
		'9' => 9,
		'a' => 10,
		'b' => 11,
		'c' => 12,
		'd' => 13,
		'e' => 14,
		'f' => 15,
	);
	$c = 0;
	$sorted = array();
	foreach ($colors as $color) {
		$color = strtolower(str_replace('#', '', $color));
		if (strlen($color) == 6) {
			$condensed = '';
			$i = 0;
			foreach (preg_split('//', $color, -1, PREG_SPLIT_NO_EMPTY) as $char) {
				if ($i % 2 == 0) {
					$condensed .= $char;
				}
				$i++;
			}
			$color_str = $condensed;
		}
		$value = 0;
		foreach (preg_split('//', $color_str, -1, PREG_SPLIT_NO_EMPTY) as $char) {
			$value += intval($map[$char]);
		}
		$value = str_pad($value, 5, '0', STR_PAD_LEFT);
		$sorted['_'.$value.$c] = '#'.$color;
		$c++;
	}
	ksort($sorted);
	return $sorted;
}
