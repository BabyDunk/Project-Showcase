<?php
	
	
	$message          = [];
	$notify           = '';
	$fileWrite        = 0;
	
	if ( isset( $_POST[ 'submit' ] ) )
	{
		
		if ( empty( $_POST[ 'dbhost' ] ) )
		{
			
			$message[] = 'You need to supply a valid host';
			
		}
		if ( empty( $_POST[ 'dbname' ] ) )
		{
			$message[] = 'You need to supply a valid database name';
		}
		if ( empty( $_POST[ 'dbuser' ] ) )
		{
			$message[] = 'You need to supply a valid database user';
		}
		if ( empty( $_POST[ 'dbpass' ] ) )
		{
			$message[] = 'You need to supply a valid database password';
		}
		if ( empty( $_POST[ 'dbprefix' ] ) )
		{
			$message[] = 'You need to supply a database prefix';
		}
		if ( empty( $_POST[ 'dbcharset' ] ) )
		{
			$message[] = 'You need to supply a valid charset';
		}
		
		
		if ( ! empty( $message ) )
		{
			
			$notify = outputMessage( $message );
			
		}
		else
		{
			
			if ( is_file( './includes/config.php' ) )
			{
				
				$data = '<?php';
				$data .= PHP_EOL;
				$data .= PHP_EOL;
				$data .= PHP_EOL;
				$data .= '// Database Credentials';
				$data .= PHP_EOL;
				$data .= '$DB_HOST = "' . $_POST[ 'dbhost' ] . '";';
				$data .= PHP_EOL;
				$data .= '$DB_USER = "' . $_POST[ 'dbuser' ] . '";';
				$data .= PHP_EOL;
				$data .= '$DB_PASS = "' . $_POST[ 'dbpass' ] . '";';
				$data .= PHP_EOL;
				$data .= '$DB_NAME = "' . $_POST[ 'dbname' ] . '";';
				$data .= PHP_EOL;
				$data .= '$DB_CHARSET = "' . $_POST[ 'dbcharset' ] . '";';
				$data .= PHP_EOL;
				$data .= '$DB_PREFIX = "' . $_POST[ 'dbprefix' ] . '";';
				$data .= PHP_EOL;
				$data .= PHP_EOL;
				$data .= '// Composer AutoLoader';
				$data .= PHP_EOL;
				$data .= 'require SITE_ROOT . "vendor/autoload.php";';
				$data .= PHP_EOL;
				
				
				if ( file_put_contents( './includes/config.php' , $data ) )
				{
					$fileWrite = 1;
					
					require_once( "./index.php" );
					require_once( './includes/src/sql/table_structure.php' );
					
					foreach ( $sqlQueries as $query )
					{
						if ( $pdo->query( $query ) )
						{
							continue;
						}
						else
						{
							$notify = outputMessage( $message[] = 'Encountered a problem building database' );
							break;
						}
					}
					
					
				}
				else
				{
					$notify = outputMessage( $message[] = 'Could write config, Please retry' );
					
				}
			}
			else
			{
				$notify = outputMessage( $message[] = 'Config not found' );
			}
		}
	}
    elseif ( isset( $_POST[ 'submitSiteData' ] ) )
	{
		$fileWrite = 1;
		
		require_once( './index.php' );
		
		
		$post = \Classes\Core\Params::get( 'post' );
		
		
		if ( ! \Classes\Core\Params::has( 'sitename' ) )
		{
			$message[] = 'Need to supply a sitename';
		}
		if ( ! \Classes\Core\Params::has( 'siteurl' ) )
		{
			$message[] = 'Need to supply a siteurl';
		}
		
		if ( ! \Classes\Core\Params::has( 'sitetitle' ) )
		{
			$message[] = 'Need to supply a site title';
		}
		
		if ( ! \Classes\Core\Params::has( 'adminuser' ) )
		{
			$message[] = 'Need to supply a username';
		}
		
		if ( ! \Classes\Core\Params::has( 'admipassword' ) )
		{
			$message[] = 'Need to supply a password';
		}
		if ( ! \Classes\Core\Params::has( 'adminemail' ) )
		{
			$message[] = 'Need to supply an email address';
		}
		
		
		
		
		if ( ! empty( $message ) )
		{
			$notify = outputMessage( $message );
		}
		else
		{
			
			sca_set_preference( 'showcase' , 'sca_sitename' , $post->sitename );
			sca_set_preference( 'showcase' , 'sca_sitetitle' , $post->sitetitle );
			sca_set_preference( 'showcase' , 'sca_siteurl' , $post->siteurl );
			
			$user = new \Classes\Core\User();
			$hash = new \Classes\Core\Hashing();
			
			$user->username   = $post->adminuser;
			$user->password   = $hash->hashIt( $post->admipassword );
			$user->email      = $post->adminemail;
			$user->privilege  = 1;
			$user->created_at = date( "Y-m-d H:i:s" );
			
			if ( $user->create() )
			{
				global $pdo;
				$sess = new \Classes\Core\Session();
				
				$setloginId = json_decode( json_encode( [ 'id' => $pdo->lastInsertedId() ] ) , false );
				
				$sess->login( $setloginId );
				$msg = "Script installed sucessfully, \nPlease complete the rest of the settings";
				\Classes\Core\Session::set( 'MESSAGE' , $msg );
				
				
				# Set is installed to true
				$addedData = PHP_EOL;
				$addedData .= PHP_EOL;
				$addedData .= '// Set is installed flag';
				$addedData .= PHP_EOL;
				$addedData .= '$IS_INSTALLED = true;';
				$addedData .= PHP_EOL;
				
				if ( file_put_contents( './includes/config.php' , $addedData , FILE_APPEND ) )
				{

				    $IS_INSTALLED = true;
				    $fileWrite = 2;
		
					# delete install.php
					unlink( './install.php' );
				}
				
				
			}
			else
			{
				$message[] = 'Could not create user';
				$notify    = outputMessage( $message );
			}
			
		}
		
	}
	
	function outputMessage( $messageArr )
	{
		
		$theMessages = '';
		if ( ! empty( $messageArr ) )
		{
			$theMessages .= '<div class="messages">';
			foreach ( $messageArr as $message )
			{
				if ( ! empty( $message ) )
				{
					$theMessages .= '<span class="message">' . $message . '</span>';
				}
			}
			$theMessages .= '</div>';
		}
		
		
		return $theMessages;
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Install Project Showcase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex;
            justify-content: center;
            min-height: 100vh;
            min-width: 100vw;
            align-items: center;
        }

        .installPanel {
            -webkit-border-radius: 7px;
            -moz-border-radius: 7px;
            border-radius: 7px;
            border: 1px solid #ccc;
            padding: 21px;
        }

        form label {
            display: block;
            width: 100%;
            margin-top: 21px;
        }

        form input {
            width: 90%;
            padding: 7px
        }

        input[type="submit"] {
            display: block;
            width: 73%;
            margin-top: 21px;
        }

        .messages {
            padding: 21px;
            border: 1px solid red;
            -webkit-border-radius: 7px;
            -moz-border-radius: 7px;
            border-radius: 7px;
            background-color: rgba(222, 5, 27, 0.58);
        }

        .messages > .message {
            display: block;
            margin-top: 7px;
            font-size: 1.2em;
            font-weight: 600;
        }

    </style>
