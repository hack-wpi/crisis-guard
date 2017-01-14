# !/usr/bin/python
# Copyright 2017 Dave Machado

from clarifai.rest import ClarifaiApp

credFile = '/Users/Dave/github/shltr/userModel/client_secret.txt'

def getCredentials():
	creds = []
	file = open(credFile, 'r')
	creds.append(file.readline())
	creds.append(file.readline())
	return creds

creds = getCredentials()
app = ClarifaiApp(creds[0][:-1], creds[1][:-1])

print(app.models.delete_all())
print(app.inputs.delete_all())
