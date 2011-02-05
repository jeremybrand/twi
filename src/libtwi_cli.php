<?php

/*
  This software can be used to communicate with Twitter (http://twitter.com)
 
  If you find any bugs please help and report them. 
  Reporting bugs and submitting patches can be done by sending
  an email to jeremy@nirvani.net.
  
  Copyright (c) 2011, Jeremy Brand. All rights reserved.
  
  Redistribution and use in source and binary forms, with or without
  modification, are permitted provided that the following conditions are met:
  
  1. Redistributions of source code must retain the above copyright notice,
  this list of conditions and the following disclaimer.  
  
  2. Redistributions in binary form must reproduce the above copyright notice,
  this list of conditions and the following disclaimer in the documentation
  and/or other materials provided with the distribution.  
  
  3. The name of the author may not be used to endorse or promote products
  derived from this software without specific prior written permission.
  
  This software is provided by the author "as is" and any express or implied
  warranties, including, but not limited to, the implied warranties of
  merchantability and fitness for a particular purpose are disclaimed. In no
  event shall the author be liable for any direct, indirect, incidental,
  special, exemplary, or consequential damages (including, but not limited to,
  procurement of substitute goods or services; loss of use, data, or profits;
  or business interruption) however caused and on any theory of liability, 
  whether in contract, strict liability, or tort (including negligence or
  otherwise) arising in any way out of the use of this software, even if
  advised of the possibility of such damage.
  
  @author Jeremy Brand <jeremy@nirvani.net> 
  
  @version 2.0.3
  
  @copyright   Copyright (c) 2011, Jeremy Brand. All rights reserved.
 
  @license BSD License

 */


require_once('__TWI_PREFIX__/lib/twi/libtwi.php');

function help() {
        global $argv;
        
        echo "\n";
        echo "  - Default Usage, no arguments (sends tweet):\n";
        echo '    $ ' . $argv[0] . "\n";
        echo "    Type your message and end your transmission with single period (.)\n";
        echo "\n";
        echo "  -d or --delete\n";
        echo "    Deletes a previously tweeted tweet by id from the history.\n";
        echo "    Does not un-send SMSs or tweets that have been delivered.\n";
        echo "\n";
        echo "\n";
        echo "    Help Delete Usage:\n";
        echo '    $ ' . $argv[0] . " --help-delete\n";
        echo "\n";
        echo "    Help Send Usage: \n";
        echo '    $ ' . $argv[0] . " --help-send\n";
        echo "\n";
        echo "  --help or -h\n";
        echo "    show this help\n";
        echo "\n";
 

}

function get_stdin_special() {

        $fd = fopen('php://stdin', 'r');
        if ($fd) {
            while(!feof($fd)) {
                $line = fgets($fd);
                if ($line == ".\n") {
                    fclose($fd);
                    return $buf;
                    # end of message
                } else {
                    # continue reading
                    $buf .= $line;
                }
            }
            fclose($fd);
        } else {
            return(null);
        }
        return $buf;
}



function help_delete() {
        global $argv;

        echo "Usage: \n";
        echo '    $ ' . $argv[0] . ' -d [tweet_id]' . "\n";
        echo "    or\n";
        echo '    $ ' . $argv[0] . ' --delete [tweet_id]' . "\n";
        echo "\n";
        echo "    Deletes a previously tweeted tweet by tweet_id from the history.\n";
        echo "    Does not un-send SMSs or tweets that have been delivered.\n";
        echo "\n";

}

function help_send() {
        global $argv;

        echo "Usage: \n";
        echo '    $ ' . $argv[0] . "\n";
        echo "\n";
        echo "STDIN is your message to be tweeted\n";
        echo "\n";
        echo "    Type your message and end your transmission with single period (.) or EOT\n";
        echo "\n";

}

function send_tweet($msg=null) {

        if ($msg == null) {
            return help_send();
        }

        # Create instance
        $t = new Twi(TWI_CONSUMER_KEY, TWI_CONSUMER_SECRET);
        $t->setUserAgent('twi/1.0.3');

        # set tokens
        $t->setOAuthToken(TWI_OAUTH_TOKEN);
        $t->setOAuthTokenSecret(TWI_OAUTH_SECRET_TOKEN);

        if (strlen($msg) > 0) {
            return $t->longStatusesUpdate($msg);
        } 
        return(null);
}


function delete_tweet($id) {

        switch($id) {
            case "-h":
            case "--help":
            case "help":
            return help_delete();
        }

        # Delete a previously tweeted tweed
        $t = new Twi(TWI_CONSUMER_KEY, TWI_CONSUMER_SECRET);
        $t->setUserAgent('twi/1.0.3');

        # set tokens
        $t->setOAuthToken(TWI_OAUTH_TOKEN);
        $t->setOAuthTokenSecret(TWI_OAUTH_SECRET_TOKEN);
        return $t->statusesDestroy($id);

}

// $Id:$
?>
