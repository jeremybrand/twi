<?php

/*
  This software can be used to communicate with Twitter (http://twitter.com)
 
  If you find any bugs please help and report them. 
  Reporting bugs and submitting patches can be done by sending
  an email to jeremy@nirvani.net.
 
  License Copyright (c) 2011, Jeremy Brand. All rights reserved.
 
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

require_once ('/usr/lib/twi/twitter.php');

class Twi extends Twitter {

    // Extend the twitter.php class to break up long messages into multiple short messages.
    public function longStatusesUpdate($status, $inReplyToStatusId=null, $lat=null, $long=null, $placeId=null, $displayCoordinates=null) {

        $temp = htmlentities(trim($status));
        $status = $temp;
        if (strlen($status) == 0) {
            return(FALSE);
        }
	
        if (strlen($status) > 140 ) {
            $ts = dechex(time());
	
            $split = rand() . "==========SPLIT==========";
            $newtext = wordwrap($status, 122, $split);
            $update_array = explode($split, $newtext);
	
            $i=0;
            $count=count($update_array);
	
            if ($count >= 99 ) {
                print "Your message is too long for twitter";
                return(false);
            }
	
	
            foreach($update_array as $value) {
                $i++;
                $line = "$value ($i/$count)$ts";
                if ($i == 1) {
                    // send tweet 
                    $otweet = self::statusesUpdate($line, $inReplyToStatusId, $lat, $long, $placeId, $displayCoordinates);
	
                    // keep id of this tweet
                    $id = $otweet["id"];
	            } else {
                        // Make tweet relate to first tweet in the thread
                        $atweet = self::statusesUpdate($line, $id, $lat, $long, placeId, $displayCoordinates);
                    }
                    usleep(250000);
            }
	
        } else {
	
                // submit tweet without breaking it up
                $otweet = self::statusesUpdate($status, $inReplyToStatusId, $lat, $long, $placeId, $displayCoordinates);
        }
        return ($otweet);
    } // End longStatusesUpdate


}

// $Id:$
?>
