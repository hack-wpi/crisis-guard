# !/usr/bin/python
# Copyright 2017 Dave Machado

# user_train.py <"userID"> <"training images directory">

from clarifai.rest import ClarifaiApp
import os
import sys

concept_id = sys.argv[1]
rootDir = sys.argv[2]
credFile = '/home/ubuntu/configs/clarifai_secret.txt'
model_name = 'users'

def getCredentials():
	creds = []
	file = open(credFile, 'r')
	creds.append(file.readline())
	creds.append(file.readline())
	return creds

def addInputs(app):
	for filename in os.listdir(rootDir):
		if (filename.endswith(("jpg", "png", "tiff", "bmp"))):
			fullFilePath = rootDir + '/' + filename
			raw_bytes = open(fullFilePath, "rb").read()
			app.inputs.create_image_from_bytes(raw_bytes, concepts=[concept_id])
			print("Adding " + filename + " to " + concept_id + " concept")

def main():
	creds = getCredentials()
	app = ClarifaiApp(creds[0][:-1], creds[1][:-1])
	addInputs(app)
	model = app.models.get(model_name)
	model.add_concepts([concept_id])
	print("Added " + concept_id + " concept to model")
	model.train()

if __name__ == "__main__":
    main()
