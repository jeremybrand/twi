
Command line TWitter Interface (aka. twi)

Twi is written by Jeremy Brand and utilizes Tijs Verkoyen's OAuth twitter_oauth
class.

- twi (aka. TWitter Interface) is a twitter command line client meant to be
  simple to use and send updates quickly from the unix command line. The only
  additional feature at this time is deleting a tweet.

Bonus feature, scripting/cron output to twitter!

- twi allows as much as 99 twi-sized tweets worth of data to be piped in via
  stdin.  This means you can tweet status easily via cronjobs, even to
  different twitter accounts. Technically, this is not another feature, just
  another way to use it.

- Yes, it is all over SSL.

Goals

- Keep features few but useful.
- Mostly stable command line api. I don't expect this to change much now.




.deb packages were tested on the following OS:

	- Debian GNU/Linux 5.0 (aka Lenny)
	- Debian GNU/Linux 6.0 (aka Squeeze)
	- Debian GNU/kFreeBSD 6.0 (aka Squeeze)

.deb packages should work pretty seamlessly on The following Ubuntu:

	- Ubuntu greater than or equal to version 10.


	
