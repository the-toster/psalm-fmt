ifdef ComSpec
    PATHSEP2=\\
else
    PATHSEP2=/
endif

PATHSEP=$(strip $(PATHSEP2))

t:
	vendor$(PATHSEP)bin$(PATHSEP)phpunit test

psalm:
	vendor$(PATHSEP)bin$(PATHSEP)psalm