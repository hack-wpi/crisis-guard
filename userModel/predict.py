# !/usr/bin/python
# Copyright 2017 Dave Machado

from clarifai.rest import ClarifaiApp
from clarifai.rest import Image as ClImage
from sys import argv
import json

credFile = '/Users/Dave/github/shltr/userModel/client_secret.txt'
modelName = 'clients'

def getCredentials():
	creds = []
	file = open(credFile, 'r')
	creds.append(file.readline())
	creds.append(file.readline())
	return creds

def predict(model):
	if (argv[1].startswith("http")):
		image = ClImage(url=argv[1])
	else:
		image = ClImage(file_obj=open(argv[1], 'rb'))
	response = model.predict([image])

	output = {}
	output['matches'] = []
	for concept in response['outputs'][0]['data']['concepts']:
		name = concept['name']
		val = round(concept['value'], 2)
		output['matches'].append({'name':name, 'prob':val})
	print(json.dumps(output))

def main():
	creds = getCredentials()
	app = ClarifaiApp(creds[0][:-1], creds[1][:-1])
	model = app.models.get(modelName)
	predict(model)

if __name__ == "__main__":
    main()
