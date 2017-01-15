# !/usr/bin/python
# Copyright 2017 Dave Machado

from clarifai import rest
from clarifai.rest import ClarifaiApp
import sys

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
	model = app.models.get('users')
	concept_id = sys.argv[1]
	filename = sys.argv[2]

	raw_bytes = open(filename, "rb").read()
	app.inputs.create_image_from_bytes(raw_bytes, concepts=[concept_id])
	model.add_concepts([concept_id])
	model.train()

if __name__ == "__main__":
    main()