</head>
<body>
<div class="installPanel">
	<?php
		if ( ! empty( $notify ) )
		{
			echo $notify;
		}
	?>
    <h1>Project Showcase Installer</h1>
	
	<?php if ( $fileWrite === 1 ) { ?>

        <form method="POST" action="" enctype="">
            <label for="sitename">Website Name</label>
            <input type="text" name="sitename" id="sitename"
                   value="<?php echo ( isset( $_POST[ 'sitename' ] ) ) ? $_POST[ 'sitename' ] : '' ?>" required
                   placeholder="Website Name"/>
            <label for="sitetitle">Website Title</label>
            <input type="text" name="sitetitle" id="sitetitle"
                   value="<?php echo ( isset( $_POST[ 'sitetitle' ] ) ) ? $_POST[ 'sitetitle' ] : '' ?>" required
                   placeholder="Website Title"/>
            <label for="siteurl">Website URL</label>
            <input type="url" name="siteurl" id="siteurl"
                   value="<?php echo ( isset( $_POST[ 'siteurl' ] ) ) ? $_POST[ 'siteurl' ] : '' ?>" required
                   placeholder="Website URL eg; https://www.example.com/"/>
            <label for="adminuser">Admin Username</label>
            <input type="text" name="adminuser" id="adminuser"
                   value="<?php echo ( isset( $_POST[ 'adminuser' ] ) ) ? $_POST[ 'adminuser' ] : '' ?>" required
                   placeholder="Admin Username"/>
            <label for="adminemail">Admin Email Address</label>
            <input type="email" name="adminemail" id="adminemail"
                   value="<?php echo ( isset( $_POST[ 'adminemail' ] ) ) ? $_POST[ 'adminemail' ] : '' ?>" required
                   placeholder="Admin Email Address"/>
            <label for="admipassword">Admin Password</label>
            <input type="password" name="admipassword" id="admipassword"
                   value="<?php echo ( isset( $_POST[ 'admipassword' ] ) ) ? $_POST[ 'admipassword' ] : '' ?>" required
                   placeholder="Admin Password"/>
            <input type="submit" name="submitSiteData" id="submit" value="Submit!"/>
        </form>
	
	<?php } elseif($fileWrite === 2) { ?>

        <div id="success-box">
            <span class="h3">
                You have success
            </span>
            <p>The script has finished installing and is ready to your.</p>
            <p><strong>Things to know</strong></p>
            <ul>
                <li>This scripts is in pre-alpha mode(ie; still needs alot of work)</li>
                <li>The idea behind this script was to build a personal portfolio website for developers</li>
                <li>There is some structure for a shopping cart. At present you can list your projects but hope to have a payment gateway added at some point</li>
                <li>If you would like to add to this project your can find it <a href="https://github.com/BabyDunk/Project-Showcase" target="_blank" >Here on github</a> </li>
            </ul>
            
            <form method="POST" action="/sc-panel/general_settings" enctype="">
                <input type="submit" name="submit" id="submit" value="Continue to Setup" />
            </form>
        </div>
        
	<?php } else { ?>

        <form method="POST" action="" enctype="">
            <label for="dbhost">Database Host Location</label>
            <input type="text" name="dbhost" id="dbhost"
                   value="<?php echo ( isset( $_POST[ 'dbhost' ] ) ) ? $_POST[ 'dbhost' ] : '' ?>" required
                   placeholder="DB Host eg; localhost"/>
            <label for="dbname">Database Name</label>
            <input type="text" name="dbname" id="dbname"
                   value="<?php echo ( isset( $_POST[ 'dbname' ] ) ) ? $_POST[ 'dbname' ] : '' ?>" required
                   placeholder="DB Name"/>
            <label for="dbuser">Database Username</label>
            <input type="text" name="dbuser" id="dbuser"
                   value="<?php echo ( isset( $_POST[ 'dbuser' ] ) ) ? $_POST[ 'dbuser' ] : '' ?>" required
                   placeholder="DB Username"/>
            <label for="dbpass">Database Password</label>
            <input type="password" name="dbpass" id="dbpass"
                   value="<?php echo ( isset( $_POST[ 'dbpass' ] ) ) ? $_POST[ 'dbpass' ] : '' ?>" required
                   placeholder="DB Password"/>
            <label for="dbcharset">Database Charset</label>
            <input type="text" name="dbcharset" id="dbcharset"
                   value="<?php echo ( isset( $_POST[ 'dbcharset' ] ) ) ? $_POST[ 'dbcharset' ] : 'utf8mb4' ?>" required
                   placeholder="DB Charset eg; utf8mb4"/>
            <label for="dbprefix">Database Table Prefix</label>
            <input type="text" name="dbprefix" id="dbprefix"
                   value="<?php echo ( isset( $_POST[ 'dbprefix' ] ) ) ? $_POST[ 'dbprefix' ] : 'sc_' ?>" required
                   placeholder="DB Table Prefix eg; sc_"/>
            <input type="submit" name="submit" id="submit" value="Submit!"/>
        </form>
	
	<?php } ?>
</div>
</body>
</html>