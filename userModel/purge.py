# !/usr/bin/python
# Copyright 2017 Dave Machado

from clarifai.rest import ClarifaiApp
  
app = ClarifaiApp("1n49sljmXv1ieUrlRx-hX7UifV1lSXCjp4sqKSG9", "3w_P5x5hLmVmBoPnJFSNq8hbgFFtG-CjSzFC73jk")
    
print(app.models.delete_all())
print(app.inputs.delete_all())
