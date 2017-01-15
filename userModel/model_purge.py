# !/usr/bin/python
# Copyright 2017 Dave Machado

# Purge all models from Clarifai application

from clarifai.rest import ClarifaiApp

credFile = '/home/ubuntu/configs/clarifai_secret.txt'

def getCredentials():
	creds = []
	file = open(credFile, 'r')
	creds.append(file.readline())
	creds.append(file.readline())
	return creds

def main():
	creds = getCredentials()
	app = ClarifaiApp(creds[0][:-1], creds[1][:-1])

	print(app.models.delete_all())
	print(app.inputs.delete_all())

if __name__ == "__main__":
    main()
