# !/usr/bin/python
# Copyright 2017 Dave Machado

from clarifai.rest import ClarifaiApp
from clarifai.rest import Image as ClImage
import sys
import os
import json
import urllib2

credFile = '/Users/Dave/github/shltr/userModel/client_secret.txt'
model_name = 'users'

def getCredentials():
	creds = []
	file = open(credFile, 'r')
	creds.append(file.readline())
	creds.append(file.readline())
	return creds

def predict(model, test_input):
	if (test_input.startswith("http")):
		image = ClImage(url=test_input)
	else:
		image = ClImage(file_obj=open(test_input, 'rb'))
	response = model.predict([image])

	if response["status"]["description"] == "Ok":
		output = {'status': 'Good'}
		output['matches'] = []
		for concept in response['outputs'][0]['data']['concepts']:
			name = concept['name']
			val = round(concept['value'], 2)
			output['matches'].append({'name':name, 'prob':val})
	else:
		output = {'status': 'Bad'}
	return output

def checkAGE(image_url):
	if not image_url.startswith("http"):
		return
	curl = '''curl -s -X POST -H 'Authorization: Bearer RswCOv32l9poVQMbQPmoN5GbNJfQdp' -H "Content-Type: application/json" -d '{"inputs": [{"data": {"image": {"url": "''' + image_url + '''"}}}]}' https://api.clarifai.com/v2/models/c0c0ac362b03416da06ab3fa36fb58e3/outputs'''
	os.system(curl + " > age_temp.json")
	with open('age_temp.json') as data_file:
		data = json.load(data_file)
		if data["status"]["description"] == "Ok":
			age_val = data["outputs"][0]["data"]["regions"][0]["data"]["faces"][0]["age"][0]['name']
			gender_val = data["outputs"][0]["data"]["regions"][0]["data"]["faces"][0]["gender"][0]['name']

			ethnic_0_val = data["outputs"][0]["data"]["regions"][0]["data"]["faces"][0]["ethnicity"][0]['name'][4:]
			ethnic_0_prob = data["outputs"][0]["data"]["regions"][0]["data"]["faces"][0]["ethnicity"][0]['value']
			ethnic_1_val = data["outputs"][0]["data"]["regions"][0]["data"]["faces"][0]["ethnicity"][1]['name'][4:]
			ethnic_1_prob = data["outputs"][0]["data"]["regions"][0]["data"]["faces"][0]["ethnicity"][1]['value']
			if (abs(ethnic_0_prob - ethnic_1_prob) <= 0.1):
				ethnic_total_val = ethnic_0_val + '/' + ethnic_1_val
			else:
				ethnic_total_val = ethnic_0_val
			output = {'status': 'Good', 'age': age_val, 'gender': gender_val, 'ethnicity': ethnic_total_val}
		else:
			output = {'status': 'Bad'}
		os.system("rm age_temp.json")
		return output

def combineJSON(age_json, usr_json):
	full_json = {}
	full_json['age_model'] = age_json
	full_json['user_model'] = usr_json
	print(json.dumps(full_json))

def main():
	image = sys.argv[1]
	creds = getCredentials()
	app = ClarifaiApp(creds[0][:-1], creds[1][:-1])
	model = app.models.get(model_name)
	age_json = checkAGE(image)
	usr_json = predict(model, image)
	combineJSON(age_json,usr_json)

if __name__ == "__main__":
    main()
