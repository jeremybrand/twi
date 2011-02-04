all:	
	@/bin/sh update-variables.sh
	@equivs-build debian/control

root-tar:
	@/bin/sh update-variables.sh

clean:
	@rm -f *.deb
	@rm -f build/*
	@rm debian/control
show:
	dpkg --contents *.deb
	dpkg -I *.deb
