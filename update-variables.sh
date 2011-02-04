#!/bin/sh --

#
# This software can be used to communicate with Twitter (http://twitter.com)
#
# If you find any bugs please help and report them. 
# Reporting bugs and submitting patches can be done by sending
# an email to jeremy@nirvani.net.
#
# License Copyright (c) 2011, Jeremy Brand. All rights reserved.
#
# Redistribution and use in source and binary forms, with or without
# modification, are permitted provided that the following conditions are met:
#
# 1. Redistributions of source code must retain the above copyright notice,
# this list of conditions and the following disclaimer.
#
# 2. Redistributions in binary form must reproduce the above copyright notice,
# this list of conditions and the following disclaimer in the documentation
# and/or other materials provided with the distribution.
#
# 3. The name of the author may not be used to endorse or promote products
# derived from this software without specific prior written permission.
#
# This software is provided by the author "as is" and any express or implied
# warranties, including, but not limited to, the implied warranties of
# merchantability and fitness for a particular purpose are disclaimed. In no
# event shall the author be liable for any direct, indirect, incidental,
# special, exemplary, or consequential damages (including, but not limited to,
# procurement of substitute goods or services; loss of use, data, or profits;
# or business interruption) however caused and on any theory of liability,
# whether in contract, strict liability, or tort (including negligence or
# otherwise) arising in any way out of the use of this software, even if
# advised of the possibility of such damage.
#
# @author Jeremy Brand <jeremy@nirvani.net>
#
# @version 2.0.3
#
# @copyright   Copyright (c) 2011, Jeremy Brand. All rights reserved.
#
# @license BSD License
#

source variables.conf



install -m 0644 src/control build/. 
install -m 0644 src/libtwi.php build/. 
install -m 0644 src/libtwi_cli.php build/. 
install -m 0755 src/twi build/. 
unzip -o src/php_twitter_2_0_3.zip twitter.php -d build/.

for i in build/*; 
do
	sed -r -e "s|__TWI_PREFIX__|${prefix}|g" $i > $i.tmp
	mv $i.tmp $i

	sed -r -e "s|__TWI_PHP_PATH__|${path_to_php}|g" $i > $i.tmp
	mv $i.tmp $i
done

cp build/control debian/.


