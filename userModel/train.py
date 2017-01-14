# !/usr/bin/python
# Copyright 2017 Dave Machado

from clarifai.rest import ClarifaiApp
from clarifai.rest import Image as ClImage
import os

rootDir = '/Users/Dave/github/shltr/userModel/inputs/train'
credFile = '/Users/Dave/github/shltr/userModel/client_secret.txt'
modelName = 'users'

concepts = []

def getCredentials():
	creds = []
	file = open(credFile, 'r')
	creds.append(file.readline())
	creds.append(file.readline())
	return creds

def addInputs(app):
	for filePath in os.listdir(rootDir):
		if not os.path.isfile(filePath) and not filePath.startswith('.'):
			concepts.append(filePath)
			parentDir = filePath
			currentDir = rootDir + '/' + parentDir
			for filename in os.listdir(currentDir):
				if not os.path.isdir(filePath) and not filePath.startswith('.'):
					if (filename.endswith(("jpg", "png", "tiff", "bmp"))):
						fullFilePath = currentDir + '/' + filename
						raw_bytes = open(fullFilePath, "rb").read()
						app.inputs.create_image_from_bytes(raw_bytes, concepts=[parentDir])
						print("Adding " + filename + " to " + parentDir + " concept")

def addConcepts(model):
	for x in range(len(concepts)):
		model.add_concepts([str(concepts[x])])
		print("Added " + concepts[x] + " concept to model")

def main():
	creds = getCredentials()
	app = ClarifaiApp(creds[0][:-1], creds[1][:-1])
	addInputs(app)
	model = app.models.create(modelName)
	addConcepts(model)
	model.train()

if __name__ == "__main__":
    main()
