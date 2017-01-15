# !/usr/bin/python
# Copyright 2017 Dave Machado

from clarifai.rest import ClarifaiApp
import sys

credFile = '/Users/Dave/github/shltr/userModel/client_secret.txt'

def getCredentials():
	creds = []
	file = open(credFile, 'r')
	creds.append(file.readline())
	creds.append(file.readline())
	return creds

def main():
	creds = getCredentials()
	app = ClarifaiApp(creds[0][:-1], creds[1][:-1])
	app.models.create(sys.argv[1])

if __name__ == "__main__":
    main()